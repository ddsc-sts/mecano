<?php
declare(strict_types=1);
namespace App\Enums;

enum OrdemServicoStatus: string
{
    case Aberta = 'aberta';
    case EmDiagnostico = 'em_diagnostico';
    case AguardandoAprovacao = 'aguardando_aprovacao';
    case EmExecucao = 'em_execucao';
    case AguardandoPagamento = 'aguardando_pagamento';
    case Concluida = 'concluida';
    case Cancelada = 'cancelada';

    public function proximos(): array
    {
        return match ($this) {
            self::Aberta => [self::EmDiagnostico, self::Cancelada],
            self::EmDiagnostico => [self::AguardandoAprovacao, self::Cancelada],
            self::AguardandoAprovacao => [self::EmExecucao, self::Cancelada],
            self::EmExecucao => [self::AguardandoPagamento, self::Cancelada],
            self::AguardandoPagamento => [self::Concluida],
            default => [],
        };
    }

    public function podeIr(self $novo): bool { return in_array($novo, $this->proximos(), true); }
}
