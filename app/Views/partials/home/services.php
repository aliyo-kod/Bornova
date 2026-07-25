<?php
/** @var array $services */
?>
<section class="services" aria-label="Hizmetlerimiz">
  <div class="container-xl">
    <div class="services__grid">
      <?php foreach ($services as $svc): ?>
        <article class="service-card service-card--<?= e($svc['color']) ?>">
          <div class="service-card__header">
            <span class="service-card__icon"><?= icon($svc['icon']) ?></span>
            <h2 class="service-card__title"><?= mb_strtoupper(e($svc['title']), 'UTF-8') ?></h2>
          </div>
          <div class="service-card__image" data-placeholder="true">
            <?= icon($svc['image_icon'], 'service-card__image-icon') ?>
          </div>
          <ul class="service-card__list">
            <?php foreach ($svc['items'] as $line): ?>
              <li><?= icon('icon-check') ?><span><?= e($line) ?></span></li>
            <?php endforeach; ?>
          </ul>
          <a href="/hizmet/<?= e($svc['slug']) ?>" class="btn service-card__btn">
            DETAYLI İNCELE <?= icon('icon-arrow-right') ?>
          </a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
