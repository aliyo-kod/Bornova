<?php

namespace App\Models;

class Backup extends Model
{
    protected string $table = 'backups';

    public static function createNew(string $filename, int $size): self
    {
        $backup = new static([
            'backup_file' => $filename,
            'backup_size' => $size,
            'backup_type' => 'full',
            'status' => 'pending',
        ]);
        $backup->save();
        return $backup;
    }

    public static function recent(int $limit = 10)
    {
        return static::query()
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->get();
    }

    public function markCompleted(): void
    {
        $this->attributes['status'] = 'completed';
        $this->attributes['completed_at'] = date('Y-m-d H:i:s');
        $this->save();
    }

    public function markFailed(): void
    {
        $this->attributes['status'] = 'failed';
        $this->save();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->attributes['id'] ?? null,
            'backup_file' => $this->attributes['backup_file'] ?? '',
            'backup_size' => $this->attributes['backup_size'] ?? 0,
            'backup_type' => $this->attributes['backup_type'] ?? 'full',
            'status' => $this->attributes['status'] ?? 'pending',
            'created_at' => $this->attributes['created_at'] ?? '',
            'completed_at' => $this->attributes['completed_at'] ?? null,
        ];
    }
}
