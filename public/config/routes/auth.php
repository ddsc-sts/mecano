<?php
use App\Core\Router;
use App\Controllers\AuthController;
use App\Middlewares\{GuestMiddleware, AuthMiddleware};

return function (Router $r): void {
    $r->get('/', [AuthController::class, 'showLogin'], [GuestMiddleware::class]);
    $r->get('/login', [AuthController::class, 'showLogin'], [GuestMiddleware::class]);
    $r->post('/login', [AuthController::class, 'login'], [GuestMiddleware::class]);
    $r->post('/logout', [AuthController::class, 'logout'], [AuthMiddleware::class]);
};
