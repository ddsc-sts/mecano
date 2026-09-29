<?php
declare(strict_types=1);
namespace App\Core;

abstract class Controller
{
    protected function view(string $view, array $data = [], string $layout = 'oficina'): void
    {
        View::render($view, $data, $layout);
    }

    protected function redirect(string $to): never { Response::redirect($to); }
    protected function json(mixed $data, int $code = 200): never { Response::json($data, $code); }
}
