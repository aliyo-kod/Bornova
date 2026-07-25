<?php

namespace App\Models;

class Review extends Model
{
    protected string $table = 'reviews';

    public static function featured()
    {
        return static::query()
            ->where('is_featured', '=', true)
            ->orderBy('order_index', 'ASC')
            ->limit(4)
            ->get();
    }

    public function toArray(): array
    {
        $name = $this->attributes['customer_name'] ?? '';
        $initials = implode('', array_map(fn($word) => $word[0] ?? '', explode(' ', $name)));

        return [
            'id' => $this->attributes['id'] ?? null,
            'name' => $name,
            'rating' => (int)($this->attributes['rating'] ?? 5),
            'comment' => $this->attributes['comment'] ?? '',
            'source' => $this->attributes['source'] ?? 'manual',
            'is_verified' => (bool)($this->attributes['is_verified'] ?? false),
            'avatar_color' => $this->attributes['avatar_color'] ?? '#2f6fed',
            'avatar_initials' => $initials,
        ];
    }
}
