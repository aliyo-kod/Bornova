<?php

namespace App\Models;

class Region extends Model
{
    protected string $table = 'regions';

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
            'map_coordinates' => json_decode($this->attributes['map_coordinates'] ?? '{}', true) ?? [],
            'service_area' => $this->attributes['service_area'] ?? '',
            'meta_title' => $this->attributes['meta_title'] ?? '',
            'meta_description' => $this->attributes['meta_description'] ?? '',
        ];
    }
}
