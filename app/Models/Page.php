<?php

namespace App\Models;

class Page extends Model
{
    protected string $table = 'pages';

    public static function active()
    {
        return static::query()
            ->where('is_active', '=', true)
            ->orderBy('order_index', 'ASC')
            ->get();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->attributes['id'] ?? null,
            'title' => $this->attributes['title'] ?? '',
            'slug' => $this->attributes['slug'] ?? '',
            'content' => $this->attributes['content'] ?? '',
            'meta_title' => $this->attributes['meta_title'] ?? '',
            'meta_description' => $this->attributes['meta_description'] ?? '',
            'meta_keywords' => $this->attributes['meta_keywords'] ?? '',
        ];
    }
}
