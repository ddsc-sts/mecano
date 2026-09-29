<?php
declare(strict_types=1);
namespace App\Models;

use App\Core\Model;

final class EmpresaUsuario extends Model
{
    // TODO: definir $table e $fillable
    protected static string $table = '';
    protected static array $fillable = [];
    protected static bool $tenant = false;   // tabela global
}
