<?php
/**
 * Seed — insere 3 posts de exemplo no blog da Nidex.
 * Acesse /cms/seed.php uma única vez e depois delete este arquivo.
 */
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';

requireLogin();

$pdo = getDB();

// Garante categoria padrão
$catStmt = $pdo->prepare("SELECT id FROM categories WHERE slug = ?");
$catStmt->execute(['gestao']);
$cat = $catStmt->fetch();

if (!$cat) {
    $pdo->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)")
        ->execute(['Gestão', 'gestao']);
    $catId = (int) $pdo->lastInsertId();
} else {
    $catId = (int) $cat['id'];
}

$posts = [
    [
        'title'       => '5 passos para organizar as finanças do seu negócio',
        'slug'        => '5-passos-para-organizar-as-financas-do-seu-negocio',
        'excerpt'     => 'Controle financeiro é a base de qualquer empresa saudável. Veja como dar os primeiros passos sem complicação.',
        'cover_image' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=1200&q=80',
        'content'     => '<h2>Por que o controle financeiro é tão importante?</h2>
<p>Muitos empreendedores focam apenas em vender, mas negligenciam o que acontece com o dinheiro depois que ele entra. O resultado: fluxo de caixa negativo, dívidas inesperadas e estresse desnecessário.</p>
<p>A boa notícia é que organizar as finanças do seu negócio não precisa ser complicado. Com cinco passos práticos, você transforma o caos em clareza.</p>
<h2>1. Separe contas pessoais e empresariais</h2>
<p>Misturar dinheiro pessoal e do negócio é o erro mais comum — e mais perigoso. Abra uma conta bancária exclusiva para a empresa e defina um <strong>pró-labore fixo</strong> para você mesmo.</p>
<h2>2. Registre todas as entradas e saídas</h2>
<p>Use uma planilha, app ou sistema como a Nidex para registrar cada movimentação. O hábito de anotar tudo é o que separa negócios que crescem dos que quebram.</p>
<h2>3. Monitore o fluxo de caixa semanalmente</h2>
<p>O fluxo de caixa mostra quanto dinheiro você tem hoje e quanto terá nos próximos dias. Revise toda segunda-feira para antecipar problemas antes que aconteçam.</p>
<h2>4. Defina metas financeiras claras</h2>
<p>Sem metas, qualquer número parece bom. Estabeleça objetivos mensais de faturamento, margem de lucro e reserva de emergência.</p>
<h2>5. Automatize cobranças e recebimentos</h2>
<p>Boletos atrasados e cobranças manuais consomem tempo e geram inadimplência. Use ferramentas que disparam lembretes automáticos — como a Nidex — e recupere mais dinheiro com menos esforço.</p>
<blockquote>Empreendedores que conhecem seus números tomam decisões melhores e dormem mais tranquilos.</blockquote>',
    ],
    [
        'title'       => 'CRM para pequenas empresas: por que você precisa agora',
        'slug'        => 'crm-para-pequenas-empresas-por-que-voce-precisa-agora',
        'excerpt'     => 'Perder cliente por falta de acompanhamento é mais comum do que parece. Entenda como um CRM resolve isso.',
        'cover_image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1200&q=80',
        'content'     => '<h2>Você está perdendo clientes sem perceber</h2>
<p>Imagine que um potencial cliente entrou em contato semana passada. Você respondeu, mas não fez um follow-up. Ele comprou do concorrente. Isso acontece todo dia em pequenas empresas que não usam um CRM.</p>
<p>CRM — Customer Relationship Management — não é só para grandes empresas. É especialmente poderoso para quem tem poucos recursos e precisa converter cada oportunidade.</p>
<h2>O que um CRM faz por você</h2>
<ul>
<li><strong>Centraliza todos os contatos</strong> em um só lugar, sem planilha desatualizada</li>
<li><strong>Mostra onde cada lead está</strong> no seu funil de vendas</li>
<li><strong>Lembra você de fazer follow-up</strong> na hora certa</li>
<li><strong>Registra o histórico</strong> de cada conversa</li>
<li><strong>Gera relatórios</strong> para você tomar decisões com dados</li>
</ul>
<h2>Quando é a hora certa de adotar um CRM?</h2>
<p>A resposta é: agora. Quanto mais cedo você organizar sua base de clientes, mais rápido seu negócio vai crescer. Começar com volume pequeno é vantagem — você aprende o fluxo sem pressão.</p>
<h2>CRM integrado ao seu negócio</h2>
<p>A Nidex oferece CRM integrado ao financeiro, tarefas e projetos. Assim, quando você fecha um cliente, todo o fluxo de atendimento começa automaticamente — sem retrabalho, sem informação perdida.</p>',
    ],
    [
        'title'       => 'Produtividade para empreendedores: as ferramentas que fazem diferença',
        'slug'        => 'produtividade-para-empreendedores-ferramentas-que-fazem-diferenca',
        'excerpt'     => 'Trabalhar mais não é a resposta. Trabalhar de forma inteligente, com as ferramentas certas, é o que separa quem cresce de quem empaca.',
        'cover_image' => 'https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=1200&q=80',
        'content'     => '<h2>O problema do empreendedor que faz tudo sozinho</h2>
<p>Você resolve o operacional, responde clientes, cuida das finanças, vende e ainda tenta crescer. O resultado é uma agenda impossível, decisões tomadas no cansaço e crescimento travado.</p>
<p>Ferramentas certas não substituem sua inteligência — elas <strong>amplificam</strong> ela. Veja as categorias que mais impactam a produtividade de quem empreende.</p>
<h2>1. Gestão de tarefas e projetos</h2>
<p>Ter tudo na cabeça é uma receita para esquecer o que importa. Use um sistema de tarefas para registrar, priorizar e acompanhar cada atividade. Com projetos bem estruturados, você delega com mais confiança e entrega com mais qualidade.</p>
<h2>2. Comunicação centralizada</h2>
<p>E-mail, WhatsApp, Instagram, telefone — a comunicação fragmentada consome horas e cria ruído. Centralize o histórico de cada cliente em um só lugar para nunca perder uma informação importante.</p>
<h2>3. Automação de cobranças</h2>
<p>Cobrar manualmente é desgastante para você e constrangedor para o cliente. Automatize lembretes, boletos e confirmações — e recupere tempo para o que realmente importa.</p>
<h2>4. IA como assistente</h2>
<p>A inteligência artificial não veio para substituir o empreendedor, mas para acelerar tarefas repetitivas: redigir e-mails, resumir reuniões, sugerir prioridades, analisar dados. Quem aprende a usar IA hoje leva vantagem amanhã.</p>
<h2>All-in-one vs. várias ferramentas</h2>
<p>Usar dez aplicativos diferentes cria silos de informação e aumenta a curva de aprendizado da equipe. Um sistema all-in-one como a Nidex integra CRM, financeiro, tarefas e IA em um lugar só — menos login, menos retrabalho, mais resultado.</p>
<blockquote>Produtividade não é fazer mais coisas. É fazer as coisas certas, mais rápido, com menos esforço desnecessário.</blockquote>',
    ],
];

$inserted = 0;
$skipped  = 0;

foreach ($posts as $p) {
    $check = $pdo->prepare("SELECT id FROM posts WHERE slug = ?");
    $check->execute([$p['slug']]);
    if ($check->fetch()) {
        $skipped++;
        continue;
    }

    $pdo->prepare("
        INSERT INTO posts (title, slug, excerpt, content, cover_image, category_id, status, published_at)
        VALUES (?, ?, ?, ?, ?, ?, 'published', NOW())
    ")->execute([
        $p['title'], $p['slug'], $p['excerpt'],
        $p['content'], $p['cover_image'], $catId,
    ]);
    $inserted++;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Seed — Nidex CMS</title>
  <style>
    body { font-family: sans-serif; max-width: 600px; margin: 60px auto; padding: 24px; }
    .ok  { background: #DCFCE7; color: #166534; padding: 16px; border-radius: 8px; }
    a    { color: #2563EB; }
  </style>
</head>
<body>
  <div class="ok">
    <strong>Seed concluído!</strong><br>
    Posts inseridos: <strong><?= $inserted ?></strong><br>
    Posts já existentes (ignorados): <strong><?= $skipped ?></strong>
  </div>
  <p style="margin-top:20px">
    <a href="/cms/posts.php">Ver posts no CMS →</a><br>
    <a href="/blog">Ver blog público →</a>
  </p>
  <p style="color:#94A3B8;font-size:0.8rem">Apague este arquivo após o uso: <code>cms/seed.php</code></p>
</body>
</html>
