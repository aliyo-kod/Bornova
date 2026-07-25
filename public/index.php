<?php
/**
 * Front controller.
 * Phase 1: serves the homepage directly using plain-array data sources.
 * Phase 2: this becomes a real router dispatching routes/web.php to controllers;
 * the view files themselves are already shaped to not require changes.
 */

declare(strict_types=1);

require __DIR__ . '/../app/Support/helpers.php';

$dataPath = __DIR__ . '/../app/Data/';

$site        = require $dataPath . 'site.php';
$navItems    = require $dataPath . 'nav.php';
$heroSlides  = require $dataPath . 'hero.php';
$services    = require $dataPath . 'services.php';
$reviews     = require $dataPath . 'reviews.php';
$videos      = require $dataPath . 'videos.php';
$blogPosts   = require $dataPath . 'blog.php';
$faqs        = require $dataPath . 'faqs.php';

$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

require __DIR__ . '/../app/Views/pages/home.php';
