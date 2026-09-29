<?php
use App\Core\Router;
use App\Controllers\AuthController;
use App\Middlewares\{GuestMiddleware, AuthMiddleware};

return function (Router $r): void {
    $r->get('/', [AuthController::class, 'showLogin'], [GuestMiddleware::class]);
    $r->get('/login', [AuthController::class, 'showLogin'], [GuestMiddleware::class]);
    $r->post('/login', [AuthController::class, 'login'], [GuestMiddleware::class]);
    $r->get('/cadastro', [AuthController::class, 'showRegister'], [GuestMiddleware::class]);
    $r->post('/cadastro', [AuthController::class, 'register'], [GuestMiddleware::class]);
    $r->get('/selecionar-empresa', [AuthController::class, 'showCompanies'], [AuthMiddleware::class]);
    $r->post('/selecionar-empresa', [AuthController::class, 'selectCompany'], [AuthMiddleware::class]);
    $r->post('/logout', [AuthController::class, 'logout'], [AuthMiddleware::class]);
};
