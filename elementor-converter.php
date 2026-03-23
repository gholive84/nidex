<?php
/**
 * Nidex — Conversor HTML → Elementor (PHP)
 * Busca a URL, extrai estrutura, baixa imagens e gera um ZIP pronto para importar.
 */

// ─── CONFIG ──────────────────────────────────────────────────────────────────
define('MAX_IMAGE_SIZE', 8 * 1024 * 1024); // 8 MB por imagem
define('REQUEST_TIMEOUT', 20);
define('VERSION', '1.2.0');

// ─── PROCESS POST ─────────────────────────────────────────────────────────────
$result = null;
$error  = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = trim($_POST['url'] ?? '');
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        $error = 'URL inválida. Use o formato https://seusite.com';
    } else {
        try {
            $result = runConversion($url);
            // Stream ZIP for download
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="elementor-export.zip"');
            header('Content-Length: ' . strlen($result['zip']));
            header('Cache-Control: no-cache');
            echo $result['zip'];
            exit;
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}

// ═══════════════════════════════════════════════════════════════════════════════
// CONVERSION ENGINE
// ═══════════════════════════════════════════════════════════════════════════════

function runConversion(string $url): array {
    // 1. Fetch HTML
    $html = fetchURL($url);
    if (!$html) throw new Exception('Não foi possível acessar a URL. Verifique se o site está online.');

    // 2. Parse DOM
    $dom = parseDom($html);

    // 3. Extract base URL for relative paths
    $parsed  = parse_url($url);
    $baseUrl = $parsed['scheme'] . '://' . $parsed['host'];
    $baseDir = $baseUrl . dirname($parsed['path'] ?? '/');

    // 4. Convert to Elementor JSON
    $conversion = convertToElementor($dom, $url, $baseUrl, $baseDir);

    // 5. Download images
    $images = downloadImages($conversion['imageUrls'], $baseUrl, $baseDir);

    // 6. Try to fetch CSS
    $css = fetchLinkedCSS($dom, $baseUrl, $baseDir);

    // 7. Build ZIP
    $zip = buildZip($conversion['json'], $images, $css, $url);

    return [
        'zip'      => $zip,
        'stats'    => $conversion['stats'],
        'imgCount' => count($images),
    ];
}

// ─── HTTP Fetch ───────────────────────────────────────────────────────────────
function fetchURL(string $url, int $maxBytes = 5 * 1024 * 1024): string|false {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS      => 5,
        CURLOPT_TIMEOUT        => REQUEST_TIMEOUT,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT      => 'Mozilla/5.0 (compatible; NidexConverter/' . VERSION . ')',
        CURLOPT_HTTPHEADER     => ['Accept: text/html,*/*'],
        CURLOPT_BUFFERSIZE     => 128 * 1024,
    ]);
    $data = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return ($data !== false && $code >= 200 && $code < 400) ? $data : false;
}

function fetchImage(string $url): string|false {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT      => 'Mozilla/5.0 (compatible; NidexConverter/' . VERSION . ')',
    ]);
    $data = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
    curl_close($ch);
    if ($data === false || $code < 200 || $code >= 400) return false;
    if (strlen($data) > MAX_IMAGE_SIZE) return false;
    return $data;
}

// ─── DOM Parser ───────────────────────────────────────────────────────────────
function parseDom(string $html): DOMDocument {
    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors(true);
    $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
    libxml_clear_errors();
    return $dom;
}

// ─── URL Resolver ─────────────────────────────────────────────────────────────
function resolveUrl(string $src, string $baseUrl, string $baseDir): string {
    if (empty($src)) return '';
    if (str_starts_with($src, 'http://') || str_starts_with($src, 'https://')) return $src;
    if (str_starts_with($src, '//')) return 'https:' . $src;
    if (str_starts_with($src, '/')) return $baseUrl . $src;
    return rtrim($baseDir, '/') . '/' . ltrim($src, './');
}

// ─── CSS Fetcher ──────────────────────────────────────────────────────────────
function fetchLinkedCSS(DOMDocument $dom, string $baseUrl, string $baseDir): string {
    $css = '';
    $links = $dom->getElementsByTagName('link');
    foreach ($links as $link) {
        if (strtolower($link->getAttribute('rel')) === 'stylesheet') {
            $href = $link->getAttribute('href');
            $cssUrl = resolveUrl($href, $baseUrl, $baseDir);
            if ($cssUrl) {
                $content = fetchURL($cssUrl);
                if ($content) $css .= "\n/* === $href === */\n" . $content;
            }
        }
    }
    // Also grab inline <style> blocks
    $styles = $dom->getElementsByTagName('style');
    foreach ($styles as $style) {
        $css .= "\n/* === inline style === */\n" . $style->textContent;
    }
    return $css;
}

// ─── Image Downloader ─────────────────────────────────────────────────────────
function downloadImages(array $urls, string $baseUrl, string $baseDir): array {
    $images = [];
    $seen   = [];

    foreach (array_unique($urls) as $originalUrl) {
        if (empty($originalUrl) || isset($seen[$originalUrl])) continue;
        $seen[$originalUrl] = true;

        $absUrl = resolveUrl($originalUrl, $baseUrl, $baseDir);
        if (empty($absUrl)) continue;

        // Skip data URIs and SVGs from external CDNs (too large)
        if (str_starts_with($absUrl, 'data:')) continue;

        $data = fetchImage($absUrl);
        if (!$data) continue;

        // Derive filename
        $path     = parse_url($absUrl, PHP_URL_PATH) ?? '';
        $filename = basename($path) ?: 'image_' . md5($absUrl);
        // Ensure unique
        $base = pathinfo($filename, PATHINFO_FILENAME);
        $ext  = pathinfo($filename, PATHINFO_EXTENSION) ?: 'jpg';
        $key  = 0;
        $finalName = $filename;
        while (isset($images[$finalName])) {
            $finalName = $base . '_' . (++$key) . '.' . $ext;
        }

        $images[$finalName] = [
            'data'        => $data,
            'originalUrl' => $originalUrl,
            'absUrl'      => $absUrl,
        ];
    }

    return $images;
}

// ─── Elementor ID generator ───────────────────────────────────────────────────
function eid(): string {
    return substr(md5(uniqid((string)mt_rand(), true)), 0, 7);
}

// ─── Elementor widget builders ────────────────────────────────────────────────
function eSection(array $settings, array $columns): array {
    return ['id' => eid(), 'elType' => 'section', 'settings' => $settings, 'elements' => $columns, 'isInner' => false];
}
function eColumn(int $width, array $elements): array {
    return ['id' => eid(), 'elType' => 'column', 'settings' => ['_column_size' => $width, '_inline_size' => null], 'elements' => $elements];
}
function eHeading(string $text, string $tag = 'h2', string $color = ''): array {
    return ['id' => eid(), 'elType' => 'widget', 'widgetType' => 'heading', 'settings' => ['title' => $text, 'header_size' => $tag, 'title_color' => $color]];
}
function eText(string $html): array {
    return ['id' => eid(), 'elType' => 'widget', 'widgetType' => 'text-editor', 'settings' => ['editor' => $html]];
}
function eButton(string $label, string $href = '#', bool $outline = false): array {
    return ['id' => eid(), 'elType' => 'widget', 'widgetType' => 'button', 'settings' => [
        'text'             => $label,
        'link'             => ['url' => $href ?: '#', 'is_external' => false],
        'background_color' => $outline ? '' : '#2563EB',
        'border_color'     => $outline ? '#2563EB' : '',
        'border_width'     => ['unit' => 'px', 'top' => $outline ? '2' : '0', 'right' => $outline ? '2' : '0', 'bottom' => $outline ? '2' : '0', 'left' => $outline ? '2' : '0'],
        'border_radius'    => ['unit' => 'px', 'top' => '10', 'right' => '10', 'bottom' => '10', 'left' => '10'],
        'button_type'      => $outline ? '' : 'info',
    ]];
}
function eImage(string $url, string $alt = ''): array {
    return ['id' => eid(), 'elType' => 'widget', 'widgetType' => 'image', 'settings' => [
        'image'      => ['url' => $url, 'id' => 0, 'alt' => $alt],
        'image_size' => 'full',
    ]];
}
function eHTML(string $html): array {
    return ['id' => eid(), 'elType' => 'widget', 'widgetType' => 'html', 'settings' => ['html' => $html]];
}
function eDivider(): array {
    return ['id' => eid(), 'elType' => 'widget', 'widgetType' => 'divider', 'settings' => []];
}

// ─── Detect section background ───────────────────────────────────────────────
function detectBg(DOMElement $el): string {
    $cls = $el->getAttribute('class');
    if (preg_match('/bg-dark|hero|cta-section|service-block--dark|gradient-dark|dark/', $cls)) return '#0F172A';
    if (preg_match('/section--light|bg-light|service-block--alt/', $cls)) return '#F8FAFC';
    if (preg_match('/section--white|bg-white/', $cls)) return '#FFFFFF';
    // Try inline style
    $style = $el->getAttribute('style');
    if (preg_match('/background(?:-color)?\s*:\s*(#[0-9a-fA-F]{3,8})/', $style, $m)) return $m[1];
    return '';
}

// ─── Inner text (clean) ───────────────────────────────────────────────────────
function innerText(DOMNode $node): string {
    $text = '';
    foreach ($node->childNodes as $child) {
        if ($child->nodeType === XML_TEXT_NODE) $text .= $child->nodeValue;
        elseif ($child->nodeType === XML_ELEMENT_NODE) $text .= innerText($child);
    }
    return trim(preg_replace('/\s+/', ' ', $text));
}

// ─── Inner HTML ───────────────────────────────────────────────────────────────
function innerHTML(DOMNode $node): string {
    $html = '';
    foreach ($node->childNodes as $child) {
        $html .= $node->ownerDocument->saveHTML($child);
    }
    return $html;
}

// ─── Parse section children into widgets ─────────────────────────────────────
function parseWidgets(DOMElement $container, bool $isDark, array &$imgUrls): array {
    $widgets   = [];
    $textColor = $isDark ? '#FFFFFF' : '#0F172A';
    $xpath     = new DOMXPath($container->ownerDocument);

    foreach ($container->childNodes as $node) {
        if ($node->nodeType !== XML_ELEMENT_NODE) continue;
        /** @var DOMElement $node */
        $tag  = strtolower($node->tagName);
        $cls  = $node->getAttribute('class');
        $text = innerText($node);
        $html = innerHTML($node);

        if (empty($text) && $node->getElementsByTagName('img')->length === 0) continue;

        switch ($tag) {
            case 'h1': case 'h2': case 'h3': case 'h4': case 'h5':
                if ($text) $widgets[] = eHeading(strip_tags($html), $tag, $textColor);
                break;

            case 'p':
                if ($text) $widgets[] = eText("<p>$html</p>");
                break;

            case 'a':
                if ($text) {
                    $href    = $node->getAttribute('href') ?: '#';
                    $outline = (bool)preg_match('/outline|ghost|secondary/', $cls);
                    $widgets[] = eButton($text, $href, $outline);
                }
                break;

            case 'img':
                $src = $node->getAttribute('src');
                $alt = $node->getAttribute('alt');
                if ($src) {
                    $imgUrls[] = $src;
                    $widgets[] = eImage($src, $alt);
                }
                break;

            case 'ul': case 'ol':
                $widgets[] = eText("<$tag>$html</$tag>");
                break;

            case 'div': case 'article': case 'aside':
                // Buttons group
                $btns     = $node->getElementsByTagName('a');
                $headings = $xpath->query('.//*[self::h1 or self::h2 or self::h3 or self::h4]', $node);
                $paras    = $node->getElementsByTagName('p');
                $imgs     = $node->getElementsByTagName('img');

                // Collect images
                foreach ($imgs as $img) {
                    $src = $img->getAttribute('src');
                    if ($src) $imgUrls[] = $src;
                }

                if ($headings->length === 0 && $paras->length === 0 && $btns->length > 0) {
                    // Pure button group
                    foreach ($btns as $btn) {
                        $bText = innerText($btn);
                        if (!$bText) continue;
                        $href    = $btn->getAttribute('href') ?: '#';
                        $outline = (bool)preg_match('/outline|ghost|secondary/', $btn->getAttribute('class'));
                        $widgets[] = eButton($bText, $href, $outline);
                    }
                } elseif ($headings->length > 0 || $paras->length > 0) {
                    // Recurse into meaningful divs
                    $sub = parseWidgets($node, $isDark, $imgUrls);
                    $widgets = array_merge($widgets, $sub);
                } elseif ($text) {
                    $widgets[] = eText("<div>$html</div>");
                }
                break;

            case 'nav': case 'header': case 'footer':
                // Keep complex nav/header as raw HTML widget
                if ($text) $widgets[] = eHTML($node->ownerDocument->saveHTML($node));
                break;

            default:
                if ($text) $widgets[] = eText("<$tag>$html</$tag>");
        }
    }

    return $widgets;
}

// ─── Main converter ───────────────────────────────────────────────────────────
function convertToElementor(DOMDocument $dom, string $sourceUrl, string $baseUrl, string $baseDir): array {
    $xpath    = new DOMXPath($dom);
    $sections = [];
    $imgUrls  = [];
    $stats    = ['sections' => 0, 'widgets' => 0, 'headings' => 0, 'buttons' => 0, 'images' => 0];

    // Title
    $titleNodes = $dom->getElementsByTagName('title');
    $title = $titleNodes->length ? $titleNodes->item(0)->textContent : 'Importado via Nidex Converter';

    // Collect all top-level blocks: header, section, footer
    $blocks = $xpath->query('//body/header | //body/main/section | //body/main | //body/section | //body/footer');
    if (!$blocks || $blocks->length === 0) {
        // Fallback: try direct children of body
        $blocks = $xpath->query('//body/*');
    }

    foreach ($blocks as $block) {
        /** @var DOMElement $block */
        $tag = strtolower($block->tagName);
        $cls = $block->getAttribute('class');

        // Skip scripts, styles, hidden elements
        if (in_array($tag, ['script', 'style', 'noscript', 'template'])) continue;
        if (str_contains($cls, 'mobile-menu') || str_contains($cls, 'd-none')) continue;

        $bg     = detectBg($block);
        $isDark = in_array($bg, ['#0F172A', '#0a1020']) || str_contains(strtolower($bg), '172a');

        $sectionSettings = [];
        if ($bg) {
            $sectionSettings['background_background'] = 'classic';
            $sectionSettings['background_color']      = $bg;
        }
        $sectionSettings['padding'] = [
            'unit' => 'px',
            'top'  => ($tag === 'header') ? '20' : '80',
            'right' => '20', 'bottom' => ($tag === 'header') ? '20' : '80', 'left' => '20',
            'isLinked' => false,
        ];

        // For header/navbar: simplify
        if ($tag === 'header') {
            $logoNode = $xpath->query('.//*[contains(@class,"logo") or contains(@class,"brand")]', $block)->item(0);
            $logoText = $logoNode ? innerText($logoNode) : 'Logo';
            $widgets  = [
                eHeading($logoText, 'h3', '#2563EB'),
                eHTML('<!-- Navbar: use o widget Nav Menu do Elementor para os links -->'),
            ];
        } else {
            $widgets = parseWidgets($block, $isDark, $imgUrls);
        }

        if (empty($widgets)) continue;

        // Collect background images from inline styles
        $styleAttr = $block->getAttribute('style');
        if (preg_match('/url\([\'"]?([^\'")\s]+)[\'"]?\)/', $styleAttr, $m)) {
            $imgUrls[] = $m[1];
        }

        // Find bg images in all child elements
        $allChildren = $block->getElementsByTagName('*');
        foreach ($allChildren as $child) {
            $childStyle = $child->getAttribute('style');
            if (preg_match('/url\([\'"]?([^\'")\s]+)[\'"]?\)/', $childStyle, $m)) {
                $imgUrls[] = $m[1];
            }
        }

        $col     = eColumn(100, $widgets);
        $section = eSection($sectionSettings, [$col]);
        $sections[] = $section;

        $stats['sections']++;
        foreach ($widgets as $w) {
            $stats['widgets']++;
            if (($w['widgetType'] ?? '') === 'heading') $stats['headings']++;
            if (($w['widgetType'] ?? '') === 'button')  $stats['buttons']++;
            if (($w['widgetType'] ?? '') === 'image')   $stats['images']++;
        }
    }

    $json = [
        'version'        => '0.4',
        'title'          => $title,
        'type'           => 'page',
        'content'        => $sections,
        'page_settings'  => [],
        '_source_url'    => $sourceUrl,
        '_generated_by'  => 'Nidex Elementor Converter v' . VERSION,
        '_generated_at'  => date('Y-m-d H:i:s'),
    ];

    $stats['images'] += count(array_unique($imgUrls));

    return ['json' => $json, 'imageUrls' => array_unique($imgUrls), 'stats' => $stats, 'title' => $title];
}

// ─── ZIP Builder ─────────────────────────────────────────────────────────────
function buildZip(array $json, array $images, string $css, string $sourceUrl): string {
    $tmpFile = tempnam(sys_get_temp_dir(), 'nidex_zip_');
    $zip     = new ZipArchive();
    $zip->open($tmpFile, ZipArchive::OVERWRITE);

    // 1. Elementor JSON
    $zip->addFromString('elementor-template.json', json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

    // 2. Images
    foreach ($images as $filename => $imgData) {
        $zip->addFromString('images/' . $filename, $imgData['data']);
    }

    // 3. CSS
    if ($css) {
        $zip->addFromString('style.css', $css);
    }

    // 4. README
    $imgLines = '';
    foreach ($images as $filename => $imgData) {
        $imgLines .= "  - images/{$filename}  (original: {$imgData['originalUrl']})\n";
    }

    $readme = <<<TXT
════════════════════════════════════════════════════════
  NIDEX — EXPORTAÇÃO PARA ELEMENTOR
  Gerado em: {$json['_generated_at']}
  Fonte: {$sourceUrl}
════════════════════════════════════════════════════════

CONTEÚDO DO ZIP
───────────────
  elementor-template.json  → Template para importar no Elementor
  style.css                → CSS original do site
  images/                  → Todas as imagens baixadas do site
{$imgLines}

COMO IMPORTAR NO ELEMENTOR
──────────────────────────
1. WordPress → Páginas → Adicionar nova → "Editar com Elementor"
2. Clique no ícone de PASTA (⊞ Adicionar Template) na tela do editor
3. Aba "Meus Templates" → ícone de UPLOAD (seta ↑) no canto superior direito
4. Selecione o arquivo "elementor-template.json"
5. Clique em "Inserir" para adicionar à página

COMO SUBIR AS IMAGENS
─────────────────────
1. WordPress → Mídia → Adicionar novo
2. Faça upload de todos os arquivos da pasta "images/"
3. Para cada imagem, copie a URL gerada pelo WordPress
4. No Elementor, clique em cada widget de imagem e substitua pela URL do WordPress

COMO ADICIONAR O CSS PERSONALIZADO
───────────────────────────────────
1. No editor Elementor → Menu hambúrguer (≡) → Configurações do Site
2. Aba "CSS Personalizado"
3. Cole o conteúdo do arquivo "style.css"
4. Clique em "Atualizar"

DICAS
─────
• O template captura a estrutura e conteúdo. Alguns ajustes visuais
  serão necessários (espaçamentos, fontes, efeitos hover).
• Elementos complexos como navbar e mockups de dashboard ficam
  como widgets HTML — você pode substituí-los por widgets nativos.
• Animações Framer Motion precisam ser reconfiguradas com
  o Motion Effects do Elementor Pro.

════════════════════════════════════════════════════════
  Gerado por Nidex Elementor Converter v{$json['_generated_by']}
════════════════════════════════════════════════════════
TXT;
    $zip->addFromString('LEIA-ME.txt', $readme);

    $zip->close();
    $data = file_get_contents($tmpFile);
    unlink($tmpFile);
    return $data;
}

// ═══════════════════════════════════════════════════════════════════════════════
// HTML UI
// ═══════════════════════════════════════════════════════════════════════════════
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nidex — Conversor HTML → Elementor</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Inter', sans-serif; background: #0F172A; color: #fff; min-height: 100vh; }

    .header { padding: 20px 32px; border-bottom: 1px solid rgba(255,255,255,0.07); display: flex; align-items: center; gap: 16px; }
    .header__logo { font-size: 1.5rem; font-weight: 800; color: #2563EB; }
    .header__sep { width: 1px; height: 24px; background: rgba(255,255,255,0.1); }
    .header__title { font-size: 0.9375rem; color: rgba(255,255,255,0.45); }
    .header__version { margin-left: auto; font-size: 0.75rem; color: rgba(255,255,255,0.2); }

    .main { max-width: 820px; margin: 0 auto; padding: 48px 24px 80px; }

    .hero-text { margin-bottom: 40px; }
    .hero-text h1 { font-size: 2rem; font-weight: 800; letter-spacing: -0.03em; margin-bottom: 10px; }
    .hero-text h1 span { color: #38BDF8; }
    .hero-text p { color: rgba(255,255,255,0.45); font-size: 1rem; line-height: 1.7; max-width: 560px; }

    .card { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; padding: 32px; margin-bottom: 20px; }
    .card__label { font-size: 0.75rem; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: #2563EB; margin-bottom: 8px; }
    .card__title { font-size: 1.0625rem; font-weight: 700; margin-bottom: 6px; }
    .card__desc { font-size: 0.875rem; color: rgba(255,255,255,0.4); line-height: 1.65; margin-bottom: 22px; }

    form { display: flex; flex-direction: column; gap: 14px; }
    .input-row { display: flex; gap: 10px; }
    .url-input {
      flex: 1; background: rgba(255,255,255,0.06); border: 1.5px solid rgba(255,255,255,0.1);
      border-radius: 10px; padding: 14px 18px; font-family: inherit; font-size: 0.9375rem;
      color: #fff; outline: none; transition: border-color 0.2s;
    }
    .url-input::placeholder { color: rgba(255,255,255,0.2); }
    .url-input:focus { border-color: #2563EB; }

    .btn-submit {
      background: #2563EB; color: #fff; border: none; border-radius: 10px;
      padding: 14px 28px; font-family: inherit; font-size: 0.9375rem; font-weight: 600;
      cursor: pointer; transition: all 0.2s; white-space: nowrap; display: flex; align-items: center; gap: 8px;
    }
    .btn-submit:hover { background: #1D4ED8; transform: translateY(-1px); }

    /* Error */
    .alert { padding: 14px 18px; border-radius: 10px; font-size: 0.9rem; line-height: 1.5; }
    .alert--error { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25); color: #FCA5A5; }
    .alert--info  { background: rgba(56,189,248,0.08); border: 1px solid rgba(56,189,248,0.2); color: rgba(56,189,248,0.9); font-size: 0.875rem; }

    /* Steps */
    .steps { display: flex; flex-direction: column; gap: 18px; }
    .step { display: flex; gap: 16px; align-items: flex-start; }
    .step__num {
      width: 32px; height: 32px; border-radius: 8px; background: rgba(37,99,235,0.2);
      border: 1px solid rgba(37,99,235,0.3); color: #60A5FA; font-size: 0.875rem;
      font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .step__title { font-size: 0.9375rem; font-weight: 600; margin-bottom: 3px; }
    .step__desc  { font-size: 0.875rem; color: rgba(255,255,255,0.4); line-height: 1.55; }
    .step__code  {
      display: inline-block; background: rgba(255,255,255,0.06); border-radius: 5px;
      padding: 2px 8px; font-family: monospace; font-size: 0.8125rem; color: #38BDF8; margin-top: 4px;
    }

    /* What's included */
    .features-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .feat { display: flex; align-items: flex-start; gap: 10px; font-size: 0.875rem; color: rgba(255,255,255,0.55); line-height: 1.5; }
    .feat .icon { flex-shrink: 0; font-size: 0.9rem; margin-top: 1px; }

    /* Loading overlay */
    #loadingOverlay {
      display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.92);
      backdrop-filter: blur(8px); z-index: 999; align-items: center; justify-content: center; flex-direction: column; gap: 20px;
    }
    #loadingOverlay.visible { display: flex; }
    .spinner {
      width: 48px; height: 48px; border: 3px solid rgba(37,99,235,0.3);
      border-top-color: #2563EB; border-radius: 50%; animation: spin 0.8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    .loading-text { color: rgba(255,255,255,0.7); font-size: 0.9375rem; font-weight: 500; }
    .loading-sub  { color: rgba(255,255,255,0.3); font-size: 0.8125rem; }

    @media (max-width: 580px) {
      .input-row { flex-direction: column; }
      .features-grid { grid-template-columns: 1fr; }
      .header { padding: 16px 20px; }
      .main { padding: 32px 16px 60px; }
    }
  </style>
</head>
<body>

<div id="loadingOverlay">
  <div class="spinner"></div>
  <div class="loading-text">Processando...</div>
  <div class="loading-sub">Buscando HTML · Baixando imagens · Gerando ZIP</div>
</div>

<div class="header">
  <div class="header__logo">nidex</div>
  <div class="header__sep"></div>
  <div class="header__title">Conversor HTML → Elementor</div>
  <div class="header__version">v<?= VERSION ?> · PHP</div>
</div>

<div class="main">

  <div class="hero-text">
    <h1>Converta qualquer site em<br/><span>template do Elementor</span></h1>
    <p>Cole a URL do site hospedado. O conversor busca o HTML, baixa todas as imagens e gera um <strong>.zip</strong> pronto para importar no WordPress.</p>
  </div>

  <!-- FORM -->
  <div class="card">
    <div class="card__label">Passo 1 — URL do site</div>
    <div class="card__desc">O site precisa estar online e publicamente acessível. Funciona com qualquer página HTML.</div>

    <?php if ($error): ?>
      <div class="alert alert--error" style="margin-bottom:18px">❌ <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" onsubmit="showLoading()">
      <div class="input-row">
        <input
          type="url"
          name="url"
          class="url-input"
          placeholder="https://seusite.com/index.html"
          value="<?= htmlspecialchars($_POST['url'] ?? '') ?>"
          required
          autofocus
        />
        <button type="submit" class="btn-submit">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          Converter e baixar ZIP
        </button>
      </div>
      <div class="alert alert--info">
        ⏱ O processo leva entre 15–40 segundos dependendo do tamanho do site e quantidade de imagens.
      </div>
    </form>
  </div>

  <!-- WHAT'S INCLUDED -->
  <div class="card">
    <div class="card__label">O que está no ZIP</div>
    <div class="card__desc" style="margin-bottom:18px">Quatro itens gerados automaticamente pelo servidor.</div>
    <div class="features-grid">
      <div class="feat"><span class="icon">📄</span> <div><strong>elementor-template.json</strong><br/>Template pronto para importar no Elementor</div></div>
      <div class="feat"><span class="icon">🖼️</span> <div><strong>images/</strong><br/>Todas as imagens do site baixadas do servidor de origem</div></div>
      <div class="feat"><span class="icon">🎨</span> <div><strong>style.css</strong><br/>CSS original do site capturado pelo servidor</div></div>
      <div class="feat"><span class="icon">📋</span> <div><strong>LEIA-ME.txt</strong><br/>Instruções passo a passo de importação</div></div>
    </div>
  </div>

  <!-- HOW TO IMPORT -->
  <div class="card">
    <div class="card__label">Passo 2 — Como importar</div>
    <div class="card__desc" style="margin-bottom:24px">Após baixar o ZIP, siga este fluxo no WordPress.</div>
    <div class="steps">
      <div class="step">
        <div class="step__num">1</div>
        <div><div class="step__title">Crie uma nova página</div>
        <div class="step__desc">WordPress → Páginas → Adicionar nova → dê um título → clique em <strong>"Editar com Elementor"</strong></div></div>
      </div>
      <div class="step">
        <div class="step__num">2</div>
        <div><div class="step__title">Importe o template JSON</div>
        <div class="step__desc">No editor Elementor, clique no ícone de <strong>pasta ⊞</strong> → aba <strong>"Meus Templates"</strong> → ícone de upload (↑) → selecione o arquivo:</div>
        <div class="step__code">elementor-template.json</div></div>
      </div>
      <div class="step">
        <div class="step__num">3</div>
        <div><div class="step__title">Faça upload das imagens</div>
        <div class="step__desc">WordPress → Mídia → Adicionar novo → suba todos os arquivos da pasta <code>images/</code> do ZIP. Depois atualize cada widget de imagem no Elementor com a nova URL do WordPress.</div></div>
      </div>
      <div class="step">
        <div class="step__num">4</div>
        <div><div class="step__title">Adicione o CSS personalizado</div>
        <div class="step__desc">Elementor → <strong>≡ Configurações do Site</strong> → <strong>CSS Personalizado</strong> → cole o conteúdo do arquivo <code>style.css</code> do ZIP.</div></div>
      </div>
      <div class="step">
        <div class="step__num">5</div>
        <div><div class="step__title">Ajuste e publique</div>
        <div class="step__desc">O template traz a estrutura e conteúdo. Revise espaçamentos, tipografia e efeitos visuais. Clique em <strong>Publicar</strong> quando estiver pronto.</div></div>
      </div>
    </div>
  </div>

  <!-- LIMITATIONS -->
  <div class="card">
    <div class="card__label">O que converte e o que precisa de ajuste</div>
    <div class="features-grid" style="margin-top:4px">
      <div class="feat"><span class="icon">✅</span> Seções com cores de fundo</div>
      <div class="feat"><span class="icon">✅</span> Títulos H1/H2/H3 com cor</div>
      <div class="feat"><span class="icon">✅</span> Parágrafos e textos</div>
      <div class="feat"><span class="icon">✅</span> Botões com links</div>
      <div class="feat"><span class="icon">✅</span> Imagens baixadas e incluídas no ZIP</div>
      <div class="feat"><span class="icon">✅</span> CSS capturado do servidor</div>
      <div class="feat"><span class="icon">⚠️</span> Navbar → widget HTML (ajustar)</div>
      <div class="feat"><span class="icon">⚠️</span> Grid/flex → colunas simplificadas</div>
      <div class="feat"><span class="icon">⚠️</span> Animações → reconfigurar no Elementor</div>
      <div class="feat"><span class="icon">❌</span> JavaScript não é importado</div>
    </div>
  </div>

</div>

<script>
  function showLoading() {
    document.getElementById('loadingOverlay').classList.add('visible');
  }
</script>
</body>
</html>
