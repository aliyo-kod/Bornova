<?php

namespace App\Models;

class Post extends Model
{
    protected string $table = 'posts';

    public static function published()
    {
        return static::query()
            ->where('is_published', '=', true)
            ->orderBy('published_at', 'DESC')
            ->get();
    }

    public static function featured($limit = 4)
    {
        return static::query()
            ->where('is_published', '=', true)
            ->orderBy('published_at', 'DESC')
            ->limit($limit)
            ->get();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->attributes['id'] ?? null,
            'title' => $this->attributes['title'] ?? '',
            'slug' => $this->attributes['slug'] ?? '',
            'excerpt' => $this->attributes['excerpt'] ?? '',
            'content' => $this->attributes['content'] ?? '',
            'author' => $this->attributes['author_id'] ?? null,
            'featured_image' => [
                'id' => $this->attributes['featured_image_id'] ?? null,
                'url' => '/assets/img/placeholder.jpg',
            ],
            'category' => $this->attributes['category'] ?? '',
            'published_at' => $this->attributes['published_at'] ?? '',
            'icon' => 'book',
            'date' => date('j M Y', strtotime($this->attributes['published_at'] ?? 'now')),
        ];
    }
}
