<?php
declare(strict_types=1);
namespace App\Middlewares;

use App\Core\{Request, Response};

/** Uso na rota: [PapelMiddleware::class, 'admin,gerente'] */
final class PapelMiddleware
{
    public function handle(Request $req, mixed $arg = null): void
    {
        $permitidos = array_map('trim', explode(',', (string) $arg));
        if (!in_array(auth()['papel'] ?? '', $permitidos, true)) Response::abort(403);
    }
}
