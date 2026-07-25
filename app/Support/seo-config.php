<?php
/**
 * SEO Configuration
 * 20-year SEO expert optimization for Google first page ranking
 * Focus: Local SEO for water leak detection service in İzmir
 */

return [
    // Primary keywords (high commercial intent)
    'keywords' => [
        'primary' => [
            'su kaçağı tespiti',
            'su kaçak bulma',
            'tesisat kaçak',
            'gizli su kaçağı',
        ],
        'secondary' => [
            'tıkanıklık açma',
            'tesisat kurulumu',
            'petek bakımı',
            'kombi bakımı',
        ],
        'location' => [
            'Bornova su kaçağı',
            'İzmir su kaçak tespiti',
            'Alsancak tesisat ustası',
            'Konak su kaçağı',
            'Karşıyaka su tesisatçı',
        ],
        'long_tail' => [
            'evde su kaçağı nasıl bulunur',
            'su kaçağı tespit cihazı',
            'acil su kaçağı tamiri',
            'su kaçağından kurtulma',
            'yer altı su kaçağı tespiti',
        ],
    ],

    // Local SEO settings
    'local' => [
        'business_name' => 'Bornova Su Kaçak Tespiti',
        'city' => 'Bornova',
        'region' => 'İzmir',
        'country' => 'Turkey',
        'country_code' => 'TR',
        'postal_code' => '35040',
        'service_areas' => [
            'Bornova',
            'Alsancak',
            'Karşıyaka',
            'Konak',
            'Çiğli',
            'Balçova',
        ],
        'google_my_business_url' => 'https://www.google.com/maps/place/Bornova+Su+Kacak+Tespiti',
    ],

    // Structured data configuration
    'schema' => [
        'local_business' => true,
        'faq' => true,
        'breadcrumb' => true,
        'service' => true,
        'review' => true,
        'agg_rating' => true,
    ],

    // Open Graph & Social
    'og' => [
        'image_width' => 1200,
        'image_height' => 630,
        'type' => 'business.business',
    ],

    // Core Web Vitals targets
    'performance' => [
        'lcp_target' => 2500,    // Largest Contentful Paint: 2.5s
        'fid_target' => 100,     // First Input Delay: 100ms
        'cls_target' => 0.1,     // Cumulative Layout Shift: 0.1
    ],

    // Link building targets (for external strategy)
    'backlink_targets' => [
        'local_directories' => [
            'Google My Business',
            'Yelp',
            'Yandex.Maps',
            'Apple Maps',
        ],
        'industry_sites' => [
            'Yapı dekorasyon siteleri',
            'Tesisat forum ve önerileri',
            'Yerel işletme listeleri',
        ],
    ],
];
