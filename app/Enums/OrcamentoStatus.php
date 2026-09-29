<?php
declare(strict_types=1);
namespace App\Enums;

enum OrcamentoStatus: string
{
    case Rascunho = 'rascunho';
    case Enviado = 'enviado';
    case Aprovado = 'aprovado';
    case Recusado = 'recusado';
    case Expirado = 'expirado';
    case Convertido = 'convertido';

    /** @return self[] */
    public function proximos(): array
    {
        return match ($this) {
            self::Rascunho => [self::Enviado],
            self::Enviado => [self::Aprovado, self::Recusado, self::Expirado],
            self::Aprovado => [self::Convertido],
            default => [],
        };
    }

    public function podeIr(self $novo): bool { return in_array($novo, $this->proximos(), true); }
}
