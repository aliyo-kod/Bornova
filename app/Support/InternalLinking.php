<?php

namespace App\Support;

/**
 * Internal Linking Strategy
 * SEO expert linking architecture for page authority distribution
 * Focus: Keyword relevance, user experience, crawlability
 */
class InternalLinking
{
    public static function getRelatedServices($currentServiceId = null): array
    {
        // Semantic relationship map for related services
        $relationships = [
            'su-kacagi-tespiti' => ['tisikat-kurulumu', 'drenaj-sistemleri'],
            'tisikat-kurulumu' => ['su-kacagi-tespiti', 'boru-degisimi'],
            'tikaniklik-acma' => ['su-kacagi-tespiti', 'drenaj-sistemleri'],
            'petek-kombi-bakimi' => ['tisikat-kurulumu', 'yer-altı-suyu'],
        ];

        return $relationships[$currentServiceId] ?? [];
    }

    public static function getRelatedBlogPosts($currentPostId = null, $limit = 3): array
    {
        // Returns IDs of semantically related blog posts
        // Should be called with actual post IDs from database
        $relationships = [
            'su-kacagi-nasil-bulunur' => ['su-kacagi-onemleri', 'acil-serviste-neler-yapilir'],
            'kombi-bakimi-ipuclari' => ['petek-temizligi', 'tesisatin-genel-bakim-rehberi'],
            'zemin-altı-kaçak-tespiti' => ['su-kaçağı-belirtileri', 'harita-ve-cihaz-ile-tespiti'],
        ];

        $related = $relationships[$currentPostId] ?? [];
        return array_slice($related, 0, $limit);
    }

    public static function getBreadcrumbSchema($currentPage): string
    {
        $breadcrumbs = [];

        // Anasayfa
        $breadcrumbs[] = [
            'name' => 'Anasayfa',
            'url' => '/',
        ];

        // Kategori (opsiyonel)
        if (isset($currentPage['category'])) {
            $breadcrumbs[] = [
                'name' => $currentPage['category'],
                'url' => '/' . $currentPage['category_slug'] ?? '/',
            ];
        }

        // Mevcut sayfa
        $breadcrumbs[] = [
            'name' => $currentPage['name'] ?? 'Sayfa',
            'url' => $currentPage['url'] ?? '/',
        ];

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => array_map(function ($item, $index) {
                return [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $item['name'],
                    'item' => env('APP_URL', 'http://localhost:8000') . $item['url'],
                ];
            }, $breadcrumbs, array_keys($breadcrumbs)),
        ];

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }

    public static function getFooterLinks(): array
    {
        return [
            // Hizmetler
            [
                'title' => 'Hizmetlerimiz',
                'links' => [
                    'Su Kaçağı Tespiti' => '/hizmet/su-kacagi-tespiti',
                    'Tesisat Kurulumu' => '/hizmet/tisikat-kurulumu',
                    'Tıkanıklık Açma' => '/hizmet/tikaniklik-acma',
                    'Kombi & Petek' => '/hizmet/petek-kombi-bakimi',
                ],
            ],
            // Bölgeler
            [
                'title' => 'Hizmet Bölgeleri',
                'links' => [
                    'Bornova' => '/bolge/bornova',
                    'Alsancak' => '/bolge/alsancak',
                    'Karşıyaka' => '/bolge/karsiyaka',
                    'Konak' => '/bolge/konak',
                ],
            ],
            // İçerik
            [
                'title' => 'İçerik',
                'links' => [
                    'Blog' => '/blog',
                    'S.S.S' => '/s-s-s',
                    'Müşteri Yorumları' => '/yorumlar',
                    'Hakkımızda' => '/hakkimizda',
                ],
            ],
            // Yasal
            [
                'title' => 'Yasal',
                'links' => [
                    'Gizlilik Politikası' => '/gizlilik',
                    'KVKK' => '/kvkk',
                    'Kullanım Şartları' => '/sitenin-kullanici-sozlesmesi',
                    'İletişim' => '/iletisim',
                ],
            ],
        ];
    }

    public static function getNavigationLinks(): array
    {
        return [
            ['title' => 'Hakkımızda', 'url' => '/hakkimizda', 'keyword' => 'hakkımızda'],
            ['title' => 'Hizmetler', 'url' => '/hizmetler', 'keyword' => 'hizmetler'],
            ['title' => 'Blog', 'url' => '/blog', 'keyword' => 'blog'],
            ['title' => 'İletişim', 'url' => '/iletisim', 'keyword' => 'iletisim'],
        ];
    }

    public static function getInternalLink($keyword, $url = null): string
    {
        if (!$url) {
            // Smart URL detection based on keyword
            if (strpos($keyword, 'su kaçağı') !== false) {
                $url = '/hizmet/su-kacagi-tespiti';
            } elseif (strpos($keyword, 'tesisat') !== false) {
                $url = '/hizmet/tisikat-kurulumu';
            } elseif (strpos($keyword, 'blog') !== false) {
                $url = '/blog';
            } else {
                $url = '/';
            }
        }

        return '<a href="' . $url . '" title="' . e($keyword) . '">' . e($keyword) . '</a>';
    }
}
