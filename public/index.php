<?php
declare(strict_types=1);

define('BASE_PATH', dirname(__DIR__));

// Autoload: Composer se existir, senão PSR-4 simples
if (is_file(BASE_PATH . '/vendor/autoload.php')) {
    require BASE_PATH . '/vendor/autoload.php';
} else {
    spl_autoload_register(function (string $class): void {
        if (str_starts_with($class, 'App\\')) {
            $file = BASE_PATH . '/app/' . str_replace('\\', '/', substr($class, 4)) . '.php';
            if (is_file($file)) require $file;
        }
    });
    require BASE_PATH . '/app/Helpers/funcoes.php';
}

use App\Core\{Env, ErrorHandler, Session, Request, Router};
use App\Core\Security\SecurityHeaders;

Env::load(BASE_PATH . '/.env');
ErrorHandler::register();
SecurityHeaders::send();
Session::start();

$router = new Router();
foreach (['auth', 'oficina', 'portal', 'api'] as $file) {
    (require BASE_PATH . "/config/routes/{$file}.php")($router);
}
$router->dispatch(Request::capture());
