<?php

namespace App\Models;

class Faq extends Model
{
    protected string $table = 'faqs';

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
            'question' => $this->attributes['question'] ?? '',
            'answer' => $this->attributes['answer'] ?? '',
            'category' => $this->attributes['category'] ?? '',
        ];
    }
}
