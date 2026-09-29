# Changelog

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
