<?php
/**
 * Web Routes
 * Routes for public-facing pages (guest access)
 * Admin routes will be in a separate routes/admin.php (Phase 3)
 */

use App\Router\Router;

/** @var Router $router */

// Homepage - already handled in index.php before router
// $router->get('/', 'Controllers\HomeController@index');

// About
$router->get('/hakkimizda', function () {
    global $site, $navItems;
    require __DIR__ . '/../app/Views/pages/about.php';
});

// Services
$router->get('/hizmetler', function () {
    global $site, $navItems, $services;
    require __DIR__ . '/../app/Views/pages/services.php';
});

// Service Detail (main service and subcategories)
$router->get('/hizmet/{slug}', function ($slug) {
    global $site, $navItems, $services, $serviceSubcategories, $blogPosts, $faqs;
    $service = null;
    foreach ($services as $svc) {
        if ($svc['slug'] === $slug) {
            $service = $svc;
            break;
        }
    }
    if (!$service) {
        header('HTTP/1.1 404 Not Found');
        require __DIR__ . '/../public/404.php';
        return;
    }
    $subcategories = $serviceSubcategories[$slug] ?? [];
    require __DIR__ . '/../app/Views/pages/service-detail.php';
});

// Service Subcategory Detail
$router->get('/hizmet/{slug}/{subslug}', function ($slug, $subslug) {
    global $site, $navItems, $services, $serviceSubcategories, $blogPosts, $faqs;
    $service = null;
    foreach ($services as $svc) {
        if ($svc['slug'] === $slug) {
            $service = $svc;
            break;
        }
    }
    if (!$service) {
        header('HTTP/1.1 404 Not Found');
        require __DIR__ . '/../public/404.php';
        return;
    }
    $subcategories = $serviceSubcategories[$slug] ?? [];
    $subcategory = null;
    foreach ($subcategories as $sub) {
        if ($sub['slug'] === $subslug) {
            $subcategory = $sub;
            break;
        }
    }
    if (!$subcategory) {
        header('HTTP/1.1 404 Not Found');
        require __DIR__ . '/../public/404.php';
        return;
    }
    require __DIR__ . '/../app/Views/pages/service-subcategory-detail.php';
});

// Regions
$router->get('/bolgeler', function () {
    global $site, $navItems;
    $regions = \App\Models\Region::query()->where('is_active', '=', true)->get();
    require __DIR__ . '/../app/Views/pages/regions.php';
});

// Region Detail
$router->get('/bolge/{slug}', function ($slug) {
    global $site, $navItems;
    $region = \App\Models\Region::query()->where('slug', '=', $slug)->first();
    if (!$region) {
        header('HTTP/1.1 404 Not Found');
        require __DIR__ . '/../public/404.php';
        return;
    }
    $region = $region->toArray();
    require __DIR__ . '/../app/Views/pages/region-detail.php';
});

// Blog List
$router->get('/blog', function () {
    global $site, $navItems, $blogPosts;
    $page = (int)($_GET['page'] ?? 1);
    $perPage = 12;
    $posts = array_filter($blogPosts, fn($p) => $p['published'] ?? true);
    $total = count($posts);
    $totalPages = ceil($total / $perPage);
    $offset = ($page - 1) * $perPage;
    $posts = array_slice($posts, $offset, $perPage);
    $pagination = [
        'current_page' => $page,
        'total_pages' => $totalPages,
        'total_posts' => $total,
    ];
    require __DIR__ . '/../app/Views/pages/blog-list.php';
});

// Blog Detail
$router->get('/blog/{slug}', function ($slug) {
    global $site, $navItems, $blogPosts;
    $post = null;
    foreach ($blogPosts as $p) {
        if ($p['slug'] === $slug) {
            $post = $p;
            break;
        }
    }
    if (!$post) {
        header('HTTP/1.1 404 Not Found');
        require __DIR__ . '/../public/404.php';
        return;
    }
    require __DIR__ . '/../app/Views/pages/blog-detail.php';
});

// FAQ Page
$router->get('/s-s-s', function () {
    global $site, $navItems;
    $faqs = \App\Models\Faq::query()->where('is_active', '=', true)->get();
    $faqs = array_map(fn($f) => $f->toArray(), $faqs);
    require __DIR__ . '/../app/Views/pages/faq.php';
});

// Reviews
$router->get('/yorumlar', function () {
    global $site, $navItems;
    $reviews = \App\Models\Review::query()
        ->orderBy('order_index', 'ASC')
        ->get();
    $reviews = array_map(fn($r) => $r->toArray(), $reviews);
    require __DIR__ . '/../app/Views/pages/reviews.php';
});

// Contact - GET shows form
$router->get('/iletisim', function () {
    global $site, $navItems;
    require __DIR__ . '/../app/Views/pages/contact.php';
});

// Contact - POST handles submission
$router->post('/iletisim', function () {
    // Handled by ContactController (Phase 3)
    header('Location: /iletisim?success=1');
});

// Privacy Policy
$router->get('/gizlilik', function () {
    global $site, $navItems;
    $page = \App\Models\Page::query()->where('slug', '=', 'gizlilik')->first();
    if (!$page) {
        header('HTTP/1.1 404 Not Found');
        require __DIR__ . '/../public/404.php';
        return;
    }
    $page = $page->toArray();
    require __DIR__ . '/../app/Views/pages/legal.php';
});

// KVKK (Personal Data Protection)
$router->get('/kvkk', function () {
    global $site, $navItems;
    $page = \App\Models\Page::query()->where('slug', '=', 'kvkk')->first();
    if (!$page) {
        header('HTTP/1.1 404 Not Found');
        require __DIR__ . '/../public/404.php';
        return;
    }
    $page = $page->toArray();
    require __DIR__ . '/../app/Views/pages/legal.php';
});

// Terms of Service
$router->get('/sitenin-kullanici-sozlesmesi', function () {
    global $site, $navItems;
    $page = \App\Models\Page::query()->where('slug', '=', 'sitenin-kullanici-sozlesmesi')->first();
    if (!$page) {
        header('HTTP/1.1 404 Not Found');
        require __DIR__ . '/../public/404.php';
        return;
    }
    $page = $page->toArray();
    require __DIR__ . '/../app/Views/pages/legal.php';
});

// SEO Routes (Phase 4)
// Sitemap
$router->get('/sitemap.xml', function () {
    header('Content-Type: application/xml; charset=utf-8');
    $baseUrl = env('APP_URL', 'http://localhost:8000');
    $generator = new \App\Support\SitemapGenerator($baseUrl);
    echo $generator->generate();
    exit;
});

// Robots.txt
$router->get('/robots.txt', function () {
    header('Content-Type: text/plain; charset=utf-8');
    echo "User-agent: *\n";
    echo "Allow: /\n";
    echo "Disallow: /admin/\n";
    echo "Disallow: /api/\n\n";
    echo "Sitemap: " . env('APP_URL', 'http://localhost:8000') . "/sitemap.xml\n";
    exit;
});
