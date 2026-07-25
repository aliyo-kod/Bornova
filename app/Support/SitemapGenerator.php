<?php

namespace App\Support;

use App\Models\{Service, Post, Page, Region};

class SitemapGenerator
{
    private array $urls = [];
    private string $baseUrl;

    public function __construct(string $baseUrl = 'http://localhost:8000')
    {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    public function generate(): string
    {
        $this->urls = [];

        // Static pages
        $this->addUrl('/', 0.9);
        $this->addUrl('/hakkimizda', 0.8);
        $this->addUrl('/hizmetler', 0.8);
        $this->addUrl('/bolgeler', 0.8);
        $this->addUrl('/blog', 0.8);
        $this->addUrl('/s-s-s', 0.8);
        $this->addUrl('/iletisim', 0.7);

        // Services
        $services = Service::query()->where('is_active', '=', true)->get();
        foreach ($services as $service) {
            $this->addUrl('/hizmet/' . $service->attributes['slug'], 0.8);
        }

        // Regions
        $regions = Region::query()->where('is_active', '=', true)->get();
        foreach ($regions as $region) {
            $this->addUrl('/bolge/' . $region->attributes['slug'], 0.8);
        }

        // Blog posts
        $posts = Post::query()->where('is_published', '=', true)->get();
        foreach ($posts as $post) {
            $date = $post->attributes['published_at'] ?? '';
            $this->addUrl('/blog/' . $post->attributes['slug'], 0.7, $date);
        }

        // Legal pages
        $this->addUrl('/gizlilik', 0.5);
        $this->addUrl('/kvkk', 0.5);
        $this->addUrl('/sitenin-kullanici-sozlesmesi', 0.5);

        return $this->renderXml();
    }

    private function addUrl(string $path, float $priority = 0.5, string $lastMod = ''): void
    {
        $this->urls[] = [
            'loc' => $this->baseUrl . $path,
            'priority' => $priority,
            'lastmod' => $lastMod ?: date('Y-m-d'),
        ];
    }

    private function renderXml(): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($this->urls as $url) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($url['loc']) . '</loc>' . "\n";
            $xml .= '    <lastmod>' . $url['lastmod'] . '</lastmod>' . "\n";
            $xml .= '    <priority>' . $url['priority'] . '</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }
}
