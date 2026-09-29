<?php
declare(strict_types=1);
namespace App\Models;

use App\Core\Model;

final class Veiculo extends Model
{
    protected static string $table = 'veiculos';
    protected static array $fillable = ['cliente_id', 'placa', 'marca', 'modelo', 'ano', 'cor', 'quilometragem', 'modelo_3d_id'];
}
