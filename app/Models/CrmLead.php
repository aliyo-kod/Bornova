<?php

namespace App\Models;

class CrmLead extends Model
{
    protected string $table = 'crm_leads';

    public static function byStatus(string $status)
    {
        return static::query()->where('status', '=', $status)->get();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->attributes['id'] ?? null,
            'name' => $this->attributes['name'] ?? '',
            'email' => $this->attributes['email'] ?? '',
            'phone' => $this->attributes['phone'] ?? '',
            'service_id' => $this->attributes['service_id'] ?? null,
            'region_id' => $this->attributes['region_id'] ?? null,
            'status' => $this->attributes['status'] ?? 'new',
            'assigned_to' => $this->attributes['assigned_to'] ?? null,
            'estimated_value' => $this->attributes['estimated_value'] ?? 0,
            'notes' => $this->attributes['notes'] ?? '',
            'source' => $this->attributes['source'] ?? '',
            'next_follow_up' => $this->attributes['next_follow_up'] ?? null,
            'created_at' => $this->attributes['created_at'] ?? '',
            'updated_at' => $this->attributes['updated_at'] ?? '',
        ];
    }
}

// Alias for convenience
class Lead extends CrmLead {}
