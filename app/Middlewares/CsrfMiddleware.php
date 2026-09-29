<?php
declare(strict_types=1);
namespace App\Middlewares;

use App\Core\{Request, Response};
use App\Core\Security\{Csrf, Logger};

final class CsrfMiddleware
{
    public function handle(Request $req, mixed $arg = null): void
    {
        if (!Csrf::valid($req->body['_csrf'] ?? null)) {
            Logger::security('csrf_invalid', "ip={$req->ip} path={$req->path}");
            Response::abort(419);
        }
    }
}
