<?php
declare(strict_types=1);
namespace App\Enums;

enum PagamentoStatus: string
{
    case Pendente = 'pendente';
    case Parcial = 'parcial';
    case Pago = 'pago';
    case Cancelado = 'cancelado';
}
