<?php
declare(strict_types=1);
namespace App\Middlewares;

use App\Core\{Request, Response};

final class GuestMiddleware
{
    public function handle(Request $req, mixed $arg = null): void
    {
        if (auth()) Response::redirect('/oficina');
    }
}
