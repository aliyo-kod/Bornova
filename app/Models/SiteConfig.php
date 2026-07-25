<?php

namespace App\Models;

class SiteConfig extends Model
{
    protected string $table = 'site_config';

    public static function all(): array
    {
        $items = static::query()->get();
        $config = [];
        foreach ($items as $item) {
            $value = $item->attributes['value'] ?? '';
            if ($item->attributes['data_type'] === 'json') {
                $value = json_decode($value, true);
            } elseif ($item->attributes['data_type'] === 'boolean') {
                $value = $value === 'true' || $value === '1';
            } elseif ($item->attributes['data_type'] === 'integer') {
                $value = (int)$value;
            }
            $config[$item->attributes['key']] = $value;
        }
        return $config;
    }

    public static function get(string $key, $default = null)
    {
        $item = static::query()->where('key', '=', $key)->first();
        if (!$item) {
            return $default;
        }

        $value = $item->attributes['value'] ?? $default;
        if ($item->attributes['data_type'] === 'json') {
            return json_decode($value, true);
        } elseif ($item->attributes['data_type'] === 'boolean') {
            return $value === 'true' || $value === '1';
        } elseif ($item->attributes['data_type'] === 'integer') {
            return (int)$value;
        }
        return $value;
    }
}
