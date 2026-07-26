<?php
/** @var array $site */
/** @var array $navItems */
$currentPath = $currentPath ?? '/';
?>
<!doctype html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($site['site_name']) ?> | Bornova Su Kaçağı Tespiti, Tıkanıklık Açma, Tesisat ve Kombi Servisi</title>
<meta name="description" content="Bornova ve çevresinde kırmadan su kaçağı tespiti, tıkanıklık açma, tesisat kurulumu ve kombi/petek servisi. 7/24 profesyonel ve garantili hizmet.">
<link rel="icon" href="data:,">
<link rel="preload" as="font" type="font/woff2" href="<?= asset('fonts/inter-latin.woff2') ?>" crossorigin>
<link rel="preload" as="font" type="font/woff2" href="<?= asset('fonts/manrope-latin.woff2') ?>" crossorigin>
<link rel="stylesheet" href="<?= asset('vendor/bootstrap/bootstrap-grid.min.css') ?>">
<link rel="stylesheet" href="<?= asset('vendor/bootstrap/bootstrap-utilities.min.css') ?>">
<link rel="stylesheet" href="<?= asset('css/main.css') ?>">
</head>
<body>

<div class="topbar">
  <div class="container-xl topbar__inner">
    <div class="topbar__left">
      <span class="topbar__item"><?= icon('icon-pin', 'icon-sm') ?> <?= e($site['working_hours']) ?></span>
    </div>
    <div class="topbar__center">
      <a class="topbar__item" href="mailto:<?= e($site['email']) ?>"><?= icon('icon-mail', 'icon-sm') ?> <?= e($site['email']) ?></a>
    </div>
    <div class="topbar__right">
      <a href="<?= e($site['facebook_url']) ?>" aria-label="Facebook" class="topbar__social"><?= icon('icon-facebook') ?></a>
      <a href="<?= e($site['instagram_url']) ?>" aria-label="Instagram" class="topbar__social"><?= icon('icon-instagram') ?></a>
      <a href="<?= e($site['whatsapp_url']) ?>" aria-label="WhatsApp" class="topbar__social"><?= icon('icon-whatsapp') ?></a>
    </div>
  </div>
</div>

<header class="site-header" id="site-header">
  <div class="container-xl site-header__inner">
    <a href="/" class="brand">
      <img src="/assets/img/logo-header.png" alt="Bornova Su Kaçak Tespiti Logo" class="brand__logo-img" style="height: 45px; width: auto;">
    </a>

    <button type="button" class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="main-nav" aria-label="Menüyü aç/kapat">
      <?= icon('icon-menu', 'nav-toggle__icon-open') ?>
      <?= icon('icon-close', 'nav-toggle__icon-close') ?>
    </button>

    <nav class="main-nav" id="main-nav">
      <ul class="main-nav__list">
        <?php foreach ($navItems as $item): $hasChildren = !empty($item['children']); ?>
          <li class="main-nav__item<?= $hasChildren ? ' has-dropdown' : '' ?>">
            <a href="<?= e($item['url']) ?>" class="main-nav__link<?= is_active_url($item['url'], $currentPath) ? ' is-active' : '' ?>">
              <?= e($item['label']) ?>
              <?php if ($hasChildren): ?><?= icon('icon-chevron-down', 'main-nav__chevron') ?><?php endif; ?>
            </a>
            <?php if ($hasChildren): ?>
              <ul class="main-nav__dropdown">
                <?php foreach ($item['children'] as $child): ?>
                  <li><a href="<?= e($child['url']) ?>"><?= e($child['label']) ?></a></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <a href="<?= phone_href($site['phone_tel']) ?>" class="header-phone">
      <span class="header-phone__icon"><?= icon('icon-phone') ?></span>
      <span class="header-phone__text">
        <span class="header-phone__label">7/24 BİZE ULAŞIN</span>
        <span class="header-phone__number"><?= e($site['phone_display']) ?></span>
      </span>
    </a>
  </div>
</header>

<div class="nav-backdrop" id="nav-backdrop"></div>
