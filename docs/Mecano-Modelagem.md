**Modelagem do Projeto Mecano**

1. Objetivo da Modelagem

O Mecano será uma plataforma SaaS para gestão de oficinas mecânicas e centros automotivos.

A modelagem será construída para representar o fluxo principal:

Cliente → Veículo → Diagnóstico → Orçamento → Aprovação → Ordem de Serviço → Execução → Peças → Estoque → Pagamento → Histórico

Um dos principais diferenciais do sistema será o histórico visual do veículo, relacionando:

Veículo → Componente → Serviço → Peça → Ordem de Serviço → Histórico

A arquitetura também deverá considerar o funcionamento SaaS multiempresa, garantindo que os dados de uma oficina permaneçam isolados dos dados de outras empresas.

2. Arquitetura Geral dos Dados

A estrutura principal do banco será organizada da seguinte forma:

EMPRESA
   │
   ├── USUÁRIOS
   │     └── PAPÉIS
   │           └── PERMISSÕES
   │
   ├── CLIENTES
   │     └── VEÍCULOS
   │            │
   │            ├── DIAGNÓSTICOS
   │            ├── ORÇAMENTOS
   │            ├── ORDENS DE SERVIÇO
   │            └── HISTÓRICO
   │
   ├── SERVIÇOS
   │
   ├── PEÇAS
   │     └── MOVIMENTAÇÕES DE ESTOQUE
   │
   ├── PAGAMENTOS
   │
   └── LOGS DE AUDITORIA


MODELO DO VEÍCULO
   │
   ├── MODELO 3D
   │
   └── COMPONENTES

3. Empresas

Tabela: companies

Representa as oficinas ou empresas que utilizam o Mecano.

Campos

Campo

Descrição

id 

Identificador da empresa 

name 

Nome da empresa 

cnpj 

CNPJ 

email 

E-mail 

phone 

Telefone 

address 

Endereço 

status 

Status da empresa 

created_at 

Data de criação 

updated_at 

Data de atualização 

Relacionamentos

COMPANY 1 ─── N USERS
COMPANY 1 ─── N CUSTOMERS
COMPANY 1 ─── N SERVICES
COMPANY 1 ─── N PARTS
COMPANY 1 ─── N QUOTES
COMPANY 1 ─── N WORK_ORDERS
COMPANY 1 ─── N PAYMENTS

4. Usuários

Tabela: users

Representa os usuários internos de cada oficina.

Campos

Campo

Descrição

id 

Identificador 

company_id 

Empresa do usuário 

name 

Nome 

email 

E-mail 

password 

Senha armazenada de forma segura 

role_id 

Papel do usuário 

status 

Status 

created_at 

Data de criação 

updated_at 

Data de atualização 

Relacionamento

COMPANY 1 ─── N USERS
ROLE 1 ─── N USERS

5. Papéis

Tabela: roles

Define as funções dos usuários.

Exemplos

Administrador

Atendente

Mecânico

Financeiro

Campos

Campo

Descrição

id 

Identificador 

name 

Nome do papel 

6. Permissões

Tabela: permissions

Representa as permissões disponíveis no sistema.

Exemplos

customers.view
customers.create
customers.edit

vehicles.view
vehicles.create
vehicles.edit

quotes.create
quotes.edit
quotes.approve

work_orders.create
work_orders.edit

stock.view
stock.manage

finance.view
reports.view
users.manage

Tabela: role_permissions

Relaciona papéis e permissões.

Campo

Descrição

id 

Identificador 

role_id 

Papel 

permission_id 

Permissão 

Relacionamento

ROLE N ─── N PERMISSION

7. Clientes

Tabela: customers

Representa os clientes das oficinas.

Campos

Campo

Descrição

id 

Identificador 

company_id 

Empresa responsável 

name 

Nome 

cpf_cnpj 

Documento 

phone 

Telefone 

email 

E-mail 

address 

Endereço 

created_at 

Data de criação 

updated_at 

Data de atualização 

Regra

Um cliente poderá possuir vários veículos.

CUSTOMER 1 ─── N VEHICLES

8. Veículos

Tabela: vehicles

Representa os veículos cadastrados pelos clientes.

Campos

Campo

Descrição

id 

Identificador 

company_id 

Empresa 

customer_id 

Proprietário 

vehicle_model_id 

Modelo do veículo 

plate 

Placa 

color 

Cor 

mileage 

Quilometragem 

observations 

Observações 

created_at 

Data de criação 

updated_at 

Data de atualização 

Informações relacionadas

O modelo do veículo poderá fornecer:

marca;

modelo;

versão;

ano;

combustível;

motorização.

Relacionamento

CUSTOMER 1 ─── N VEHICLES
VEHICLE_MODEL 1 ─── N VEHICLES

9. Modelos de Veículos

Tabela: vehicle_models

Representa modelos de veículos existentes no sistema.

Campos

Campo

Descrição

id 

Identificador 

brand 

Marca 

model 

Modelo 

version 

Versão 

year_start 

Ano inicial 

year_end 

Ano final 

fuel 

Combustível 

engine 

Motorização 

created_at 

Data de criação 

Exemplo:

Toyota
Corolla
2.0
2020
Flex

Essa tabela é importante para permitir que diferentes veículos possam utilizar o mesmo modelo base.

10. Modelos 3D

Tabela: vehicle_3d_models

Representa os modelos tridimensionais utilizados pelo sistema.

Campos

Campo

Descrição

id 

Identificador 

vehicle_model_id 

Modelo relacionado 

file_path 

Localização do arquivo 

file_format 

Formato do modelo 

version 

Versão do modelo 

created_at 

Data de criação 

Exemplo:

Toyota Corolla 2020
        ↓
corolla_2020.glb

A implementação do recurso 3D poderá utilizar posteriormente uma biblioteca ou tecnologia específica para visualização no navegador.

11. Componentes do Veículo

Tabela: vehicle_components

Representa os componentes que podem ser identificados no modelo do veículo.

Campos

Campo

Descrição

id 

Identificador 

vehicle_model_id 

Modelo do veículo 

name 

Nome do componente 

category 

Categoria 

model_node 

Identificador do objeto dentro do modelo 3D 

description 

Descrição 

Exemplos

Motor
Freio dianteiro esquerdo
Freio dianteiro direito
Disco dianteiro
Pastilha
Amortecedor
Bateria
Alternador

Categorias possíveis

Motor
Transmissão
Suspensão
Freios
Elétrica
Arrefecimento
Direção
Escapamento
Carroceria
Iluminação
Pneus

12. Serviços

Tabela: services

Representa os serviços oferecidos pela oficina.

Campos

Campo

Descrição

id 

Identificador 

company_id 

Empresa 

name 

Nome 

description 

Descrição 

category 

Categoria 

price 

Valor 

estimated_time 

Tempo estimado 

created_at 

Data de criação 

updated_at 

Data de atualização 

Exemplos

Troca de óleo
Troca de pastilhas
Alinhamento
Balanceamento
Revisão
Troca de amortecedor
Diagnóstico

13. Peças

Tabela: parts

Representa as peças e produtos utilizados pela oficina.

Campos

Campo

Descrição

id 

Identificador 

company_id 

Empresa 

name 

Nome 

code 

Código 

manufacturer 

Fabricante 

category 

Categoria 

cost_price 

Preço de custo 

sale_price 

Preço de venda 

stock_quantity 

Quantidade atual 

minimum_stock 

Estoque mínimo 

description 

Descrição 

created_at 

Data de criação 

updated_at 

Data de atualização 

14. Movimentação de Estoque

Tabela: stock_movements

Registra as alterações no estoque.

Campos

Campo

Descrição

id 

Identificador 

company_id 

Empresa 

part_id 

Peça 

user_id 

Usuário responsável 

type 

Tipo de movimentação 

quantity 

Quantidade 

reason 

Motivo 

reference_id 

Registro relacionado 

created_at 

Data 

Tipos

ENTRADA
SAIDA
UTILIZACAO
AJUSTE

Exemplo

Peça: Filtro de óleo
Movimentação: UTILIZAÇÃO
Quantidade: 1
Motivo: O.S. #1048

15. Diagnósticos

Tabela: diagnoses

Registra os diagnósticos realizados nos veículos.

Campos

Campo

Descrição

id 

Identificador 

company_id 

Empresa 

vehicle_id 

Veículo 

user_id 

Usuário responsável 

description 

Diagnóstico 

created_at 

Data 

16. Orçamentos

Tabela: quotes

Representa os orçamentos criados para os clientes.

Campos

Campo

Descrição

id 

Identificador 

company_id 

Empresa 

customer_id 

Cliente 

vehicle_id 

Veículo 

created_by 

Usuário 

status 

Status 

subtotal 

Subtotal 

discount 

Desconto 

total 

Total 

valid_until 

Validade 

notes 

Observações 

created_at 

Data 

updated_at 

Data de atualização 

Status

RASCUNHO
ENVIADO
AGUARDANDO_APROVACAO
APROVADO
RECUSADO
EXPIRADO

17. Itens do Orçamento

Tabela: quote_items

Permite adicionar serviços e peças ao orçamento.

Campos

Campo

Descrição

id 

Identificador 

quote_id 

Orçamento 

item_type 

Tipo do item 

service_id 

Serviço 

part_id 

Peça 

description 

Descrição 

quantity 

Quantidade 

unit_price 

Valor unitário 

total 

Total 

Relacionamento

QUOTE 1 ─── N QUOTE_ITEMS

18. Ordens de Serviço

Tabela: work_orders

Representa a execução do atendimento.

Campos

Campo

Descrição

id 

Identificador 

company_id 

Empresa 

quote_id 

Orçamento 

customer_id 

Cliente 

vehicle_id 

Veículo 

mechanic_id 

Mecânico 

diagnosis_id 

Diagnóstico 

status 

Status 

mileage 

Quilometragem 

notes 

Observações 

total 

Total 

started_at 

Início 

completed_at 

Conclusão 

created_at 

Criação 

updated_at 

Atualização 

Status

ABERTA
DIAGNOSTICO
AGUARDANDO_APROVACAO
APROVADA
EM_EXECUCAO
CONCLUIDA
ENTREGUE

19. Itens da Ordem de Serviço

Tabela: work_order_items

Representa os serviços e peças utilizados na ordem.

Campos

Campo

Descrição

id 

Identificador 

work_order_id 

O.S. 

item_type 

Tipo 

service_id 

Serviço 

part_id 

Peça 

component_id 

Componente 

description 

Descrição 

quantity 

Quantidade 

unit_price 

Valor unitário 

total 

Total 

O campo component_id é fundamental para o histórico visual.

Exemplo:

O.S. #1048
    ↓
Peça: Pastilha de freio
    ↓
Componente: Freio dianteiro esquerdo
    ↓
Veículo: Corolla 2020

20. Histórico de Manutenção

Tabela: maintenance_records

Representa o histórico de manutenção do veículo.

Campos

Campo

Descrição

id 

Identificador 

company_id 

Empresa 

vehicle_id 

Veículo 

work_order_id 

O.S. 

component_id 

Componente 

service_id 

Serviço 

part_id 

Peça 

user_id 

Responsável 

mileage 

Quilometragem 

description 

Descrição 

performed_at 

Data da manutenção 

created_at 

Data do registro 

Exemplo

VEÍCULO
Toyota Corolla 2020

COMPONENTE
Freio dianteiro esquerdo

SERVIÇO
Substituição das pastilhas

PEÇA
Pastilha Bosch

QUILOMETRAGEM
62.450 km

O.S.
#1048

DATA
15/04/2025

21. Pagamentos

Tabela: payments

Registra os pagamentos relacionados às ordens de serviço.

Campos

Campo

Descrição

id 

Identificador 

company_id 

Empresa 

work_order_id 

O.S. 

customer_id 

Cliente 

amount 

Valor 

method 

Método 

status 

Status 

paid_at 

Data do pagamento 

created_at 

Data 

Métodos possíveis

PIX
DINHEIRO
CARTAO_CREDITO
CARTAO_DEBITO
TRANSFERENCIA
OUTRO

22. Auditoria

Tabela: audit_logs

Registra ações importantes realizadas pelos usuários.

Campos

Campo

Descrição

id 

Identificador 

company_id 

Empresa 

user_id 

Usuário 

action 

Ação 

table_name 

Tabela afetada 

record_id 

Registro afetado 

description 

Descrição 

created_at 

Data 

Exemplo

Usuário: Carlos
Ação: Alteração de estoque
Registro: Peça #42
Descrição: Retirada de 2 unidades

23. Diagrama Conceitual Inicial

                         ┌──────────────┐
                         │   COMPANIES  │
                         └──────┬───────┘
                                │
              ┌─────────────────┼──────────────────┐
              │                 │                  │
              ▼                 ▼                  ▼
         ┌─────────┐       ┌───────────┐      ┌──────────┐
         │  USERS  │       │ CUSTOMERS │      │ SERVICES │
         └────┬────┘       └─────┬─────┘      └──────────┘
              │                  │
              │                  ▼
              │            ┌───────────┐
              │            │ VEHICLES  │
              │            └─────┬─────┘
              │                  │
              │        ┌─────────┼─────────┐
              │        │         │         │
              │        ▼         ▼         ▼
              │   DIAGNOSES   QUOTES   HISTORY
              │                  │         ▲
              │                  ▼         │
              │             QUOTE_ITEMS    │
              │                  │         │
              │                  ▼         │
              │             WORK_ORDERS ───┘
              │                  │
              │                  ▼
              │          WORK_ORDER_ITEMS
              │             │         │
              │             │         └──────────┐
              │             ▼                    ▼
              │          PARTS              COMPONENTS
              │             │                    │
              │             ▼                    ▼
              │      STOCK_MOVEMENTS       VEHICLE_MODEL
              │
              └──────────────┐
                             ▼
                         PAYMENTS

24. Relacionamentos Principais

COMPANY 1 ─── N USERS

COMPANY 1 ─── N CUSTOMERS

CUSTOMER 1 ─── N VEHICLES

VEHICLE_MODEL 1 ─── N VEHICLES

VEHICLE_MODEL 1 ─── N VEHICLE_COMPONENTS

VEHICLE_MODEL 1 ─── N VEHICLE_3D_MODELS

COMPANY 1 ─── N SERVICES

COMPANY 1 ─── N PARTS

PART 1 ─── N STOCK_MOVEMENTS

VEHICLE 1 ─── N DIAGNOSES

VEHICLE 1 ─── N QUOTES

QUOTE 1 ─── N QUOTE_ITEMS

QUOTE 1 ─── 0..1 WORK_ORDER

WORK_ORDER 1 ─── N WORK_ORDER_ITEMS

WORK_ORDER 1 ─── N PAYMENTS

VEHICLE 1 ─── N MAINTENANCE_RECORDS

COMPONENT 1 ─── N MAINTENANCE_RECORDS

SERVICE 1 ─── N MAINTENANCE_RECORDS

PART 1 ─── N MAINTENANCE_RECORDS

25. Fluxo do Atendimento

CLIENTE
   │
   ▼
VEÍCULO
   │
   ▼
IDENTIFICAÇÃO POR PLACA
   │
   ▼
REGISTRO DO PROBLEMA
   │
   ▼
DIAGNÓSTICO
   │
   ▼
ORÇAMENTO
   │
   ▼
APROVAÇÃO DO CLIENTE
   │
   ▼
ORDEM DE SERVIÇO
   │
   ▼
EXECUÇÃO
   │
   ├── SERVIÇO
   │
   └── PEÇA
          │
          ▼
       ESTOQUE
          │
          ▼
       FINALIZAÇÃO
          │
          ├── PAGAMENTO
          │
          └── HISTÓRICO
                    │
                    ▼
             HISTÓRICO VISUAL
                    │
                    ▼
               MODELO 3D
                    │
                    ▼
              COMPONENTE

26. Histórico Visual

O diferencial visual do Mecano será baseado na relação entre o modelo 3D e os registros de manutenção.

Exemplo:

VEÍCULO
Toyota Corolla 2020
        │
        ▼
MODELO 3D
        │
        ▼
COMPONENTE
Freio dianteiro esquerdo
        │
        ▼
HISTÓRICO
        │
        ├── Serviço
        │
        ├── Peça
        │
        ├── Data
        │
        ├── Quilometragem
        │
        └── O.S.

Quando o usuário selecionar o componente no modelo 3D, o sistema deverá conseguir localizar os registros de manutenção associados.

27. Multiempresa

Toda informação operacional pertencente a uma oficina deverá estar vinculada ao company_id.

Exemplo:

Oficina Alpha
    │
    ├── Cliente João
    ├── Corolla ABC1234
    ├── O.S. #1001
    └── Estoque

Oficina Beta
    │
    ├── Cliente Maria
    ├── Civic XYZ5678
    ├── O.S. #2001
    └── Estoque

A aplicação deverá impedir que usuários da Oficina Alpha consultem registros pertencentes à Oficina Beta.

28. Ordem de Implementação

A programação deverá seguir uma ordem que reduza dependências.

Fase 1 — Banco e estrutura

criar banco;

criar empresas;

criar usuários;

criar papéis;

criar permissões;

criar auditoria.

Fase 2 — Autenticação

login;

logout;

sessões;

controle de acesso;

permissões.

Fase 3 — Clientes e veículos

cadastro de clientes;

cadastro de veículos;

busca por placa;

histórico básico.

Fase 4 — Serviços e estoque

cadastro de serviços;

cadastro de peças;

entradas;

saídas;

estoque mínimo;

movimentações.

Fase 5 — Atendimento

diagnóstico;

orçamento;

aprovação;

ordem de serviço;

execução;

conclusão.

Fase 6 — Histórico

geração do histórico;

relação com O.S.;

relação com serviços;

relação com peças;

relação com componentes;

quilometragem.

Fase 7 — 3D

cadastro dos modelos;

cadastro dos componentes;

associação do modelo 3D;

visualização no navegador;

seleção de componentes;

exibição do histórico.

Fase 8 — Portal do cliente

login;

veículos;

orçamento;

aprovação;

O.S.;

histórico;

visualização 3D.

Fase 9 — Dashboard e relatórios

indicadores;

ordens abertas;

faturamento;

estoque;

serviços;

relatórios.

29. Próximo Passo

Antes de iniciar a programação das telas, deverá ser concluída a modelagem do banco de dados.

A sequência recomendada será:

ESCOPO
   ↓
MODELAGEM CONCEITUAL
   ↓
DER
   ↓
MODELO LÓGICO
   ↓
DEFINIÇÃO DAS TABELAS
   ↓
PK / FK / UNIQUE / NOT NULL
   ↓
SQL
   ↓
BANCO MYSQL
   ↓
ESTRUTURA PHP
   ↓
TELAS
   ↓
FUNCIONALIDADES

O próximo documento técnico a ser produzido deverá ser o DER completo do Mecano, contendo todas as entidades, atributos, chaves primárias, chaves estrangeiras e cardinalidades.

Depois do DER, o banco poderá ser transformado em SQL para implementação no MySQL.