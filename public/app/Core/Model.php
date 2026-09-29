<?php
declare(strict_types=1);
namespace App\Core;

/**
 * Model base para uma única oficina. Consultas sempre preparadas (PDO),
 * soft delete automático e proteção contra mass assignment via $fillable.
 */
abstract class Model
{
    protected static string $table = '';
    protected static array $fillable = [];
    protected static bool $softDelete = true;

    private static function ident(string $name): string
    {
        if (!preg_match('/^[a-z_][a-z0-9_]*$/i', $name)) {
            throw new \InvalidArgumentException('Identificador inválido.');
        }
        return '`' . $name . '`';
    }

    private static function conds(): array
    {
        return static::$softDelete ? ['deleted_at IS NULL'] : [];
    }

    public static function find(int $id): ?array
    {
        $c = self::conds(); $c[] = 'id = ?';
        $sql = 'SELECT * FROM ' . self::ident(static::$table) . ' WHERE ' . implode(' AND ', $c) . ' LIMIT 1';
        return Database::query($sql, [$id])->fetch() ?: null;
    }

    public static function all(int $limit = 100, int $offset = 0): array
    {
        $c = self::conds();
        $where = $c ? ' WHERE ' . implode(' AND ', $c) : '';
        $sql = 'SELECT * FROM ' . self::ident(static::$table) . $where . ' ORDER BY id DESC LIMIT ' . max(1, $limit) . ' OFFSET ' . max(0, $offset);
        return Database::query($sql)->fetchAll();
    }

    /** $where: ['coluna' => valor]. Colunas validadas; valores sempre por parâmetro. */
    public static function where(array $where, int $limit = 100): array
    {
        $c = self::conds(); $p = [];
        foreach ($where as $col => $val) { $c[] = self::ident($col) . ' = ?'; $p[] = $val; }
        $w = $c ? ' WHERE ' . implode(' AND ', $c) : '';
        $sql = 'SELECT * FROM ' . self::ident(static::$table) . $w . ' LIMIT ' . max(1, $limit);
        return Database::query($sql, $p)->fetchAll();
    }

    public static function create(array $data): int
    {
        $data = array_intersect_key($data, array_flip(static::$fillable));
        $cols = array_map([self::class, 'ident'], array_keys($data));
        $sql = 'INSERT INTO ' . self::ident(static::$table) . ' (' . implode(',', $cols) . ') VALUES (' . implode(',', array_fill(0, count($data), '?')) . ')';
        Database::query($sql, array_values($data));
        return (int) Database::pdo()->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $data = array_intersect_key($data, array_flip(static::$fillable));
        if (!$data) return false;
        $c = self::conds(); $c[] = 'id = ?';
        $sets = implode(',', array_map(fn($k) => self::ident($k) . ' = ?', array_keys($data)));
        $sql = 'UPDATE ' . self::ident(static::$table) . " SET {$sets} WHERE " . implode(' AND ', $c);
        return Database::query($sql, [...array_values($data), $id])->rowCount() > 0;
    }

    public static function delete(int $id): bool
    {
        $c = self::conds(); $c[] = 'id = ?';
        $where = implode(' AND ', $c);
        $sql = static::$softDelete
            ? 'UPDATE ' . self::ident(static::$table) . " SET deleted_at = NOW() WHERE {$where}"
            : 'DELETE FROM ' . self::ident(static::$table) . " WHERE {$where}";
        return Database::query($sql, [$id])->rowCount() > 0;
    }
}
