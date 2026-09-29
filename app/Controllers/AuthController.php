<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Core\{Controller, Database, Request, Session, Tenant};
use App\Core\Security\{Hash, Logger, RateLimiter, Validator};

final class AuthController extends Controller
{
    public function showLogin(Request $req): void
    {
        $this->view('auth/login', ['erro' => Session::flash('erro')], 'auth');
    }

    public function showRegister(Request $req): void
    {
        $this->view('auth/register', [
            'erro' => Session::flash('erro'),
            'dados' => Session::flash('dados') ?? [],
        ], 'auth');
    }

    public function register(Request $req): void
    {
        $dados = [
            'empresa' => trim((string) $req->input('empresa')),
            'nome' => trim((string) $req->input('nome')),
            'email' => strtolower(trim((string) $req->input('email'))),
            'telefone' => trim((string) $req->input('telefone')),
            'senha' => (string) $req->input('senha'),
            'confirmar_senha' => (string) $req->input('confirmar_senha'),
        ];
        $errors = Validator::validate($dados, [
            'empresa' => 'required|min:2|max:150',
            'nome' => 'required|min:2|max:150',
            'email' => 'required|email|max:150',
            'telefone' => 'max:30',
            'senha' => 'required|min:12|max:200',
            'confirmar_senha' => 'required',
        ]);
        if ($dados['senha'] !== $dados['confirmar_senha']) $errors['confirmar_senha'][] = 'match';
        if ($errors) {
            Session::flash('erro', 'Confira os dados informados. A senha precisa ter pelo menos 12 caracteres.');
            Session::flash('dados', array_diff_key($dados, ['senha' => true, 'confirmar_senha' => true]));
            $this->redirect('/cadastro');
        }
        if (Database::query('SELECT id FROM usuarios WHERE email = ? LIMIT 1', [$dados['email']])->fetch()) {
            Session::flash('erro', 'Não foi possível criar a conta com esses dados. Verifique o e-mail e tente novamente.');
            Session::flash('dados', array_diff_key($dados, ['senha' => true, 'confirmar_senha' => true]));
            $this->redirect('/cadastro');
        }

        try {
            [$empresaId, $usuarioId] = Database::transaction(function () use ($dados): array {
                Database::query('INSERT INTO empresas (nome, email, telefone) VALUES (?, ?, ?)', [
                    $dados['empresa'], $dados['email'], $dados['telefone'] ?: null,
                ]);
                $empresaId = (int) Database::pdo()->lastInsertId();
                Database::query("INSERT INTO usuarios (nome, email, senha_hash, tipo) VALUES (?, ?, ?, 'oficina')", [
                    $dados['nome'], $dados['email'], Hash::make($dados['senha']),
                ]);
                $usuarioId = (int) Database::pdo()->lastInsertId();
                Database::query("INSERT INTO empresa_usuario (empresa_id, usuario_id, papel, ativo) VALUES (?, ?, 'admin', 1)", [$empresaId, $usuarioId]);
                return [$empresaId, $usuarioId];
            });
        } catch (\PDOException $e) {
            if ($e->getCode() !== '23000') throw $e;
            Session::flash('erro', 'Não foi possível criar a conta com esses dados. Verifique o e-mail e tente novamente.');
            Session::flash('dados', array_diff_key($dados, ['senha' => true, 'confirmar_senha' => true]));
            $this->redirect('/cadastro');
        }

        Session::regenerate();
        Session::set('usuario', ['id' => $usuarioId, 'nome' => $dados['nome'], 'tipo' => 'oficina']);
        Tenant::set($empresaId);
        Session::set('papel', 'admin');
        $this->redirect('/oficina');
    }

    public function login(Request $req): void
    {
        $email = strtolower(trim((string) $req->input('email')));
        $key = "login|{$req->ip}|{$email}";

        if (RateLimiter::tooMany($key)) {
            Logger::security('login_bloqueado', "ip={$req->ip}");
            \App\Core\Response::abort(429);
        }
        if (Validator::validate($req->body, ['email' => 'required|email', 'senha' => 'required'])) {
            Session::flash('erro', 'Credenciais inválidas.');
            $this->redirect('/login');
        }

        $u = Database::query('SELECT * FROM usuarios WHERE email = ? AND deleted_at IS NULL LIMIT 1', [$email])->fetch();
        // mensagem única evita enumeração de usuários
        if (!$u || !Hash::verify((string) $req->input('senha'), $u['senha_hash'])) {
            RateLimiter::hit($key);
            Logger::security('login_falhou', "ip={$req->ip} email={$email}");
            Session::flash('erro', 'Credenciais inválidas.');
            $this->redirect('/login');
        }

        RateLimiter::clear($key);
        Session::regenerate();                                   // anti session fixation
        Session::set('usuario', ['id' => (int) $u['id'], 'nome' => $u['nome'], 'tipo' => $u['tipo']]);

        if ($u['tipo'] === 'cliente') $this->redirect('/portal');

        // vínculos com oficinas (usuário pode ter várias)
        $vinculos = Database::query('SELECT eu.empresa_id, eu.papel FROM empresa_usuario eu JOIN empresas e ON e.id = eu.empresa_id WHERE eu.usuario_id = ? AND eu.ativo = 1 AND e.deleted_at IS NULL', [$u['id']])->fetchAll();
        if (count($vinculos) === 1) {
            Tenant::set((int) $vinculos[0]['empresa_id']);
            Session::set('papel', $vinculos[0]['papel']);
            $this->redirect('/oficina');
        }
        $this->redirect('/selecionar-empresa');
    }

    public function showCompanies(Request $req): void
    {
        $usuario = auth();
        $empresas = Database::query(
            'SELECT e.id, e.nome, eu.papel FROM empresa_usuario eu JOIN empresas e ON e.id = eu.empresa_id WHERE eu.usuario_id = ? AND eu.ativo = 1 AND e.deleted_at IS NULL ORDER BY e.nome',
            [$usuario['id']]
        )->fetchAll();
        if (count($empresas) === 1) {
            Tenant::set((int) $empresas[0]['id']);
            Session::set('papel', $empresas[0]['papel']);
            $this->redirect('/oficina');
        }
        $this->view('auth/selecionar-empresa', ['empresas' => $empresas], 'auth');
    }

    public function selectCompany(Request $req): void
    {
        $usuario = auth();
        $empresaId = (int) $req->input('empresa_id');
        $vinculo = Database::query('SELECT eu.empresa_id, eu.papel FROM empresa_usuario eu JOIN empresas e ON e.id = eu.empresa_id WHERE eu.usuario_id = ? AND eu.empresa_id = ? AND eu.ativo = 1 AND e.deleted_at IS NULL LIMIT 1', [$usuario['id'], $empresaId])->fetch();
        if (!$vinculo) \App\Core\Response::abort(403);
        Tenant::set((int) $vinculo['empresa_id']);
        Session::set('papel', $vinculo['papel']);
        $this->redirect('/oficina');
    }

    public function logout(Request $req): void
    {
        Session::destroy();
        $this->redirect('/login');
    }
}
