<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    const SESSION_KEY = 'user_id';
    const REMEMBER_KEY = 'remember_token';

    public static function login(string $email, string $password, bool $remember = false): bool
    {
        $user = User::findByEmail($email);

        if (!$user || !$user->verifyPassword($password)) {
            return false;
        }

        if (!$user->attributes['is_active'] ?? false) {
            return false;
        }

        self::startSession($user, $remember);
        return true;
    }

    private static function startSession(User $user, bool $remember = false): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION[self::SESSION_KEY] = $user->attributes['id'];

        // Update last login
        $user->attributes['last_login_at'] = date('Y-m-d H:i:s');
        $user->save();

        if ($remember) {
            $token = bin2hex(random_bytes(32));
            setcookie(
                self::REMEMBER_KEY,
                $token,
                time() + (365 * 24 * 60 * 60),
                '/',
                '',
                true,
                true
            );
        }
    }

    public static function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION[self::SESSION_KEY]);
        setcookie(self::REMEMBER_KEY, '', time() - 3600, '/');
        session_destroy();
    }

    public static function isAuthenticated(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION[self::SESSION_KEY]);
    }

    public static function user(): ?User
    {
        if (!self::isAuthenticated()) {
            return null;
        }

        $userId = $_SESSION[self::SESSION_KEY] ?? null;
        if (!$userId) {
            return null;
        }

        return User::query()->where('id', '=', $userId)->first();
    }

    public static function requireAuth(): void
    {
        if (!self::isAuthenticated()) {
            header('Location: /admin/login?redirect=' . urlencode($_SERVER['REQUEST_URI'] ?? '/'));
            exit;
        }
    }

    public static function requirePermission(string $permission): void
    {
        self::requireAuth();

        $user = self::user();
        if (!$user || !$user->hasPermission($permission)) {
            header('HTTP/1.1 403 Forbidden');
            echo '403 - Erişim Reddedildi';
            exit;
        }
    }
}
