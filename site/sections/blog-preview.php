    <!-- BLOG -->
    <section id="blog" class="section section--light">
      <div class="container">
        <div class="section-header reveal">
          <span class="section-label">Blog</span>
          <h2 class="section-title">Conteúdo para <span class="text-primary">empreendedores</span></h2>
          <p class="section-desc">Dicas, estratégias e tendências para crescer com inteligência.</p>
        </div>
        <div class="blog-grid">
          <?php foreach ($latestPosts as $p): ?>
          <a href="/post.php?slug=<?= urlencode($p['slug']) ?>" class="blog-card reveal">
            <?php if ($p['cover_image']): ?>
            <div class="blog-card__img"><img src="<?= htmlspecialchars($p['cover_image']) ?>" alt="<?= htmlspecialchars($p['title']) ?>" loading="lazy" /></div>
            <?php else: ?>
            <div class="blog-card__img blog-card__img--empty"></div>
            <?php endif; ?>
            <div class="blog-card__body">
              <?php if ($p['category_name']): ?><span class="blog-card__cat"><?= htmlspecialchars($p['category_name']) ?></span><?php endif; ?>
              <h3 class="blog-card__title"><?= htmlspecialchars($p['title']) ?></h3>
              <p class="blog-card__excerpt"><?= htmlspecialchars($p['excerpt'] ?? '') ?></p>
              <span class="blog-card__link">Ler artigo →</span>
            </div>
          </a>
          <?php endforeach; ?>
          <?php if (empty($latestPosts)): ?>
          <p style="color:var(--text-muted);grid-column:1/-1;text-align:center">Em breve — os primeiros posts estão chegando.</p>
          <?php endif; ?>
        </div>
        <div style="text-align:center;margin-top:40px">
          <a href="/blog.php" class="btn btn--outline">Ver todos os posts</a>
        </div>
      </div>
    </section>
