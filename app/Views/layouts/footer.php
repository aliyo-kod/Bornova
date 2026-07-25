<?php
/** @var array $site */
/** @var array $services */
?>
<section class="cta-band">
  <div class="container-xl cta-band__inner">
    <div class="cta-band__text">
      <h2 class="cta-band__title">Bornova'da Su Kaçağını Ertelemeyin!</h2>
      <p class="cta-band__desc">Daha büyük hasarlara yol açmadan, hemen uzman ekibimizden destek alın.</p>
    </div>
    <div class="cta-band__actions">
      <a href="<?= phone_href($site['phone_tel']) ?>" class="btn btn-navy"><?= icon('icon-phone') ?> <?= e($site['phone_display']) ?></a>
      <a href="<?= e($site['whatsapp_url']) ?>" class="btn btn-outline-white"><?= icon('icon-whatsapp') ?> WHATSAPP</a>
    </div>
    <svg class="cta-band__deco" viewBox="0 0 200 200" aria-hidden="true">
      <circle cx="150" cy="40" r="26" fill="rgba(255,255,255,.12)"/>
      <circle cx="180" cy="110" r="14" fill="rgba(255,255,255,.14)"/>
      <circle cx="120" cy="150" r="34" fill="rgba(255,255,255,.10)"/>
      <path d="M0 170 Q 50 140 100 170 T 200 170 V200 H0 Z" fill="rgba(255,255,255,.08)"/>
    </svg>
  </div>
</section>

<footer class="site-footer">
  <div class="container-xl">
    <div class="footer-grid">
      <div class="footer-col footer-col--brand">
        <a href="/" class="brand brand--footer">
          <span class="brand__logo"><?= icon('icon-drop') ?></span>
          <span class="brand__text">
            <span class="brand__title">BORNOVA</span>
            <span class="brand__subtitle">SU KAÇAK TESPİTİ</span>
          </span>
        </a>
        <p class="footer-col__desc">Bornova ve çevresinde kırmadan, dökmeden su kaçağı tespiti hizmeti sunuyoruz.</p>
        <div class="footer-social">
          <a href="<?= e($site['facebook_url']) ?>" aria-label="Facebook"><?= icon('icon-facebook') ?></a>
          <a href="<?= e($site['instagram_url']) ?>" aria-label="Instagram"><?= icon('icon-instagram') ?></a>
          <a href="<?= e($site['whatsapp_url']) ?>" aria-label="WhatsApp"><?= icon('icon-whatsapp') ?></a>
        </div>
      </div>

      <div class="footer-col">
        <h3 class="footer-col__title">HİZMETLERİMİZ</h3>
        <ul class="footer-links">
          <?php foreach ($services as $svc): ?>
            <li><a href="/hizmet/<?= e($svc['slug']) ?>"><?= e($svc['title']) ?></a></li>
          <?php endforeach; ?>
          <li><a href="/hizmet/su-kacagi-tespiti/kamera-ile-boru-goruntuleme">Kamera ile Boru Görüntüleme</a></li>
          <li><a href="/hizmet/su-kacagi-tespiti/kacak-tespit-raporu">Kaçak Tespit Raporu</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h3 class="footer-col__title">BÖLGELERİMİZ</h3>
        <ul class="footer-links">
          <li><a href="/bolge/bornova">Bornova</a></li>
          <li><a href="/bolge/kazimdirik">Kazımdirik</a></li>
          <li><a href="/bolge/evka-3">Evka 3</a></li>
          <li><a href="/bolge/mevlana">Mevlana</a></li>
          <li><a href="/bolge/pinarbasi">Pınarbaşı</a></li>
          <li><a href="/bolgeler">Daha fazlası...</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h3 class="footer-col__title">İLETİŞİM</h3>
        <ul class="footer-links footer-links--contact">
          <li><a href="<?= phone_href($site['phone_tel']) ?>"><?= icon('icon-phone', 'icon-sm') ?> <?= e($site['phone_display']) ?></a></li>
          <li><a href="<?= phone_href($site['phone_secondary']) ?>"><?= icon('icon-phone', 'icon-sm') ?> <?= e($site['phone_secondary']) ?></a></li>
          <li><a href="mailto:<?= e($site['email']) ?>"><?= icon('icon-mail', 'icon-sm') ?> <?= e($site['email']) ?></a></li>
          <li><span><?= icon('icon-pin', 'icon-sm') ?> <?= e($site['address']) ?></span></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?= date('Y') ?> <?= e($site['site_name']) ?>. Tüm Hakları Saklıdır.</p>
      <ul class="footer-legal">
        <li><a href="/gizlilik-politikasi">Gizlilik Politikası</a></li>
        <li><a href="/kvkk">KVKK</a></li>
        <li><a href="/cerez-politikasi">Çerez Politikası</a></li>
        <li><a href="/kullanim-kosullari">Kullanım Koşulları</a></li>
      </ul>
    </div>
  </div>
</footer>

<div class="mobile-sticky-cta">
  <a href="<?= phone_href($site['phone_tel']) ?>" class="mobile-sticky-cta__btn mobile-sticky-cta__btn--call"><?= icon('icon-phone') ?> Ara</a>
  <a href="<?= e($site['whatsapp_url']) ?>" class="mobile-sticky-cta__btn mobile-sticky-cta__btn--whatsapp"><?= icon('icon-whatsapp') ?> WhatsApp</a>
</div>

<div class="modal" id="video-modal" aria-hidden="true">
  <div class="modal__backdrop" data-modal-close></div>
  <div class="modal__dialog" role="dialog" aria-modal="true" aria-labelledby="video-modal-title">
    <button type="button" class="modal__close" data-modal-close aria-label="Kapat"><?= icon('icon-close') ?></button>
    <h2 class="visually-hidden" id="video-modal-title">Video oynatıcı</h2>
    <div class="modal__body" id="video-modal-body"></div>
  </div>
</div>

<script src="<?= asset('js/modules/nav.js') ?>" defer></script>
<script src="<?= asset('js/modules/accordion.js') ?>" defer></script>
<script src="<?= asset('js/modules/modal.js') ?>" defer></script>
<script src="<?= asset('js/main.js') ?>" defer></script>
</body>
</html>
