<?php
declare(strict_types=1);
namespace App\Controllers\Oficina;

use App\Core\{Controller, Request};

final class DashboardController extends Controller
{
    public function index(Request $req): void
    {
        $this->view('oficina/dashboard/index', ['usuario' => auth()]);
    }
}
