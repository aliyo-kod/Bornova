<?php

namespace App\Models;

class CrmNote extends Model
{
    protected string $table = 'crm_notes';

    public function toArray(): array
    {
        return [
            'id' => $this->attributes['id'] ?? null,
            'lead_id' => $this->attributes['lead_id'] ?? null,
            'user_id' => $this->attributes['user_id'] ?? null,
            'content' => $this->attributes['content'] ?? '',
            'is_internal' => (bool)($this->attributes['is_internal'] ?? true),
            'created_at' => $this->attributes['created_at'] ?? '',
            'updated_at' => $this->attributes['updated_at'] ?? '',
        ];
    }
}
