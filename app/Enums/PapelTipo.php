<?php
declare(strict_types=1);
namespace App\Enums;

enum PapelTipo: string
{
    case Admin = 'admin';
    case Gerente = 'gerente';
    case Mecanico = 'mecanico';
    case Atendente = 'atendente';
}
