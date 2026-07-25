<?php

function env(string $key, $default = null)
{
    $value = $_ENV[$key] ?? getenv($key) ?? $default;

    if ($value === 'true') {
        return true;
    }
    if ($value === 'false') {
        return false;
    }
    if ($value === 'null') {
        return null;
    }

    return $value;
}
