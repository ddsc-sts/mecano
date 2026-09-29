<?php
declare(strict_types=1);
namespace App\Middlewares;

use App\Core\{Request, Response, Tenant};

/** Exige empresa ativa (escolhida no login e validada contra empresa_usuario). */
final class TenantMiddleware
{
    public function handle(Request $req, mixed $arg = null): void
    {
        if (!Tenant::has()) Response::redirect('/selecionar-empresa');
    }
}
