<?php
/** @var array $reviews */
/** @var array $site */
?>
<section class="reviews" aria-label="Müşteri Yorumları">
  <div class="container-xl">
    <div class="reviews__heading">
      <span class="reviews__google-g" aria-hidden="true">G</span>
      <h2>Google'dan Doğrulanmış Müşteri Yorumları</h2>
      <?php if (!empty($site['google_reviews_verified'])): ?>
        <span class="reviews__verified-badge" title="Google Business Profile ile doğrulanmıştır"><?= icon('icon-check-circle') ?></span>
      <?php endif; ?>
    </div>

    <div class="reviews__grid">
      <?php foreach ($reviews as $r): ?>
        <article class="review-card">
          <div class="review-card__head">
            <span class="review-card__avatar"><?= e(mb_substr($r['name'], 0, 1)) ?></span>
            <div>
              <p class="review-card__name"><?= e($r['name']) ?></p>
              <p class="review-card__time"><?= e($r['time_ago']) ?></p>
            </div>
          </div>
          <div class="review-card__stars">
            <?php for ($i = 0; $i < $r['rating']; $i++): ?><?= icon('icon-star') ?><?php endfor; ?>
          </div>
          <p class="review-card__text"><?= e($r['text']) ?></p>
          <a href="<?= e($site['google_maps_reviews_url'] ?? '#') ?>" class="review-card__link">
            Google'da görüntüle <span class="reviews__google-g reviews__google-g--sm" aria-hidden="true">G</span>
          </a>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="reviews__cta">
      <a href="/yorumlar" class="btn btn-outline-navy">TÜM YORUMLARI GÖRÜNTÜLE</a>
    </div>
  </div>
</section>
