<?php

function meta_tags($page = []): string
{
    global $site;

    $title = $page['meta_title'] ?? $site['name'] ?? 'Bornova Su Kaçak Tespiti';
    $description = $page['meta_description'] ?? $site['description'] ?? '';
    $keywords = $page['meta_keywords'] ?? '';
    $canonical = $page['canonical_url'] ?? '';

    $tags = '<meta charset="UTF-8">' . "\n";
    $tags .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
    $tags .= '<title>' . e($title) . '</title>' . "\n";

    if ($description) {
        $tags .= '<meta name="description" content="' . e($description) . '">' . "\n";
    }

    if ($keywords) {
        $tags .= '<meta name="keywords" content="' . e($keywords) . '">' . "\n";
    }

    // Open Graph tags
    $ogTitle = $page['og_title'] ?? $title;
    $ogDescription = $page['og_description'] ?? $description;

    $tags .= '<meta property="og:title" content="' . e($ogTitle) . '">' . "\n";
    $tags .= '<meta property="og:description" content="' . e($ogDescription) . '">' . "\n";
    $tags .= '<meta property="og:type" content="website">' . "\n";
    $tags .= '<meta property="og:site_name" content="' . e($site['name'] ?? '') . '">' . "\n";

    if ($canonical) {
        $tags .= '<link rel="canonical" href="' . e($canonical) . '">' . "\n";
    }

    return $tags;
}

function schema_faq($faqs = []): string
{
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array_map(function ($faq) {
            return [
                '@type' => 'Question',
                'name' => $faq['question'] ?? '',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'] ?? '',
                ],
            ];
        }, $faqs),
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}

function schema_local_business($site = []): string
{
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => $site['name'] ?? '',
        'description' => $site['description'] ?? '',
        'telephone' => $site['phone'] ?? '',
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Bornova',
            'addressRegion' => 'İzmir',
            'addressCountry' => 'TR',
        ],
        'url' => env('APP_URL', 'http://localhost:8000'),
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}

function schema_breadcrumb($breadcrumbs = []): string
{
    $items = [];
    $position = 1;

    foreach ($breadcrumbs as $breadcrumb) {
        $items[] = [
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => $breadcrumb['name'],
            'item' => env('APP_URL', 'http://localhost:8000') . $breadcrumb['url'],
        ];
    }

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $items,
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}

function schema_organization($site = []): string
{
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $site['name'] ?? '',
        'url' => env('APP_URL', 'http://localhost:8000'),
        'logo' => env('APP_URL', 'http://localhost:8000') . '/assets/img/logo.png',
        'description' => $site['description'] ?? '',
        'telephone' => $site['phone'] ?? '',
        'email' => $site['email'] ?? '',
        'sameAs' => [],
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}
