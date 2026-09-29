<?php
use App\Core\Router;
use App\Controllers\Oficina\{DashboardController, VeiculoController};
use App\Middlewares\{AuthMiddleware, TenantMiddleware};

return function (Router $r): void {
    $mw = [AuthMiddleware::class, TenantMiddleware::class];
    $r->get('/oficina', [DashboardController::class, 'index'], $mw);
    $r->get('/oficina/veiculos', [VeiculoController::class, 'index'], $mw);
    $r->get('/oficina/veiculos/placa', [VeiculoController::class, 'buscarPorPlaca'], $mw);
};
