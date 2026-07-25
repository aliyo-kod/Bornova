<?php

namespace App\Models;

class HeroSlider extends Model
{
    protected string $table = 'hero_sliders';

    public static function active()
    {
        return static::query()
            ->where('is_active', '=', true)
            ->orderBy('order_index', 'ASC')
            ->get();
    }

    public static function featured()
    {
        return static::query()
            ->where('is_active', '=', true)
            ->limit(1)
            ->first();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->attributes['id'] ?? null,
            'title' => $this->attributes['title'] ?? '',
            'subtitle' => $this->attributes['subtitle'] ?? '',
            'accent_text' => $this->attributes['accent_text'] ?? '',
            'description' => $this->attributes['description'] ?? '',
            'eyebrow' => $this->attributes['subtitle'] ?? '',
            'cta_button_text' => $this->attributes['cta_button_text'] ?? 'Hemen Ara',
            'cta_button_url' => $this->attributes['cta_button_url'] ?? 'tel:+905551234567',
            'secondary_button_text' => $this->attributes['secondary_button_text'] ?? 'WhatsApp ile İlet',
            'secondary_button_url' => $this->attributes['secondary_button_url'] ?? 'https://wa.me/905551234567',
            'badges' => json_decode($this->attributes['badges'] ?? '[]', true) ?? [],
            'image_id' => $this->attributes['image_id'] ?? null,
            'stat_title' => $this->attributes['stat_title'] ?? '',
            'stat_value' => $this->attributes['stat_value'] ?? '',
            'stat_icon' => $this->attributes['stat_icon'] ?? 'check',
        ];
    }
}
