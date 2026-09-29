<?php
declare(strict_types=1);
namespace App\Models;

use App\Core\{Database, Model};

/** Dados da oficina: tabela com UMA única linha (id = 1). */
final class Oficina extends Model
{
    protected static string $table = 'oficina';
    protected static array $fillable = ['nome', 'documento', 'email', 'telefone', 'endereco'];
    protected static bool $softDelete = false;

    public static function atual(): array
    {
        return Database::query('SELECT * FROM oficina WHERE id = 1')->fetch() ?: [];
    }
}
