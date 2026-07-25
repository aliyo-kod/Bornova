<?php

/**
 * CSRF Token Management
 * Generate and validate CSRF tokens for form protection
 */

function csrf_token(): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['_csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="_csrf_token" value="' . csrf_token() . '">';
}

function verify_csrf_token(string $token): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $sessionToken = $_SESSION['_csrf_token'] ?? '';
    return hash_equals($sessionToken, $token);
}

function csrf_verify_request(): bool
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        return true;
    }

    $token = $_POST['_csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    return verify_csrf_token($token);
}

function require_csrf_token(): void
{
    if (!csrf_verify_request()) {
        header('HTTP/1.1 403 Forbidden');
        echo '403 - CSRF Token Invalid';
        exit;
    }
}
