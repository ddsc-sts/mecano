<?php
declare(strict_types=1);
namespace App\Enums;

enum MovimentoTipo: string
{
    case Entrada = 'entrada';
    case Saida = 'saida';
    case Ajuste = 'ajuste';
    case Devolucao = 'devolucao';
}
