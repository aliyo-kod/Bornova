<?php
/** @var array $heroSlides */
/** @var array $site */
$slide = $heroSlides[0];
?>
<section class="hero" aria-label="Tanıtım">
  <div class="container-xl hero__inner">
    <div class="hero__text">
      <p class="hero__eyebrow"><?= e($slide['eyebrow']) ?></p>
      <h1 class="hero__title">
        <?= e($slide['title_line1']) ?><br>
        <span class="hero__title-accent"><?= e($slide['title_accent']) ?></span>
      </h1>
      <p class="hero__desc"><?= e($slide['description']) ?></p>

      <ul class="hero__badges">
        <?php foreach ($slide['badges'] as $badge): ?>
          <li class="hero__badge"><?= icon($badge['icon']) ?><span><?= e($badge['label']) ?></span></li>
        <?php endforeach; ?>
      </ul>

      <div class="hero__actions">
        <a href="<?= phone_href($site['phone_tel']) ?>" class="btn btn-primary btn-lg"><?= icon('icon-phone') ?> HEMEN ARA</a>
        <a href="<?= e($site['whatsapp_url']) ?>" class="btn btn-outline-white btn-lg"><?= icon('icon-whatsapp') ?> WHATSAPP</a>
      </div>
    </div>

    <div class="hero__media">
      <div class="hero__photo">
        <img src="/assets/img/hero-technician.png" alt="Su kaçağı tespiti yapan profesyonel teknisyen" style="width: 100%; height: 100%; object-fit: cover;">
      </div>
      <div class="hero__stat-card">
        <ul>
          <?php foreach ($slide['stat_card'] as $stat): ?>
            <li><?= icon($stat['icon']) ?><span><?= e($stat['label']) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>
