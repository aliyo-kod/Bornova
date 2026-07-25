<?php

namespace App\Models;

use App\Database\Connection;
use PDO;

abstract class Model
{
    protected string $table;
    protected array $attributes = [];
    protected array $original = [];

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->original = $attributes;
    }

    public function __get(string $name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function __set(string $name, $value): void
    {
        $this->attributes[$name] = $value;
    }

    public function toArray(): array
    {
        return $this->attributes;
    }

    public static function query()
    {
        return new QueryBuilder(static::class);
    }

    protected static function getConnection(): PDO
    {
        return Connection::getInstance();
    }

    protected static function getTable(): string
    {
        $className = static::class;
        $shortName = substr($className, strrpos($className, '\\') + 1);
        $tableName = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $shortName)) . 's';
        return $tableName;
    }

    public function save(): bool
    {
        if (isset($this->attributes['id'])) {
            return $this->update();
        }
        return $this->insert();
    }

    protected function insert(): bool
    {
        $table = static::getTable();
        $columns = array_keys($this->attributes);
        $placeholders = array_map(fn($col) => '?', $columns);

        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $table,
            implode(', ', $columns),
            implode(', ', $placeholders)
        );

        $stmt = static::getConnection()->prepare($sql);
        $success = $stmt->execute(array_values($this->attributes));

        if ($success && !isset($this->attributes['id'])) {
            $this->attributes['id'] = (int)static::getConnection()->lastInsertId();
        }

        return $success;
    }

    protected function update(): bool
    {
        $table = static::getTable();
        $id = $this->attributes['id'] ?? null;

        if (!$id) {
            return false;
        }

        $columns = array_keys($this->attributes);
        $columns = array_filter($columns, fn($col) => $col !== 'id');
        $setClause = implode(', ', array_map(fn($col) => "$col = ?", $columns));

        $sql = sprintf(
            'UPDATE %s SET %s WHERE id = ?',
            $table,
            $setClause
        );

        $values = array_values(array_intersect_key($this->attributes, array_flip($columns)));
        $values[] = $id;

        $stmt = static::getConnection()->prepare($sql);
        return $stmt->execute($values);
    }

    public function delete(): bool
    {
        $table = static::getTable();
        $id = $this->attributes['id'] ?? null;

        if (!$id) {
            return false;
        }

        $sql = sprintf('DELETE FROM %s WHERE id = ?', $table);
        $stmt = static::getConnection()->prepare($sql);
        return $stmt->execute([$id]);
    }
}
