# Mecano (esqueleto v1.5)

Plataforma web para oficinas: veículo no centro, portal do cliente e prontuário visual 3D.

## Subir localmente
1. PHP 8.2+ e MySQL 8.
2. `cp .env.example .env` e preencha `DB_*` e `APP_KEY`.
3. `mysql -u root -p mecano < database/migrations/001_nucleo.sql` (e `002_orcamentos.sql`).
4. `php database/seeds/DemoSeeder.php`
5. `php -S localhost:8000 -t public` (em local, o `.htaccess` não é usado; o servidor embutido roteia via `public/index.php`).
6. Acesse http://localhost:8000/login

## Pontos de segurança já ativos
PDO com prepared statements reais, `empresa_id` automático no Model, CSRF em todo POST,
Argon2id, sessão HttpOnly/SameSite com regeneração no login, rate limit no login,
security headers, erros genéricos com log em `storage/logs`, uploads fora de `public/`.

## Próximos passos
Ver CHANGELOG.md. Arquivos `TODO` são stubs prontos para implementar.
