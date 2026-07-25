<?php

namespace App\Support;

/**
 * Performance Optimizer
 * Google Core Web Vitals optimization
 * LCP (Largest Contentful Paint) < 2.5s
 * FID (First Input Delay) < 100ms
 * CLS (Cumulative Layout Shift) < 0.1
 */
class PerformanceOptimizer
{
    public static function getHeaderOptimizations(): string
    {
        return <<<HTML
<!-- Preload critical resources -->
<link rel="preload" href="/assets/fonts/manrope.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="/assets/css/main.css" as="style">

<!-- DNS prefetch for external resources -->
<link rel="dns-prefetch" href="https://www.google-analytics.com">
<link rel="dns-prefetch" href="https://www.googletagmanager.com">

<!-- Preconnect to critical third-party origins -->
<link rel="preconnect" href="https://fonts.googleapis.com">

<!-- Disable render-blocking resources for above-the-fold -->
<style>
    /* Critical inline CSS for hero section - prevents LCP delay */
    .hero { background: linear-gradient(135deg, #0b1830 0%, #1c3d73 100%); min-height: 400px; }
    .container-xl { width: 100%; max-width: 1440px; margin: 0 auto; padding: 0 24px; }
</style>

<!-- Defer non-critical JavaScript -->
<link rel="preload" href="/assets/js/nav.js" as="script">
<link rel="preload" href="/assets/js/accordion.js" as="script">
HTML;
    }

    public static function getImageOptimizations(): string
    {
        return <<<HTML
<!-- Image optimization directives -->
<img src="/assets/img/hero.webp"
     loading="lazy"
     decoding="async"
     width="1200"
     height="600"
     alt="Su kaçağı tespiti hizmeti">

<!-- Responsive images with srcset -->
<picture>
    <source srcset="/assets/img/hero-small.webp 480w, /assets/img/hero-large.webp 1200w" type="image/webp">
    <source srcset="/assets/img/hero-small.jpg 480w, /assets/img/hero-large.jpg 1200w" type="image/jpeg">
    <img src="/assets/img/hero-large.jpg" alt="Su kaçağı tespiti">
</picture>
HTML;
    }

    public static function getCachingHeaders(): array
    {
        return [
            // Static assets: cache for 1 year
            'css' => 'public, max-age=31536000, immutable',
            'js' => 'public, max-age=31536000, immutable',
            'fonts' => 'public, max-age=31536000, immutable',
            'images' => 'public, max-age=604800, must-revalidate',

            // HTML pages: cache for 1 hour but revalidate
            'html' => 'public, max-age=3600, must-revalidate',

            // API/dynamic: no cache
            'api' => 'no-cache, no-store, must-revalidate',
        ];
    }

    public static function generateCachingRules(): string
    {
        $rules = self::getCachingHeaders();
        $htaccess = <<<HTACCESS
# Enable gzip compression
<IfModule mod_deflate.c>
    AddType application/javascript js
    AddEncoding gzip .js
    AddEncoding gzip .css
    AddEncoding gzip .html
    AddEncoding gzip .svg
</IfModule>

# Browser caching
<IfModule mod_expires.c>
    ExpiresActive On

    # Cache images for 1 week
    ExpiresByType image/jpeg "access plus 1 week"
    ExpiresByType image/gif "access plus 1 week"
    ExpiresByType image/png "access plus 1 week"
    ExpiresByType image/webp "access plus 1 week"
    ExpiresByType image/svg+xml "access plus 1 month"

    # Cache CSS and JS for 1 year
    ExpiresByType text/css "access plus 1 year"
    ExpiresByType application/javascript "access plus 1 year"
    ExpiresByType application/x-javascript "access plus 1 year"

    # Cache fonts for 1 year
    ExpiresByType font/woff "access plus 1 year"
    ExpiresByType font/woff2 "access plus 1 year"
    ExpiresByType application/x-font-ttf "access plus 1 year"

    # Default cache
    ExpiresDefault "access plus 2 days"
</IfModule>

# Disable ETags (use Last-Modified instead)
<IfModule mod_headers.c>
    Header unset ETag
    FileETag None
</IfModule>
HTACCESS;

        return $htaccess;
    }

    public static function getLazyLoadingScript(): string
    {
        return <<<JS
<!-- Lazy loading for images below the fold -->
<script>
if ('IntersectionObserver' in window) {
    const images = document.querySelectorAll('img[loading="lazy"]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('loading');
                imageObserver.unobserve(img);
            }
        });
    });
    images.forEach(img => imageObserver.observe(img));
} else {
    // Fallback for older browsers
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => {
        img.src = img.dataset.src;
    });
}
</script>
JS;
    }

    public static function getMetaRobotsTags(): string
    {
        return <<<HTML
<!-- Control indexing and following -->
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="googlebot" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

<!-- Mobile optimization -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
<meta name="theme-color" content="#0f1f3d">

<!-- Security headers -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' www.google-analytics.com www.googletagmanager.com; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:;">
HTML;
    }
}
