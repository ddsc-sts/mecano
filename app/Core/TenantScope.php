<?php
declare(strict_types=1);
namespace App\Core;

/**
 * Monta condições de isolamento. Use também em queries manuais (relatórios, joins):
 *   [$cond, $params] = TenantScope::condition('v');   // "v.empresa_id = ? AND v.deleted_at IS NULL"
 */
final class TenantScope
{
    public static function condition(string $alias, bool $softDelete = true): array
    {
        $sql = "{$alias}.empresa_id = ?";
        if ($softDelete) $sql .= " AND {$alias}.deleted_at IS NULL";
        return [$sql, [Tenant::id()]];
    }
}
