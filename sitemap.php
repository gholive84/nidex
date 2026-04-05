<?php
header('Content-Type: application/xml; charset=UTF-8');

$base = 'https://nidex.com.br';
$today = date('Y-m-d');

// Static pages: [url, lastmod, changefreq, priority]
$pages = [
    ['/',                  $today, 'weekly',  '1.0'],
    ['/suite',             $today, 'monthly', '0.8'],
    ['/run',               $today, 'monthly', '0.8'],
    ['/run/academy',       $today, 'monthly', '0.7'],
    ['/run/projects',      $today, 'monthly', '0.7'],
    ['/run/ia-agents',     $today, 'monthly', '0.7'],
    ['/run/consulting',    $today, 'monthly', '0.7'],
    ['/blog',              $today, 'daily',   '0.8'],
];

// Dynamic blog posts from DB
$posts = [];
try {
    require_once __DIR__ . '/cms/config.php';
    require_once __DIR__ . '/cms/includes/db.php';
    $pdo  = getDB();
    $stmt = $pdo->query(
        "SELECT slug, published_at, updated_at
         FROM posts
         WHERE status = 'published'
         ORDER BY published_at DESC"
    );
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    // DB unavailable — sitemap still serves static pages
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($pages as [$path, $lastmod, $changefreq, $priority]): ?>
  <url>
    <loc><?= $base . $path ?></loc>
    <lastmod><?= $lastmod ?></lastmod>
    <changefreq><?= $changefreq ?></changefreq>
    <priority><?= $priority ?></priority>
  </url>
<?php endforeach; ?>
<?php foreach ($posts as $post):
    $lastmod = date('Y-m-d', strtotime($post['updated_at'] ?? $post['published_at']));
?>
  <url>
    <loc><?= $base . '/blog/' . htmlspecialchars($post['slug'], ENT_XML1) ?></loc>
    <lastmod><?= $lastmod ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
<?php endforeach; ?>
</urlset>
