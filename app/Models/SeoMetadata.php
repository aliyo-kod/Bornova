<?php

namespace App\Models;

class SeoMetadata extends Model
{
    protected string $table = 'seo_metadata';

    public static function forEntity(string $entityType, int $entityId): ?self
    {
        return static::query()
            ->where('entity_type', '=', $entityType)
            ->where('entity_id', '=', $entityId)
            ->first();
    }

    public static function createOrUpdate(string $entityType, int $entityId, array $data): self
    {
        $meta = static::forEntity($entityType, $entityId);

        if (!$meta) {
            $meta = new static([
                'entity_type' => $entityType,
                'entity_id' => $entityId,
            ]);
        }

        foreach ($data as $key => $value) {
            $meta->attributes[$key] = $value;
        }

        $meta->save();
        return $meta;
    }

    public function toArray(): array
    {
        return [
            'meta_title' => $this->attributes['meta_title'] ?? '',
            'meta_description' => $this->attributes['meta_description'] ?? '',
            'meta_keywords' => $this->attributes['meta_keywords'] ?? '',
            'og_title' => $this->attributes['og_title'] ?? '',
            'og_description' => $this->attributes['og_description'] ?? '',
            'og_image_id' => $this->attributes['og_image_id'] ?? null,
            'canonical_url' => $this->attributes['canonical_url'] ?? '',
            'json_ld' => json_decode($this->attributes['json_ld'] ?? '{}', true),
        ];
    }
}
