<?php
declare(strict_types=1);
namespace App\Core;

use App\Exceptions\TenantViolationException;

/** Guarda a empresa (oficina) ativa da requisição. Vem sempre da sessão, nunca do formulário. */
final class Tenant
{
    private static ?int $id = null;

    public static function set(int $empresaId): void
    {
        self::$id = $empresaId;
        Session::set('empresa_id', $empresaId);
    }

    public static function id(): int
    {
        self::$id ??= Session::get('empresa_id');
        if (self::$id === null) {
            throw new TenantViolationException('Consulta sem empresa ativa.');
        }
        return (int) self::$id;
    }

    public static function has(): bool
    {
        return (self::$id ?? Session::get('empresa_id')) !== null;
    }
}
