<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Core\{Controller, Database, Request, Response, Session};
use App\Core\Security\{Hash, Logger, RateLimiter, Validator};

final class AuthController extends Controller
{
    public function showLogin(Request $req): void
    {
        $this->view('auth/login', ['erro' => Session::flash('erro')], 'auth');
    }

    public function login(Request $req): void
    {
        $email = strtolower(trim((string) $req->input('email')));
        $key = "login|{$req->ip}|{$email}";

        if (RateLimiter::tooMany($key)) {
            Logger::security('login_bloqueado', "ip={$req->ip}");
            Response::abort(429);
        }
        if (Validator::validate($req->body, ['email' => 'required|email', 'senha' => 'required'])) {
            Session::flash('erro', 'Credenciais inválidas.');
            $this->redirect('/login');
        }

        $u = Database::query('SELECT * FROM usuarios WHERE email = ? AND ativo = 1 AND deleted_at IS NULL LIMIT 1', [$email])->fetch();
        // mensagem única evita enumeração de usuários
        if (!$u || !Hash::verify((string) $req->input('senha'), $u['senha_hash'])) {
            RateLimiter::hit($key);
            Logger::security('login_falhou', "ip={$req->ip} email={$email}");
            Session::flash('erro', 'Credenciais inválidas.');
            $this->redirect('/login');
        }

        RateLimiter::clear($key);
        Session::regenerate();                                   // anti session fixation
        Session::set('usuario', ['id' => (int) $u['id'], 'nome' => $u['nome'], 'papel' => $u['papel']]);
        $this->redirect($u['papel'] === 'cliente' ? '/portal' : '/oficina');
    }

    public function logout(Request $req): void
    {
        Session::destroy();
        $this->redirect('/login');
    }
}
