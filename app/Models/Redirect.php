<?php

namespace App\Models;

class Redirect extends Model
{
    protected string $table = 'redirects';

    public static function findByOldUrl(string $url): ?self
    {
        return static::query()
            ->where('old_url', '=', $url)
            ->where('is_active', '=', true)
            ->first();
    }

    public function toArray(): array
    {
        return [
            'old_url' => $this->attributes['old_url'] ?? '',
            'new_url' => $this->attributes['new_url'] ?? '',
            'status_code' => (int)($this->attributes['status_code'] ?? 301),
            'is_active' => (bool)($this->attributes['is_active'] ?? false),
        ];
    }
}
