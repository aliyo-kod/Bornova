<?php
/**
 * Front controller.
 * Phase 1: serves the homepage directly using plain-array data sources.
 * Phase 2: router dispatches to controllers; views work with model objects that toArray() to same shapes.
 */

declare(strict_types=1);

require __DIR__ . '/../app/Support/helpers.php';
require __DIR__ . '/../vendor/autoload.php';

use App\Router\Router;
use App\Models\{HeroSlider, Service, Review, Video, Post, Faq, SiteConfig};

$router = new Router();

// Load route definitions
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
if (strpos($currentPath, '/admin') === 0) {
    require __DIR__ . '/../routes/admin.php';
} else {
    require __DIR__ . '/../routes/web.php';
}

$currentPath = $router->getPath();

// For now, use Phase 1 data arrays (database integration in Phase 2+)
if (true) {
    // Phase 1: Load plain-array data sources
    $dataPath = __DIR__ . '/../app/Data/';

    $site        = require $dataPath . 'site.php';
    $navItems    = require $dataPath . 'nav.php';
    $heroSlides  = require $dataPath . 'hero.php';
    $services    = require $dataPath . 'services.php';
    $reviews     = require $dataPath . 'reviews.php';
    $videos      = require $dataPath . 'videos.php';
    $blogPosts   = require $dataPath . 'blog-posts.php';
    $faqs        = require $dataPath . 'faqs.php';
    $serviceSubcategories = require $dataPath . 'service-subcategories.php';
}

// Route to appropriate view
if ($currentPath === '/' || $currentPath === '') {
    require __DIR__ . '/../app/Views/pages/home.php';
} else {
    $router->dispatch();
}
