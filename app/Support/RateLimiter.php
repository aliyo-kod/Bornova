<?php

namespace App\Support;

class RateLimiter
{
    private static array $limits = [];

    public static function check(string $key, int $maxAttempts = 60, int $decayMinutes = 1): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $storageKey = '_rate_limit_' . $key;
        $now = time();
        $decaySeconds = $decayMinutes * 60;

        if (!isset($_SESSION[$storageKey])) {
            $_SESSION[$storageKey] = [];
        }

        // Clean old attempts
        $_SESSION[$storageKey] = array_filter(
            $_SESSION[$storageKey],
            fn($timestamp) => $now - $timestamp < $decaySeconds
        );

        // Check if limit exceeded
        if (count($_SESSION[$storageKey]) >= $maxAttempts) {
            return false;
        }

        // Record new attempt
        $_SESSION[$storageKey][] = $now;
        return true;
    }

    public static function hit(string $key): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $storageKey = '_rate_limit_hit_' . $key;
        $_SESSION[$storageKey] = ($_SESSION[$storageKey] ?? 0) + 1;
    }

    public static function remaining(string $key, int $maxAttempts = 60): int
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $storageKey = '_rate_limit_' . $key;
        $attempts = count($_SESSION[$storageKey] ?? []);
        return max(0, $maxAttempts - $attempts);
    }

    public static function reset(string $key): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION['_rate_limit_' . $key]);
        unset($_SESSION['_rate_limit_hit_' . $key]);
    }
}
