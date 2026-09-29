<?php
declare(strict_types=1);
namespace App\Models;

use App\Core\Model;

final class Cliente extends Model
{
    protected static string $table = 'clientes';
    protected static array $fillable = ['usuario_id', 'nome', 'documento', 'telefone', 'email'];
}
