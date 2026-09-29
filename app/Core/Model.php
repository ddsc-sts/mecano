<?php
declare(strict_types=1);
namespace App\Core;

use App\Exceptions\TenantViolationException;

/**
 * Model base. Em tabelas de negócio ($tenant = true) TODA consulta recebe empresa_id
 * automaticamente. Tabelas globais (planos, catálogo 3D) usam $tenant = false.
 */
abstract class Model
{
    protected static string $table = '';
    protected static array $fillable = [];
    protected static bool $tenant = true;
    protected static bool $softDelete = true;

    private static function ident(string $name): string
    {
        if (!preg_match('/^[a-z_][a-z0-9_]*$/i', $name)) {
            throw new \InvalidArgumentException('Identificador inválido.');
        }
        return '`' . $name . '`';
    }

    private static function scope(): array
    {
        $conds = []; $params = [];
        if (static::$tenant)     { $conds[] = 'empresa_id = ?'; $params[] = Tenant::id(); }
        if (static::$softDelete) { $conds[] = 'deleted_at IS NULL'; }
        return [$conds, $params];
    }

    public static function find(int $id): ?array
    {
        [$c, $p] = self::scope();
        $c[] = 'id = ?'; $p[] = $id;
        $sql = 'SELECT * FROM ' . self::ident(static::$table) . ' WHERE ' . implode(' AND ', $c) . ' LIMIT 1';
        return Database::query($sql, $p)->fetch() ?: null;
    }

    public static function all(int $limit = 100, int $offset = 0): array
    {
        [$c, $p] = self::scope();
        $where = $c ? ' WHERE ' . implode(' AND ', $c) : '';
        $sql = 'SELECT * FROM ' . self::ident(static::$table) . $where . ' ORDER BY id DESC LIMIT ' . max(1, $limit) . ' OFFSET ' . max(0, $offset);
        return Database::query($sql, $p)->fetchAll();
    }

    /** $where: ['coluna' => valor]. Colunas validadas; valores sempre por parâmetro. */
    public static function where(array $where, int $limit = 100): array
    {
        [$c, $p] = self::scope();
        foreach ($where as $col => $val) { $c[] = self::ident($col) . ' = ?'; $p[] = $val; }
        $sql = 'SELECT * FROM ' . self::ident(static::$table) . ' WHERE ' . implode(' AND ', $c) . ' LIMIT ' . max(1, $limit);
        return Database::query($sql, $p)->fetchAll();
    }

    public static function create(array $data): int
    {
        $data = array_intersect_key($data, array_flip(static::$fillable));   // anti mass-assignment
        if (static::$tenant) $data['empresa_id'] = Tenant::id();             // nunca vem do usuário
        $cols = array_map([self::class, 'ident'], array_keys($data));
        $sql = 'INSERT INTO ' . self::ident(static::$table) . ' (' . implode(',', $cols) . ') VALUES (' . implode(',', array_fill(0, count($data), '?')) . ')';
        Database::query($sql, array_values($data));
        return (int) Database::pdo()->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $data = array_intersect_key($data, array_flip(static::$fillable));
        if (!$data) return false;
        [$c, $p] = self::scope();
        $sets = implode(',', array_map(fn($k) => self::ident($k) . ' = ?', array_keys($data)));
        $c[] = 'id = ?';
        $sql = 'UPDATE ' . self::ident(static::$table) . " SET {$sets} WHERE " . implode(' AND ', $c);
        return Database::query($sql, [...array_values($data), ...$p, $id])->rowCount() > 0;
    }

    public static function delete(int $id): bool
    {
        [$c, $p] = self::scope();
        $c[] = 'id = ?'; $p[] = $id;
        $where = implode(' AND ', $c);
        $sql = static::$softDelete
            ? 'UPDATE ' . self::ident(static::$table) . " SET deleted_at = NOW() WHERE {$where}"
            : 'DELETE FROM ' . self::ident(static::$table) . " WHERE {$where}";
        return Database::query($sql, $p)->rowCount() > 0;
    }
}
