<?php
declare(strict_types=1);
namespace App\Models;

use App\Core\Model;

final class Empresa extends Model
{
    protected static string $table = 'empresas';
    protected static array $fillable = ['nome', 'documento', 'email', 'telefone'];
    protected static bool $tenant = false;   // a própria empresa não tem empresa_id
}
