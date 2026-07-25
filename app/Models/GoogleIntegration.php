<?php

namespace App\Models;

class GoogleIntegration extends Model
{
    protected string $table = 'google_integrations';

    public static function forType(string $type): ?self
    {
        return static::query()->where('integration_type', '=', $type)->first();
    }

    public static function isConnected(string $type): bool
    {
        $integration = static::forType($type);
        return $integration && $integration->attributes['is_connected'];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->attributes['id'] ?? null,
            'integration_type' => $this->attributes['integration_type'] ?? '',
            'is_connected' => (bool)($this->attributes['is_connected'] ?? false),
            'settings' => json_decode($this->attributes['settings'] ?? '{}', true),
            'last_synced_at' => $this->attributes['last_synced_at'] ?? null,
        ];
    }
}
