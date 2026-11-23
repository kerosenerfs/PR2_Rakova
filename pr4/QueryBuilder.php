<?php
declare(strict_types=1);

class QueryBuilder
{
    private string $table = '';
    private array $columns = ['*'];
    private array $wheres = [];
    private ?string $orderBy = null;
    private ?int $limit = null;

    private const ALLOWED_OPERATORS = ['=', '!=', '>', '<', '>=', '<=', 'LIKE'];

    private function __construct(string $table)
    {
        $this->table = $table;
    }

    public static function table(string $name): static
    {
        return new static($name);
    }

    public function select(string ...$columns): static
    {
        if ($columns !== []) {
            $this->columns = $columns;
        }
        return $this;
    }

    public function where(string $column, string $operator, string|int $value): static
    {
        if (!in_array($operator, self::ALLOWED_OPERATORS, true)) {
            throw new InvalidArgumentException("Недопустимый оператор: {$operator}");
        }
        $this->wheres[] = "{$column} {$operator} " . $this->quote($value);
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): static
    {
        $direction = strtoupper($direction);
        if ($direction !== 'ASC' && $direction !== 'DESC') {
            throw new InvalidArgumentException('Направление сортировки только ASC или DESC');
        }
        $this->orderBy = "{$column} {$direction}";
        return $this;
    }

    public function limit(int $count): static
    {
        if ($count <= 0) {
            throw new InvalidArgumentException('Limit должен быть больше 0');
        }
        $this->limit = $count;
        return $this;
    }

    public function toSql(): string
    {
        $sql = 'SELECT ' . implode(', ', $this->columns);
        $sql .= ' FROM ' . $this->table;
        if ($this->wheres !== []) {
            $sql .= ' WHERE ' . implode(' AND ', $this->wheres);
        }
        if ($this->orderBy !== null) {
            $sql .= ' ORDER BY ' . $this->orderBy;
        }
        if ($this->limit !== null) {
            $sql .= ' LIMIT ' . $this->limit;
        }
        return $sql;
    }

    public function __toString(): string
    {
        return $this->toSql();
    }

    private function quote(string|int $value): string
    {
        if (is_int($value)) {
            return (string)$value;
        }
        return "'" . $value . "'";
    }
    
    public function __call(string $name, array $arguments): static
    {
        if (str_starts_with($name, 'where')) {
            $column = lcfirst(substr($name, 5));
            if ($column === '') {
                throw new BadMethodCallException("Неверное динамическое условие: {$name}");
            }
            $value = $arguments[0] ?? null;
            if ($value === null) {
                throw new BadMethodCallException("Не передан аргумент для {$name}");
            }
            return $this->where($column, '=', $value);
        }
        throw new BadMethodCallException("Метод {$name} не существует");
    }
}