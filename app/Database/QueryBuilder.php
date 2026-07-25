<?php

namespace App\Database;

use PDO;

class QueryBuilder
{
    private string $modelClass;
    private string $table;
    private string $sql = '';
    private array $bindings = [];
    private string $selectClause = '*';
    private array $whereConditions = [];
    private array $orderBy = [];
    private ?int $limitValue = null;
    private ?int $offsetValue = null;

    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
        $this->table = $this->getTableName($modelClass);
    }

    private function getTableName(string $modelClass): string
    {
        $shortName = substr($modelClass, strrpos($modelClass, '\\') + 1);
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $shortName)) . 's';
    }

    public function select(array $columns = ['*']): self
    {
        $this->selectClause = implode(', ', $columns);
        return $this;
    }

    public function where(string $column, string $operator = '=', $value = null): self
    {
        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }

        $this->whereConditions[] = "{$column} {$operator} ?";
        $this->bindings[] = $value;
        return $this;
    }

    public function whereIn(string $column, array $values): self
    {
        $placeholders = implode(', ', array_fill(0, count($values), '?'));
        $this->whereConditions[] = "{$column} IN ({$placeholders})";
        $this->bindings = array_merge($this->bindings, $values);
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): self
    {
        $this->orderBy[] = "{$column} {$direction}";
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limitValue = $limit;
        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offsetValue = $offset;
        return $this;
    }

    public function paginate(int $page = 1, int $perPage = 15): array
    {
        $total = $this->count();
        $offset = ($page - 1) * $perPage;

        return [
            'data' => $this->offset($offset)->limit($perPage)->get(),
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($total / $perPage),
        ];
    }

    public function get(): array
    {
        $this->buildSql();
        $stmt = Connection::getInstance()->prepare($this->sql);
        $stmt->execute($this->bindings);

        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new $this->modelClass($row);
        }

        return $results;
    }

    public function first(): ?object
    {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }

    public function find(int $id): ?object
    {
        return $this->where('id', '=', $id)->first();
    }

    public function count(): int
    {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        if (!empty($this->whereConditions)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->whereConditions);
        }

        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->execute($this->bindings);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int)($result['count'] ?? 0);
    }

    public function exists(): bool
    {
        return $this->count() > 0;
    }

    public function delete(): int
    {
        $sql = "DELETE FROM {$this->table}";
        if (!empty($this->whereConditions)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->whereConditions);
        }

        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->execute($this->bindings);

        return $stmt->rowCount();
    }

    private function buildSql(): void
    {
        $this->sql = "SELECT {$this->selectClause} FROM {$this->table}";

        if (!empty($this->whereConditions)) {
            $this->sql .= ' WHERE ' . implode(' AND ', $this->whereConditions);
        }

        if (!empty($this->orderBy)) {
            $this->sql .= ' ORDER BY ' . implode(', ', $this->orderBy);
        }

        if ($this->limitValue !== null) {
            $this->sql .= " LIMIT {$this->limitValue}";
        }

        if ($this->offsetValue !== null) {
            $this->sql .= " OFFSET {$this->offsetValue}";
        }
    }
}
