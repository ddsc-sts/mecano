<?php
// Uso: php database/seeds/DemoSeeder.php  (cria 1 empresa + 1 admin de teste)
define('BASE_PATH', dirname(__DIR__, 2));
require BASE_PATH . '/app/Core/Env.php';
require BASE_PATH . '/app/Core/Database.php';
require BASE_PATH . '/app/Core/Security/Hash.php';
\App\Core\Env::load(BASE_PATH . '/.env');
use App\Core\Database; use App\Core\Security\Hash;

$emp = Database::query("INSERT INTO empresas (nome) VALUES ('Oficina Demo')");
$empId = (int) Database::pdo()->lastInsertId();
Database::query("INSERT INTO usuarios (nome,email,senha_hash,tipo) VALUES (?,?,?, 'oficina')",
    ['Admin Demo', 'admin@demo.local', Hash::make('trocar-esta-senha-123')]);
$uid = (int) Database::pdo()->lastInsertId();
Database::query("INSERT INTO empresa_usuario (empresa_id,usuario_id,papel) VALUES (?,?, 'admin')", [$empId, $uid]);
echo "OK: admin@demo.local / trocar-esta-senha-123 (troque depois)\n";
