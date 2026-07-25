<?php

namespace App\Models;

class LoginLog extends Model
{
    protected string $table = 'login_logs';

    public static function log(int $userId, bool $isSuccessful = true, string $failureReason = ''): self
    {
        $log = new static([
            'user_id' => $userId,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'is_successful' => $isSuccessful,
            'failure_reason' => $failureReason,
        ]);
        $log->save();
        return $log;
    }

    public static function recentFailures(int $userId, int $minutes = 30): int
    {
        $since = date('Y-m-d H:i:s', time() - ($minutes * 60));
        return static::query()
            ->where('user_id', '=', $userId)
            ->where('is_successful', '=', false)
            ->where('login_at', '>=', $since)
            ->count();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->attributes['id'] ?? null,
            'user_id' => $this->attributes['user_id'] ?? null,
            'ip_address' => $this->attributes['ip_address'] ?? '',
            'is_successful' => (bool)($this->attributes['is_successful'] ?? false),
            'failure_reason' => $this->attributes['failure_reason'] ?? '',
            'login_at' => $this->attributes['login_at'] ?? '',
        ];
    }
}
