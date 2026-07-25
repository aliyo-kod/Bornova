<?php

namespace App\Models;

class Conversion extends Model
{
    protected string $table = 'conversions';

    public static function track(string $type, ?float $value = null, string $source = 'organic'): self
    {
        $conversion = new static([
            'type' => $type,
            'value' => $value,
            'source' => $source,
            'session_id' => session_id() ?: bin2hex(random_bytes(16)),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
        ]);
        $conversion->save();
        return $conversion;
    }

    public static function countByType(string $type, ?\DateTime $from = null, ?\DateTime $to = null): int
    {
        $query = static::query()->where('type', '=', $type);

        if ($from) {
            $query->where('created_at', '>=', $from->format('Y-m-d H:i:s'));
        }

        if ($to) {
            $query->where('created_at', '<=', $to->format('Y-m-d H:i:s'));
        }

        return $query->count();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->attributes['id'] ?? null,
            'type' => $this->attributes['type'] ?? '',
            'value' => $this->attributes['value'] ?? 0,
            'source' => $this->attributes['source'] ?? '',
            'created_at' => $this->attributes['created_at'] ?? '',
        ];
    }
}
