<?php

namespace App\Models;

class Video extends Model
{
    protected string $table = 'videos';

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
            'description' => $this->attributes['description'] ?? '',
            'category_color' => $this->attributes['category_color'] ?? 'blue',
            'video_src' => $this->attributes['video_url'] ?? '',
            'poster_image' => [
                'id' => $this->attributes['poster_image_id'] ?? null,
                'url' => '/assets/img/placeholder.jpg',
            ],
            'duration' => (int)($this->attributes['duration'] ?? 0),
        ];
    }
}
