<?php
/**
 * Admin Routes
 * Protected routes for admin panel (authentication required)
 * Loaded separately from public routes
 */

use App\Router\Router;
use App\Services\AuthService;

/** @var Router $router */

// Login routes (no auth required)
$router->get('/admin/login', function () {
    if (AuthService::isAuthenticated()) {
        header('Location: /admin');
        exit;
    }
    require __DIR__ . '/../app/Views/admin/login.php';
});

$router->post('/admin/login', function () {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    if (AuthService::login($email, $password, $remember)) {
        $redirect = $_GET['redirect'] ?? '/admin';
        header('Location: ' . $redirect);
        exit;
    }

    $error = 'Email veya şifre yanlış';
    require __DIR__ . '/../app/Views/admin/login.php';
});

$router->post('/admin/logout', function () {
    AuthService::logout();
    header('Location: /admin/login');
    exit;
});

// Protected admin routes
AuthService::requireAuth();

// Dashboard
$router->get('/admin', function () {
    $user = AuthService::user();
    global $site;
    require __DIR__ . '/../app/Views/admin/dashboard.php';
});

// Services Management
$router->get('/admin/hizmetler', function () {
    AuthService::requirePermission('manage_services');
    $services = \App\Models\Service::query()->get();
    $services = array_map(fn($s) => $s->toArray(), $services);
    require __DIR__ . '/../app/Views/admin/services/list.php';
});

$router->get('/admin/hizmetler/yeni', function () {
    AuthService::requirePermission('manage_services');
    $colors = ['blue', 'green', 'orange', 'purple'];
    require __DIR__ . '/../app/Views/admin/services/form.php';
});

$router->post('/admin/hizmetler', function () {
    AuthService::requirePermission('manage_services');
    $data = [
        'name' => $_POST['name'] ?? '',
        'slug' => $_POST['slug'] ?? '',
        'description' => $_POST['description'] ?? '',
        'short_description' => $_POST['short_description'] ?? '',
        'category_color' => $_POST['category_color'] ?? 'blue',
        'icon_name' => $_POST['icon_name'] ?? '',
        'cta_button_text' => $_POST['cta_button_text'] ?? '',
        'cta_button_url' => $_POST['cta_button_url'] ?? '',
        'checklist_items' => json_encode(array_filter(explode("\n", $_POST['checklist'] ?? ''))),
        'is_active' => isset($_POST['is_active']),
    ];
    $service = new \App\Models\Service($data);
    $service->save();
    header('Location: /admin/hizmetler?success=1');
    exit;
});

$router->get('/admin/hizmetler/{id}/duzenle', function ($id) {
    AuthService::requirePermission('manage_services');
    $service = \App\Models\Service::query()->find((int)$id);
    if (!$service) {
        header('HTTP/1.1 404 Not Found');
        exit;
    }
    $service = $service->toArray();
    $colors = ['blue', 'green', 'orange', 'purple'];
    require __DIR__ . '/../app/Views/admin/services/form.php';
});

$router->put('/admin/hizmetler/{id}', function ($id) {
    AuthService::requirePermission('manage_services');
    $service = \App\Models\Service::query()->find((int)$id);
    if (!$service) {
        header('HTTP/1.1 404 Not Found');
        exit;
    }
    $service->attributes['name'] = $_POST['name'] ?? '';
    $service->attributes['slug'] = $_POST['slug'] ?? '';
    $service->attributes['description'] = $_POST['description'] ?? '';
    $service->attributes['short_description'] = $_POST['short_description'] ?? '';
    $service->attributes['category_color'] = $_POST['category_color'] ?? 'blue';
    $service->attributes['icon_name'] = $_POST['icon_name'] ?? '';
    $service->attributes['cta_button_text'] = $_POST['cta_button_text'] ?? '';
    $service->attributes['cta_button_url'] = $_POST['cta_button_url'] ?? '';
    $service->attributes['checklist_items'] = json_encode(array_filter(explode("\n", $_POST['checklist'] ?? '')));
    $service->attributes['is_active'] = isset($_POST['is_active']);
    $service->save();
    header('Location: /admin/hizmetler?success=1');
    exit;
});

$router->delete('/admin/hizmetler/{id}', function ($id) {
    AuthService::requirePermission('manage_services');
    $service = \App\Models\Service::query()->find((int)$id);
    if ($service) {
        $service->delete();
    }
    header('Location: /admin/hizmetler?deleted=1');
    exit;
});

// CRM Leads
$router->get('/admin/crm/leads', function () {
    AuthService::requirePermission('view_leads');
    $status = $_GET['status'] ?? '';
    $query = \App\Models\Lead::query();
    if ($status) {
        $query->where('status', '=', $status);
    }
    $leads = $query->orderBy('created_at', 'DESC')->get();
    $leads = array_map(fn($l) => $l->toArray(), $leads);
    require __DIR__ . '/../app/Views/admin/crm/leads-list.php';
});

$router->get('/admin/crm/leads/{id}', function ($id) {
    AuthService::requirePermission('view_leads');
    $lead = \App\Models\Lead::query()->find((int)$id);
    if (!$lead) {
        header('HTTP/1.1 404 Not Found');
        exit;
    }
    $lead = $lead->toArray();
    $notes = \App\Models\CrmNote::query()->where('lead_id', '=', $id)->get();
    $notes = array_map(fn($n) => $n->toArray(), $notes);
    $tasks = \App\Models\CrmTask::query()->where('lead_id', '=', $id)->get();
    $tasks = array_map(fn($t) => $t->toArray(), $tasks);
    require __DIR__ . '/../app/Views/admin/crm/lead-detail.php';
});

$router->post('/admin/crm/leads/{id}/note', function ($id) {
    AuthService::requirePermission('manage_leads');
    $user = AuthService::user();
    $note = new \App\Models\CrmNote([
        'lead_id' => (int)$id,
        'user_id' => $user->attributes['id'],
        'content' => $_POST['content'] ?? '',
        'is_internal' => isset($_POST['is_internal']),
    ]);
    $note->save();
    header('Location: /admin/crm/leads/' . $id);
    exit;
});

$router->put('/admin/crm/leads/{id}/status', function ($id) {
    AuthService::requirePermission('manage_leads');
    $lead = \App\Models\Lead::query()->find((int)$id);
    if (!$lead) {
        header('HTTP/1.1 404 Not Found');
        exit;
    }
    $lead->attributes['status'] = $_POST['status'] ?? 'new';
    $lead->save();
    header('Location: /admin/crm/leads/' . $id);
    exit;
});

// FAQ Management
$router->get('/admin/sss', function () {
    AuthService::requirePermission('manage_content');
    $faqs = \App\Models\Faq::query()->orderBy('order_index', 'ASC')->get();
    $faqs = array_map(fn($f) => $f->toArray(), $faqs);
    require __DIR__ . '/../app/Views/admin/faq/list.php';
});

$router->post('/admin/sss', function () {
    AuthService::requirePermission('manage_content');
    $faq = new \App\Models\Faq([
        'question' => $_POST['question'] ?? '',
        'answer' => $_POST['answer'] ?? '',
        'category' => $_POST['category'] ?? '',
        'order_index' => (int)($_POST['order_index'] ?? 0),
        'is_active' => isset($_POST['is_active']),
    ]);
    $faq->save();
    header('Location: /admin/sss?success=1');
    exit;
});

// Blog Posts Management
$router->get('/admin/blog', function () {
    AuthService::requirePermission('manage_content');
    $posts = \App\Models\Post::query()->orderBy('published_at', 'DESC')->get();
    $posts = array_map(fn($p) => $p->toArray(), $posts);
    require __DIR__ . '/../app/Views/admin/blog/list.php';
});

$router->get('/admin/blog/yeni', function () {
    AuthService::requirePermission('manage_content');
    $post = null;
    require __DIR__ . '/../app/Views/admin/blog/form.php';
});

$router->post('/admin/blog', function () {
    AuthService::requirePermission('manage_content');
    $user = AuthService::user();
    $post = new \App\Models\Post([
        'title' => $_POST['title'] ?? '',
        'slug' => $_POST['slug'] ?? '',
        'content' => $_POST['content'] ?? '',
        'excerpt' => $_POST['excerpt'] ?? '',
        'author_id' => $user->attributes['id'],
        'category' => $_POST['category'] ?? '',
        'is_published' => isset($_POST['is_published']),
        'published_at' => isset($_POST['is_published']) ? date('Y-m-d H:i:s') : null,
    ]);
    $post->save();
    header('Location: /admin/blog?success=1');
    exit;
});

// Settings
$router->get('/admin/ayarlar', function () {
    AuthService::requirePermission('manage_settings');
    $config = \App\Models\SiteConfig::all();
    require __DIR__ . '/../app/Views/admin/settings.php';
});

$router->post('/admin/ayarlar', function () {
    AuthService::requirePermission('manage_settings');
    $updates = [
        'site_name', 'site_description', 'phone', 'whatsapp', 'email', 'location', 'google_reviews_verified'
    ];
    foreach ($updates as $key) {
        $value = $_POST[$key] ?? '';
        $existing = \App\Models\SiteConfig::query()->where('key', '=', $key)->first();
        if ($existing) {
            $existing->attributes['value'] = $value;
            $existing->save();
        } else {
            $config = new \App\Models\SiteConfig([
                'key' => $key,
                'value' => $value,
                'data_type' => $key === 'google_reviews_verified' ? 'boolean' : 'string',
            ]);
            $config->save();
        }
    }
    header('Location: /admin/ayarlar?success=1');
    exit;
});
