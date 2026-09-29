<?php
use App\Core\Router;
use App\Controllers\Oficina\{DashboardController, VeiculoController};
use App\Middlewares\{AuthMiddleware, OficinaMiddleware};

return function (Router $r): void {
    $mw = [AuthMiddleware::class, OficinaMiddleware::class];
    $r->get('/oficina', [DashboardController::class, 'index'], $mw);
    $r->get('/oficina/veiculos', [VeiculoController::class, 'index'], $mw);
    $r->get('/oficina/veiculos/placa', [VeiculoController::class, 'buscarPorPlaca'], $mw);
};
