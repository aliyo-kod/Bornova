<?php
/** @var array $videos */
?>
<section class="videos" aria-label="Animasyonlar">
  <div class="container-xl">
    <div class="videos__grid">
      <?php foreach ($videos as $v): ?>
        <div class="video-card video-card--<?= e($v['color']) ?>" data-video-src="<?= e($v['video_url']) ?>" data-video-title="<?= e($v['title']) ?>">
          <div class="video-card__bg" data-placeholder="true"><?= icon($v['icon'], 'video-card__bg-icon') ?></div>
          <div class="video-card__overlay">
            <h3 class="video-card__title"><?= e($v['title']) ?></h3>
            <p class="video-card__subtitle"><?= e($v['subtitle']) ?></p>
            <button type="button" class="btn video-card__btn">
              ANİMASYONU İZLE <span class="video-card__play"><?= icon('icon-play') ?></span>
            </button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
