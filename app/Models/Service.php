<?php

namespace App\Models;

class Service extends Model
{
    protected string $table = 'services';

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
            'name' => $this->attributes['name'] ?? '',
            'slug' => $this->attributes['slug'] ?? '',
            'description' => $this->attributes['description'] ?? '',
            'short_description' => $this->attributes['short_description'] ?? '',
            'icon' => $this->attributes['icon_name'] ?? '',
            'category_color' => $this->attributes['category_color'] ?? 'blue',
            'image' => [
                'id' => $this->attributes['image_id'] ?? null,
                'url' => '/assets/img/placeholder.jpg',
            ],
            'checklist' => json_decode($this->attributes['checklist_items'] ?? '[]', true) ?? [],
            'button_text' => $this->attributes['cta_button_text'] ?? 'DETAYLI İNCELE',
            'button_url' => $this->attributes['cta_button_url'] ?? '#',
        ];
    }
}
