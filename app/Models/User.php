<?php

namespace App\Models;

class User extends Model
{
    protected string $table = 'users';

    public static function findByEmail(string $email): ?self
    {
        return static::query()->where('email', '=', $email)->first();
    }

    public static function create(array $data): self
    {
        $user = new static($data);
        $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_BCRYPT);
        $user->save();
        return $user;
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->attributes['password'] ?? '');
    }

    public function hasPermission(string $permission): bool
    {
        // Get role permissions from database
        if (!isset($this->attributes['role_id'])) {
            return false;
        }

        $stmt = static::getConnection()->prepare('
            SELECT COUNT(*) as count FROM role_permissions rp
            JOIN permissions p ON rp.permission_id = p.id
            WHERE rp.role_id = ? AND p.name = ?
        ');
        $stmt->execute([$this->attributes['role_id'], $permission]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return ($result['count'] ?? 0) > 0;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->attributes['id'] ?? null,
            'name' => $this->attributes['name'] ?? '',
            'email' => $this->attributes['email'] ?? '',
            'phone' => $this->attributes['phone'] ?? '',
            'role_id' => $this->attributes['role_id'] ?? null,
            'is_active' => (bool)($this->attributes['is_active'] ?? false),
            'last_login_at' => $this->attributes['last_login_at'] ?? null,
        ];
    }
}
