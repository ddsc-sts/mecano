# Changelog

## v1.6 - Oficina única (sobre a v1.5)
- removido: multiempresa/SaaS (Empresa, EmpresaUsuario, Tenant, TenantScope, TenantMiddleware,
  TenantService, TenantViolationException, Plano, Assinatura, PlanoService, PlanoExcedidoException,
  AssinaturaMiddleware, Papel, Permissao, config/planos.php, docs/multiempresa.md,
  TenantIsolationTest, ADRs 001/002 antigos)
- removido: coluna empresa_id, FKs compostas e rota /selecionar-empresa
+ Models/Oficina (tabela `oficina` com 1 linha), tests/Security/AcessoClienteTest
+ usuarios.papel (admin, gerente, mecanico, atendente, cliente), substitui a pivô empresa_usuario
+ OficinaMiddleware e ClienteMiddleware implementados
+ docs/decisoes/001-oficina-unica.md
~ Core/Model (sem filtro de empresa; mantém soft delete e $fillable)
~ AuthController (papel vem do usuário; sem seleção de empresa)
~ PapelMiddleware (lê auth()['papel']), rotas oficina, migrations 001/002, DemoSeeder,
  ErrorHandler, README, config/app.php
~ placa agora UNIQUE global (uma oficina)
= mantidos: camada de segurança, fluxo, portal, 3D, Enums, Policies (agora só checam posse do cliente)

## v1.5 - Esqueleto gerado (sobre a v1.4)
+ Código real: Core (Env, ErrorHandler, Request, Response, View, Controller, Database, Session,
  Tenant, TenantScope, Model, Router), Security (Csrf, Hash, SecurityHeaders, Logger, RateLimiter, Validator)
+ Middlewares: Csrf, Auth, Guest, Tenant, Papel
+ AuthController (login/logout), DashboardController, VeiculoController (busca por placa)
+ Models: Empresa, Usuario, Cliente, Veiculo
+ Enums com máquina de estados (OrcamentoStatus, OrdemServicoStatus, ...)
+ Migrations 001 (núcleo, FKs compostas) e 002 (orçamentos versionados e aprovação com hash)
+ Views base, páginas de erro, rotas, configs, DemoSeeder
+ Stubs (classe vazia com TODO) para todo o restante da estrutura v1.4
= Estrutura de pastas idêntica à v1.4
