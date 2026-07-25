<?php

namespace App\Models;

class PhoneClick extends Model
{
    protected string $table = 'phone_clicks';

    public static function track(string $phoneNumber, string $sourcePage = ''): self
    {
        $click = new static([
            'phone_number' => $phoneNumber,
            'source_page' => $sourcePage ?: $_SERVER['HTTP_REFERER'] ?? '',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            'session_id' => session_id() ?: bin2hex(random_bytes(16)),
        ]);
        $click->save();
        return $click;
    }

    public static function countToday(): int
    {
        return static::query()
            ->where('created_at', '>=', date('Y-m-d 00:00:00'))
            ->count();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->attributes['id'] ?? null,
            'phone_number' => $this->attributes['phone_number'] ?? '',
            'source_page' => $this->attributes['source_page'] ?? '',
            'created_at' => $this->attributes['created_at'] ?? '',
        ];
    }
}
