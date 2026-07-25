<?php

namespace App\Models;

class CrmTask extends Model
{
    protected string $table = 'crm_tasks';

    public function toArray(): array
    {
        return [
            'id' => $this->attributes['id'] ?? null,
            'lead_id' => $this->attributes['lead_id'] ?? null,
            'assigned_to' => $this->attributes['assigned_to'] ?? null,
            'title' => $this->attributes['title'] ?? '',
            'description' => $this->attributes['description'] ?? '',
            'due_date' => $this->attributes['due_date'] ?? null,
            'status' => $this->attributes['status'] ?? 'pending',
            'priority' => $this->attributes['priority'] ?? 'medium',
            'created_at' => $this->attributes['created_at'] ?? '',
            'updated_at' => $this->attributes['updated_at'] ?? '',
        ];
    }
}
