<?php
declare(strict_types=1);
namespace App\Core;

final class Router
{
    private array $routes = [];

    public function get(string $p, array $h, array $mw = []): void  { $this->add('GET', $p, $h, $mw); }
    public function post(string $p, array $h, array $mw = []): void { $this->add('POST', $p, $h, $mw); }

    private function add(string $m, string $path, array $handler, array $mw): void
    {
        $regex = '#^' . preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', rtrim($path, '/') ?: '/') . '$#';
        $this->routes[] = compact('m', 'regex', 'handler', 'mw');
    }

    public function dispatch(Request $req): void
    {
        foreach ($this->routes as $r) {
            if ($r['m'] !== $req->method || !preg_match($r['regex'], $req->path, $mt)) continue;
            $req->params = array_filter($mt, 'is_string', ARRAY_FILTER_USE_KEY);
            // POST sempre passa pelo CSRF
            $mws = $r['m'] === 'POST' ? [\App\Middlewares\CsrfMiddleware::class, ...$r['mw']] : $r['mw'];
            foreach ($mws as $mw) {
                [$class, $arg] = is_array($mw) ? $mw : [$mw, null];
                (new $class())->handle($req, $arg);
            }
            [$class, $method] = $r['handler'];
            (new $class())->$method($req);
            return;
        }
        Response::abort(404);
    }
}
