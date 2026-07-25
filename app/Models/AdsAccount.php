<?php

namespace App\Models;

class AdsAccount extends Model
{
    protected string $table = 'ads_accounts';

    public static function byPlatform(string $platform)
    {
        return static::query()->where('platform', '=', $platform)->where('is_active', '=', true)->get();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->attributes['id'] ?? null,
            'platform' => $this->attributes['platform'] ?? '',
            'account_id' => $this->attributes['account_id'] ?? '',
            'account_name' => $this->attributes['account_name'] ?? '',
            'is_active' => (bool)($this->attributes['is_active'] ?? false),
            'last_synced_at' => $this->attributes['last_synced_at'] ?? null,
            'settings' => json_decode($this->attributes['settings'] ?? '{}', true),
        ];
    }
}
