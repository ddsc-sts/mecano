<?php
declare(strict_types=1);
namespace App\Controllers\Oficina;

use App\Core\{Controller, Request};
use App\Core\Security\Validator;
use App\Models\Veiculo;

final class VeiculoController extends Controller
{
    public function index(Request $req): void
    {
        $this->view('oficina/veiculos/index', ['veiculos' => Veiculo::all()]);
    }

    /** GET /oficina/veiculos/placa?placa=ABC1D23 -> localiza cadastro da oficina */
    public function buscarPorPlaca(Request $req): void
    {
        $placa = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', (string) $req->input('placa')));
        if (Validator::validate(['placa' => $placa], ['placa' => 'required|placa'])) {
            $this->json(['erro' => 'Placa inválida'], 422);
        }
        $this->json(['veiculo' => Veiculo::where(['placa' => $placa], 1)[0] ?? null]);
    }
}
