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
require __DIR__ . '/../routes/web.php';

$currentPath = $router->getPath();

// Try to load from database; fallback to Phase 1 data arrays
$useDatabase = false;
try {
    if (class_exists('App\Database\Connection')) {
        $useDatabase = true;
    }
} catch (\Exception $e) {
    // Database not available, use Phase 1 data arrays
}

if ($useDatabase) {
    // Phase 2: Load data from database models
    try {
        $site = [
            'name' => SiteConfig::get('site_name', 'Bornova Su Kaçak Tespiti'),
            'description' => SiteConfig::get('site_description', ''),
            'phone' => SiteConfig::get('phone', ''),
            'whatsapp' => SiteConfig::get('whatsapp', ''),
            'email' => SiteConfig::get('email', ''),
            'location' => SiteConfig::get('location', ''),
            'working_hours' => SiteConfig::get('working_hours', []),
            'google_reviews_verified' => SiteConfig::get('google_reviews_verified', false),
        ];

        $heroSlides = array_map(fn($h) => $h->toArray(), HeroSlider::active());
        $services = array_map(fn($s) => $s->toArray(), Service::active());
        $reviews = array_map(fn($r) => $r->toArray(), Review::featured());
        $videos = array_map(fn($v) => $v->toArray(), Video::active());
        $blogPosts = array_map(fn($p) => $p->toArray(), Post::featured());
        $faqs = array_map(fn($f) => $f->toArray(), Faq::active());
        $navItems = require __DIR__ . '/../app/Data/nav.php'; // Navigation stays static for now
    } catch (\Exception $e) {
        // Fallback to Phase 1 data if database query fails
        $useDatabase = false;
    }
}

if (!$useDatabase) {
    // Phase 1: Load plain-array data sources
    $dataPath = __DIR__ . '/../app/Data/';

    $site        = require $dataPath . 'site.php';
    $navItems    = require $dataPath . 'nav.php';
    $heroSlides  = require $dataPath . 'hero.php';
    $services    = require $dataPath . 'services.php';
    $reviews     = require $dataPath . 'reviews.php';
    $videos      = require $dataPath . 'videos.php';
    $blogPosts   = require $dataPath . 'blog.php';
    $faqs        = require $dataPath . 'faqs.php';
}

// Route to appropriate view
if ($currentPath === '/' || $currentPath === '') {
    require __DIR__ . '/../app/Views/pages/home.php';
} else {
    $router->dispatch();
}
