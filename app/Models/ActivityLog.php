<?php

namespace App\Models;

class ActivityLog extends Model
{
    protected string $table = 'activity_logs';

    public static function log(string $action, ?int $userId = null, string $entityType = '', int $entityId = 0, array $changes = []): self
    {
        $log = new static([
            'user_id' => $userId,
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'changes' => json_encode($changes),
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        ]);
        $log->save();
        return $log;
    }

    public static function recent(int $limit = 50)
    {
        return static::query()
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->get();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->attributes['id'] ?? null,
            'user_id' => $this->attributes['user_id'] ?? null,
            'action' => $this->attributes['action'] ?? '',
            'entity_type' => $this->attributes['entity_type'] ?? '',
            'entity_id' => $this->attributes['entity_id'] ?? 0,
            'changes' => json_decode($this->attributes['changes'] ?? '{}', true),
            'ip_address' => $this->attributes['ip_address'] ?? '',
            'created_at' => $this->attributes['created_at'] ?? '',
        ];
    }
}
