<?php
declare(strict_types=1);
namespace App\Models;

use App\Core\Model;

final class Usuario extends Model
{
    protected static string $table = 'usuarios';
    protected static array $fillable = ['nome', 'email', 'senha_hash', 'papel', 'ativo'];
}
