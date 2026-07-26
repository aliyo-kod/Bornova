<?php
/** @var array $blogPosts */
/** @var array $faqs */
?>
<section class="blog-faq" aria-label="Blog ve Sıkça Sorulan Sorular">
  <div class="container-xl">
    <div class="blog-faq__grid">
      <div class="blog-col">
        <div class="section-head">
          <h2>BLOG YAZILARI</h2>
          <a href="/blog" class="section-head__link">Tüm Yazılar</a>
        </div>
        <div class="blog-col__grid">
          <?php foreach ($blogPosts as $idx => $post): ?>
            <article class="blog-card">
              <a href="/blog/<?= e($post['slug']) ?>" class="blog-card__image">
                <img src="/assets/img/blog-<?= $idx + 1 ?>.png" alt="<?= e($post['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
              </a>
              <p class="blog-card__date"><?= e($post['date']) ?></p>
              <h3 class="blog-card__title"><a href="/blog/<?= e($post['slug']) ?>"><?= e($post['title']) ?></a></h3>
              <p class="blog-card__excerpt"><?= e($post['excerpt']) ?></p>
              <a href="/blog/<?= e($post['slug']) ?>" class="blog-card__link">Devamını Oku <?= icon('icon-arrow-right') ?></a>
            </article>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="faq-col">
        <div class="section-head">
          <h2>SIKÇA SORULAN SORULAR</h2>
          <a href="/sss" class="section-head__link">Tüm Sorular</a>
        </div>
        <div class="faq-accordion" id="faq-accordion">
          <?php foreach ($faqs as $i => $faq): ?>
            <div class="faq-item">
              <button type="button" class="faq-item__question" aria-expanded="false" aria-controls="faq-answer-<?= $i ?>" id="faq-question-<?= $i ?>">
                <span><?= e($faq['question']) ?></span>
                <?= icon('icon-plus', 'faq-item__toggle-icon') ?>
              </button>
              <div class="faq-item__answer" id="faq-answer-<?= $i ?>" role="region" aria-labelledby="faq-question-<?= $i ?>" hidden>
                <p><?= e($faq['answer']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(static fn (array $f) => [
        '@type' => 'Question',
        'name' => $f['question'],
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => $f['answer'],
        ],
    ], $faqs),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>
</script>
