<?php
// Uso: php database/seeds/DemoSeeder.php  (cria os dados da oficina + 1 admin de teste)
define('BASE_PATH', dirname(__DIR__, 2));
require BASE_PATH . '/app/Core/Env.php';
require BASE_PATH . '/app/Core/Database.php';
require BASE_PATH . '/app/Core/Security/Hash.php';
\App\Core\Env::load(BASE_PATH . '/.env');
use App\Core\Database; use App\Core\Security\Hash;

Database::query("INSERT INTO oficina (id, nome) VALUES (1, 'Minha Oficina') ON DUPLICATE KEY UPDATE nome = nome");
Database::query("INSERT INTO usuarios (nome,email,senha_hash,papel) VALUES (?,?,?, 'admin')",
    ['Admin', 'admin@demo.local', Hash::make('trocar-esta-senha-123')]);
echo "OK: admin@demo.local / trocar-esta-senha-123 (troque depois)\n";
