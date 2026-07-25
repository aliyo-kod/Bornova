<?php
/**
 * Small view helpers shared by every template. Kept dependency-free so
 * Phase 2's router/autoload can include this file exactly as-is.
 */

if (!function_exists('e')) {
    function e(?string $value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        return '/assets/' . ltrim($path, '/');
    }
}

if (!function_exists('icon')) {
    function icon(string $name, string $class = ''): string
    {
        $class = trim('icon ' . $class);
        return '<svg class="' . e($class) . '" aria-hidden="true"><use href="' . asset('img/icons.svg#' . $name) . '"></use></svg>';
    }
}

if (!function_exists('phone_href')) {
    function phone_href(string $tel): string
    {
        return 'tel:' . preg_replace('/[^0-9+]/', '', $tel);
    }
}

if (!function_exists('slugify_active')) {
    function is_active_url(string $url, string $currentPath): bool
    {
        if ($url === '/') {
            return $currentPath === '/';
        }
        return str_starts_with($currentPath, $url);
    }
}
