<?php
/**
 * Advanced Schema.org Markup
 * Complete structured data for Google Rich Snippets & Knowledge Panel
 */

function schema_local_business_full(): string
{
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        '@id' => env('APP_URL', 'http://localhost:8000'),
        'name' => 'Bornova Su Kaçak Tespiti',
        'image' => env('APP_URL', 'http://localhost:8000') . '/assets/img/logo.png',
        'description' => 'İzmir Bornova bölgesinde profesyonel su kaçağı tespiti, tesisat kurulumu ve bakım hizmetleri. 20+ yıl deneyim.',
        'url' => env('APP_URL', 'http://localhost:8000'),
        'telephone' => '+90 555 123 4567',
        'email' => 'info@bornova-sukacak.com',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Bornova, İzmir',
            'addressLocality' => 'Bornova',
            'addressRegion' => 'İzmir',
            'postalCode' => '35040',
            'addressCountry' => 'TR',
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => '38.3949',
            'longitude' => '27.1769',
        ],
        'areaServed' => [
            '@type' => 'City',
            'name' => 'Bornova',
        ],
        'priceRange' => '₺₺',
        'openingHoursSpecification' => [
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                'opens' => '09:00',
                'closes' => '18:00',
            ],
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => 'Sunday',
                'opens' => '10:00',
                'closes' => '16:00',
            ],
        ],
        'sameAs' => [
            'https://www.google.com/maps/place/Bornova',
            'https://www.facebook.com/bornova-su-kacak',
        ],
        'founder' => [
            '@type' => 'Person',
            'name' => 'Bornova Su Kaçak Tespiti',
        ],
        'foundingDate' => '2004',
        'knowsAbout' => [
            'Su kaçağı tespiti',
            'Tesisat sistemi',
            'Drenaj sistemleri',
            'Boru tesisatı',
            'Kombi bakımı',
            'Petek temizliği',
        ],
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}

function schema_service(array $service): string
{
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        '@id' => env('APP_URL', 'http://localhost:8000') . '/hizmet/' . ($service['slug'] ?? ''),
        'name' => $service['name'] ?? '',
        'description' => $service['short_description'] ?? $service['description'] ?? '',
        'image' => env('APP_URL', 'http://localhost:8000') . '/assets/img/service-' . ($service['category_color'] ?? 'blue') . '.jpg',
        'url' => env('APP_URL', 'http://localhost:8000') . '/hizmet/' . ($service['slug'] ?? ''),
        'provider' => [
            '@type' => 'LocalBusiness',
            'name' => 'Bornova Su Kaçak Tespiti',
            'url' => env('APP_URL', 'http://localhost:8000'),
        ],
        'areaServed' => [
            '@type' => 'City',
            'name' => 'Bornova, İzmir',
        ],
        'priceRange' => '₺₺',
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => $service['name'] ?? '',
            'itemListElement' => array_map(function ($item, $index) {
                return [
                    '@type' => 'Offer',
                    'position' => $index + 1,
                    'name' => $item,
                ];
            }, $service['checklist'] ?? [], array_keys($service['checklist'] ?? [])),
        ],
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}

function schema_aggregate_rating($rating = 4.8, $ratingCount = 45): string
{
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'Bornova Su Kaçak Tespiti',
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => $rating,
            'reviewCount' => $ratingCount,
            'bestRating' => 5,
            'worstRating' => 1,
        ],
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}

function schema_article($post): string
{
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        '@id' => env('APP_URL', 'http://localhost:8000') . '/blog/' . ($post['slug'] ?? ''),
        'headline' => $post['title'] ?? '',
        'description' => $post['excerpt'] ?? '',
        'image' => env('APP_URL', 'http://localhost:8000') . '/assets/img/blog.jpg',
        'datePublished' => $post['published_at'] ?? date('Y-m-d'),
        'dateModified' => $post['updated_at'] ?? $post['published_at'] ?? date('Y-m-d'),
        'author' => [
            '@type' => 'Organization',
            'name' => 'Bornova Su Kaçak Tespiti',
            'url' => env('APP_URL', 'http://localhost:8000'),
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Bornova Su Kaçak Tespiti',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => env('APP_URL', 'http://localhost:8000') . '/assets/img/logo.png',
            ],
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => env('APP_URL', 'http://localhost:8000') . '/blog/' . ($post['slug'] ?? ''),
        ],
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}

function schema_review_aggregate($reviews = []): string
{
    $totalRating = 0;
    $ratingCount = 0;

    foreach ($reviews as $review) {
        if (isset($review['rating'])) {
            $totalRating += $review['rating'];
            $ratingCount++;
        }
    }

    $avgRating = $ratingCount > 0 ? round($totalRating / $ratingCount, 1) : 4.8;

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        '@id' => env('APP_URL', 'http://localhost:8000'),
        'name' => 'Bornova Su Kaçak Tespiti',
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => $avgRating,
            'reviewCount' => $ratingCount,
        ],
        'review' => array_map(function ($review) {
            return [
                '@type' => 'Review',
                'author' => [
                    '@type' => 'Person',
                    'name' => $review['name'] ?? 'Müşteri',
                ],
                'reviewRating' => [
                    '@type' => 'Rating',
                    'ratingValue' => $review['rating'] ?? 5,
                ],
                'reviewBody' => $review['comment'] ?? '',
            ];
        }, $reviews),
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}

function schema_contact_point(): string
{
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'ContactPoint',
        'telephone' => '+90 555 123 4567',
        'contactType' => 'Customer Service',
        'email' => 'info@bornova-sukacak.com',
        'areaServed' => 'TR',
        'availableLanguage' => 'tr',
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}

function schema_thing_with_image($title, $description, $imageUrl): string
{
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Thing',
        'name' => $title,
        'description' => $description,
        'image' => $imageUrl,
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}
