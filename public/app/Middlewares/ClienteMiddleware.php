<?php
declare(strict_types=1);
namespace App\Middlewares;

use App\Core\{Request, Response};

/** Exige usuário com papel 'cliente' (portal). */
final class ClienteMiddleware
{
    public function handle(Request $req, mixed $arg = null): void
    {
        if ((auth()['papel'] ?? '') !== 'cliente') Response::abort(403);
    }
}
