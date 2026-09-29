<?php
declare(strict_types=1);
namespace App\Middlewares;

use App\Core\{Request, Response};

/** Bloqueia clientes de acessar a área interna da oficina. */
final class OficinaMiddleware
{
    public function handle(Request $req, mixed $arg = null): void
    {
        if ((auth()['papel'] ?? 'cliente') === 'cliente') Response::abort(403);
    }
}
