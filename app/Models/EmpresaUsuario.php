<?php
declare(strict_types=1);
namespace App\Models;

use App\Core\Model;

final class EmpresaUsuario extends Model
{
    protected static string $table = 'empresa_usuario';
    protected static array $fillable = ['empresa_id', 'usuario_id', 'papel', 'ativo'];
    protected static bool $tenant = false;   // tabela global
}
