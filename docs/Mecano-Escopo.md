**Escopo do Projeto — Mecano**

1. Identificação do Projeto

Nome do produto: Mecano
Tipo de solução: Software como Serviço (SaaS — Software as a Service)
Categoria: Sistema de gestão empresarial verticalizado
Segmento: Oficinas mecânicas e centros automotivos
Plataforma: Aplicação web responsiva
Modelo de acesso: Sistema destinado a uma única oficina, com autenticação, controle de acesso e permissões de usuários.

2. Visão Geral do Projeto

O Mecano será uma plataforma SaaS especializada na gestão de oficinas mecânicas e centros automotivos.
O objetivo central do sistema será centralizar as informações administrativas e operacionais relacionadas aos clientes, veículos, diagnósticos, serviços realizados, peças, estoque, pagamentos e histórico de manutenção.
A proposta do Mecano não é substituir o WhatsApp ou outros canais utilizados pela oficina para conversar com seus clientes. O atendimento e a comunicação continuarão podendo ocorrer normalmente pelo WhatsApp. O Mecano será utilizado para organizar, registrar e administrar as informações geradas durante esses atendimentos.
O fluxo principal do sistema será:
Cliente → Veículo → Diagnóstico → Execução → Peças → Estoque → Pagamento → Histórico
O sistema deverá permitir que a oficina tenha controle administrativo sobre seus atendimentos e, ao mesmo tempo, disponibilizar ao cliente um portal onde ele possa acompanhar seus veículos e consultar o histórico das manutenções realizadas.
O veículo será o elemento central dessa estrutura. Cada manutenção deverá gerar informações que poderão ser consultadas posteriormente.
Como diferencial, o Mecano utilizará uma representação visual simplificada do veículo para demonstrar onde uma manutenção foi realizada e qual componente recebeu intervenção.

3. Problema Identificado

Oficinas mecânicas precisam controlar simultaneamente diferentes tipos de informações durante o atendimento de um veículo.
Entre essas informações estão:

clientes;

veículos;

diagnósticos;

serviços;

peças;

estoque;

pagamentos;

funcionários;

histórico de manutenção.

Quando esses dados são controlados através de planilhas, cadernos, documentos, mensagens ou sistemas separados, podem surgir problemas como:

dificuldade para localizar informações;

duplicidade de registros;

perda de histórico;

dificuldade para acompanhar serviços;

falta de controle sobre peças;

inconsistências no estoque;

dificuldade para acompanhar os serviços realizados;

dificuldade para informar o cliente sobre o que foi realizado;

ausência de informações centralizadas para auxiliar a gestão.

O Mecano será desenvolvido para centralizar essas informações em uma única plataforma, sem necessariamente substituir os canais de comunicação utilizados pela oficina.

4. Objetivo Geral

Desenvolver uma plataforma web para gerenciamento de uma oficina mecânica ou centro automotivo, permitindo controlar de maneira integrada clientes, veículos, diagnósticos, serviços, peças, estoque, pagamentos e histórico de manutenção.
Além do gerenciamento operacional e administrativo, o sistema deverá proporcionar ao cliente uma forma clara de acompanhar seus veículos e compreender os serviços realizados.
Como diferencial, o Mecano deverá utilizar uma representação visual simplificada do veículo para relacionar componentes, serviços e peças ao histórico de manutenção, incluindo animações que demonstrem visualmente o local onde determinada peça ou componente recebeu manutenção.

5. Objetivos Específicos

O sistema deverá permitir:

Cadastrar usuários e definir permissões.

Gerenciar clientes.

Cadastrar e gerenciar veículos.

Identificar veículos através da placa.

Associar veículos aos seus respectivos proprietários.

Registrar informações técnicas do veículo.

Consultar o histórico de manutenção.

Registrar diagnósticos.

Registrar serviços realizados.

Registrar peças utilizadas.

Controlar movimentações de estoque.

Atualizar o estoque conforme a utilização das peças.

Registrar pagamentos.

Manter o histórico completo dos atendimentos.

Disponibilizar indicadores através de um dashboard.

Permitir que clientes acompanhem seus veículos.

Permitir que clientes consultem os serviços realizados.

Permitir que clientes consultem as peças utilizadas.

Permitir que clientes consultem pagamentos e documentos relacionados ao atendimento.

Disponibilizar documentos, como notas fiscais, quando cadastrados ou integrados ao sistema.

Apresentar visualmente componentes do veículo que receberam manutenção.

Relacionar componentes do veículo aos serviços realizados.

Relacionar serviços às peças utilizadas.

Executar animações simples para demonstrar visualmente onde uma peça ou componente foi substituído ou recebeu manutenção.

Registrar informações relevantes sobre cada manutenção.

Registrar ações relevantes realizadas pelos usuários.

Manter a arquitetura preparada para futuras integrações e funcionalidades.

6. Público-Alvo

O Mecano será direcionado principalmente para:

6.1 Oficinas mecânicas

Especialmente oficinas de pequeno e médio porte que realizam serviços como:

manutenção preventiva;

manutenção corretiva;

troca de óleo;

revisão;

freios;

suspensão;

alinhamento;

balanceamento;

diagnóstico;

elétrica automotiva;

substituição de peças.

6.2 Centros automotivos

Empresas que trabalham com diferentes serviços de manutenção e necessitam controlar clientes, veículos, serviços, peças, estoque e pagamentos.

6.3 Funcionários da oficina

O sistema poderá atender diferentes funções, como:

proprietário;

administrador;

responsável pelo financeiro.

Cada função deverá possuir acesso apenas aos recursos necessários para suas atividades.

6.4 Clientes da oficina

Os clientes terão acesso ao sistema através de um portal próprio, podendo acompanhar informações relacionadas aos seus veículos e ao histórico de manutenção.

7. Principais Usuários do Sistema

7.1 Administrador da Oficina

Responsável pela configuração e gerenciamento do sistema e da oficina.
Poderá:

gerenciar usuários;

configurar permissões;

visualizar indicadores;

gerenciar serviços;

gerenciar peças;

acompanhar estoque;

acompanhar serviços;

acompanhar pagamentos;

acessar relatórios;

consultar histórico dos veículos.

7.2 Atendente

Responsável principalmente pelo cadastro e acompanhamento dos clientes e veículos.
Poderá:

cadastrar clientes;

cadastrar veículos;

localizar veículos;

registrar solicitações;

acompanhar diagnósticos;

registrar serviços;

acompanhar atendimentos;

consultar informações administrativas.

A comunicação com o cliente poderá continuar sendo realizada pelo WhatsApp ou por outros canais externos à plataforma.

7.4 Cliente

Terá acesso ao seu próprio portal.
Poderá:

visualizar seus veículos;

consultar informações dos veículos;

acompanhar serviços realizados;

consultar diagnósticos registrados;

consultar peças utilizadas;

consultar pagamentos;

consultar documentos disponíveis;

consultar histórico de manutenção;

utilizar a representação visual do veículo para compreender as manutenções realizadas;

visualizar animações que indiquem o componente ou região do veículo onde o serviço foi realizado.

8. Fluxo Principal do Sistema

O funcionamento do Mecano será organizado principalmente nas seguintes etapas:
Cliente → Veículo → Diagnóstico → Execução → Peças → Estoque → Pagamento → Histórico

8.1 Entrada do cliente

O funcionário localiza ou cadastra o cliente.
Em seguida, localiza ou cadastra o veículo relacionado ao cliente.
A comunicação inicial e o acompanhamento do cliente poderão continuar acontecendo através do WhatsApp.

8.2 Identificação do veículo

O veículo poderá ser localizado através da placa.
O sistema deverá apresentar informações cadastradas, como:

placa;

marca;

modelo;

versão;

ano;

cor;

motorização;

quilometragem;

proprietário;

histórico.

8.3 Registro do problema

O funcionário deverá registrar a solicitação ou problema relatado pelo cliente.

8.4 Diagnóstico

A oficina poderá registrar informações obtidas durante a avaliação do veículo.
O diagnóstico deverá poder ser relacionado a um ou mais componentes do veículo.

8.5 Execução

Durante a execução, o mecânico poderá:

consultar o diagnóstico;

registrar procedimentos;

registrar serviços realizados;

registrar peças utilizadas;

adicionar observações;

atualizar o andamento do serviço;

indicar o componente ou região do veículo onde o serviço foi realizado.

8.6 Peças

As peças utilizadas deverão ser vinculadas ao serviço realizado.
O sistema deverá registrar:

peça utilizada;

quantidade;

valor;

fabricante, quando aplicável;

serviço relacionado;

componente relacionado;

data da utilização.

8.7 Estoque

A utilização de uma peça deverá poder gerar automaticamente uma movimentação de saída no estoque.

8.8 Pagamento

Após a conclusão do atendimento, o pagamento poderá ser registrado.
O sistema poderá armazenar:

valor;

forma de pagamento;

data;

situação;

atendimento relacionado.

8.9 Finalização

Após a conclusão:

os serviços executados serão armazenados no histórico;

as peças utilizadas serão associadas ao histórico;

a quilometragem poderá ser registrada;

o pagamento poderá ser registrado;

documentos relacionados poderão ser associados;

as informações poderão ser consultadas posteriormente pelo cliente e pela oficina.

9. Histórico do Veículo

O histórico será um dos elementos centrais do Mecano.
Cada veículo deverá possuir um histórico contendo informações relacionadas aos atendimentos realizados.
Poderão ser registrados:

data;

quilometragem;

diagnóstico;

componentes envolvidos;

serviços realizados;

peças utilizadas;

valores;

pagamento;

documentos;

observações;

responsável pelo serviço.

O histórico deverá servir não apenas como registro de serviços anteriores, mas também como fonte de informação para futuros atendimentos.
Quando o veículo retornar à oficina, os funcionários poderão consultar seu histórico antes de iniciar um novo atendimento.

10. Histórico Visual do Veículo

O Mecano terá como diferencial a apresentação visual do histórico de manutenção.
A representação visual deverá utilizar um modelo 3D simples e otimizado do veículo ou de sua estrutura, sem a necessidade de reproduzir detalhadamente cada versão específica de todos os veículos existentes.
O objetivo principal será demonstrar de maneira visual onde a manutenção foi realizada.
O modelo poderá permitir:

girar o veículo;

aproximar e afastar;

visualizar diferentes ângulos;

selecionar componentes;

destacar componentes;

visualizar peças relacionadas;

consultar serviços realizados;

iniciar uma animação de manutenção.

O 3D não terá como objetivo funcionar como um simulador mecânico completo.
Sua função será ser uma ferramenta visual de comunicação do histórico de manutenção.

11. Animações de Manutenção

O Mecano deverá possuir animações simples associadas aos principais componentes ou sistemas do veículo.
A animação deverá demonstrar visualmente o local onde determinada manutenção foi realizada.
Por exemplo, em uma troca de pastilhas de freio:

Veículo completo
       ↓
Aproximação da roda dianteira
       ↓
Roda é afastada ou fica visualmente transparente
       ↓
Sistema de freio é apresentado
       ↓
Pastilha é destacada
       ↓
Indicação de "Peça substituída"

Após a animação, o sistema deverá apresentar as informações relacionadas à manutenção.
Exemplo:

COMPONENTE
Freio dianteiro esquerdo

SERVIÇO
Substituição das pastilhas

PEÇA
Pastilha de freio Bosch

DATA
15/04/2026

QUILOMETRAGEM
62.450 km

O mesmo conceito poderá ser aplicado a outros componentes, como:

amortecedores;

discos de freio;

bateria;

filtros;

componentes de suspensão;

componentes do motor;

outros componentes suportados pelo sistema.

As animações deverão ser curtas, simples e objetivas, priorizando a compreensão do cliente e o desempenho da aplicação.

12. Utilização do 3D pelo Cliente

A representação visual terá uma função importante no portal do cliente.
O objetivo não será apenas mostrar um modelo 3D, mas facilitar a compreensão do que foi realizado durante a manutenção.
Exemplo de fluxo:

Histórico
   ↓
Troca das pastilhas de freio
   ↓
[ Ver no veículo ]
   ↓
Modelo 3D
   ↓
Animação
   ↓
Freio dianteiro destacado
   ↓
Informações da manutenção

O cliente poderá selecionar uma manutenção do histórico e visualizar onde ela ocorreu no veículo.
Dessa forma, o cliente não precisará compreender termos técnicos para identificar qual parte do veículo recebeu manutenção e o que foi realizado nela.

13. Relação entre Veículo, Componente, Serviço e Peça

O sistema deverá estabelecer relações entre:
Veículo → Componente → Serviço → Peça → Atendimento → Histórico
Exemplo:
Veículo: Toyota Corolla 2020
Componente: Freio dianteiro
Serviço: Substituição das pastilhas
Peça: Pastilha de freio dianteira
Data: 15/04/2026
Quilometragem: 62.450 km
Essa estrutura permitirá responder consultas futuras, como:

Quando as pastilhas foram trocadas?

Qual peça foi utilizada?

Qual serviço foi realizado?

Em qual componente?

Em qual quilometragem?

Qual foi o valor?

Quem realizou o serviço?

Também permitirá iniciar a animação correspondente ao componente registrado.

14. Gestão de Clientes

O sistema deverá permitir cadastrar e gerenciar clientes.
As informações poderão incluir:

nome;

documentos necessários;

telefone;

e-mail;

endereço;

veículos associados;

histórico de atendimentos;

informações financeiras relacionadas aos atendimentos.

Um cliente poderá possuir mais de um veículo.

15. Gestão de Veículos

Cada veículo deverá estar relacionado a um cliente.
O cadastro poderá conter:

placa;

marca;

modelo;

versão;

ano;

cor;

combustível;

motorização;

quilometragem;

observações;

proprietário.

A placa será uma das principais formas de localização do veículo dentro do sistema.

16. Gestão de Serviços

A oficina poderá cadastrar os serviços que oferece.
Cada serviço poderá possuir:

nome;

descrição;

categoria;

valor;

tempo estimado;

observações;

componentes relacionados, quando aplicável;

animação relacionada, quando disponível.

Os serviços serão utilizados para registrar a execução dos atendimentos.

17. Gestão de Peças e Estoque

O sistema deverá permitir cadastrar peças e controlar suas movimentações.
As peças poderão possuir:

nome;

código;

fabricante;

categoria;

valor;

quantidade;

estoque mínimo;

observações.

As movimentações poderão ocorrer através de:

entrada;

saída;

utilização em atendimento;

ajustes de estoque.

O sistema poderá alertar quando determinado produto atingir quantidade inferior ao estoque mínimo definido pela oficina.

18. Gestão Financeira e Pagamentos

O sistema deverá permitir registrar os valores relacionados aos serviços e peças.
O administrador poderá visualizar:

valor das peças;

valor cobrado pela oficina;

valor dos serviços;

descontos;

valor total;

pagamentos realizados;

pagamentos pendentes.

Essas informações deverão permanecer associadas ao atendimento e ao histórico do veículo.

19. Documentos e Nota Fiscal

O histórico do atendimento poderá possuir documentos relacionados.
Quando uma nota fiscal estiver disponível, o cliente poderá visualizá-la no portal e realizar o download do documento.
Exemplo:

Atendimento — 15/04/2026

Serviços:
Troca de pastilhas

Peças:
Pastilha Bosch

Total:
R$ 280,00

Documentos:
[ Visualizar nota fiscal ]
[ Baixar PDF ]

A emissão automática de documentos fiscais poderá ser considerada uma integração futura.

20. Portal do Cliente

O cliente terá acesso a um ambiente próprio.
Nesse ambiente poderá visualizar:

seus dados;

seus veículos;

informações dos veículos;

diagnósticos;

serviços realizados;

peças utilizadas;

pagamentos;

documentos;

histórico de manutenção;

histórico visual do veículo;

animações das manutenções realizadas.

O cliente deverá ter acesso apenas às informações relacionadas à sua própria conta e aos seus veículos.

21. Dashboard da Oficina

O painel da oficina deverá apresentar uma visão geral da operação.
Os indicadores poderão incluir:

veículos em atendimento;

serviços em andamento;

serviços concluídos;

pagamentos pendentes;

faturamento;

peças com estoque baixo;

quantidade de clientes;

quantidade de veículos;

serviços realizados;

peças utilizadas.

Os indicadores deverão facilitar a identificação de situações que exigem atenção.

22. Controle de Usuários e Permissões

O sistema deverá possuir autenticação e controle de acesso.
Cada usuário deverá possuir permissões de acordo com sua função dentro da oficina.
As permissões poderão controlar funcionalidades como:

clientes;

veículos;

diagnósticos;

serviços;

peças;

estoque;

financeiro;

relatórios;

usuários;

configurações.

23. Estrutura da Oficina

O Mecano será desenvolvido para atender uma única oficina.
A aplicação possuirá uma estrutura centralizada para os dados da oficina, sem necessidade de cadastro ou gerenciamento de múltiplas empresas.

Os usuários do sistema serão responsáveis por operar os recursos de acordo com suas funções e permissões.

A estrutura principal da oficina será composta por:

usuários;

clientes;

veículos;

serviços;

peças;

estoque;

atendimentos;

pagamentos;

históricos;

configurações.

Os recursos visuais gerais, como modelos 3D e animações de componentes, poderão ser utilizados pelos usuários da oficina conforme suas permissões.

24. Segurança e Auditoria

O sistema deverá considerar mecanismos de segurança desde sua construção.
Entre eles:

autenticação;

controle de permissões;

proteção das sessões;

validação dos dados;

controle de acesso por usuário e função;

proteção das informações dos usuários;

armazenamento adequado de senhas;

registro de ações relevantes.

O sistema poderá manter registros de ações importantes realizadas pelos usuários para auxiliar na auditoria e rastreamento de alterações.

25. Relatórios

O sistema deverá permitir consultar informações administrativas e operacionais.
Inicialmente, poderão ser considerados relatórios como:

atendimentos;

serviços realizados;

peças utilizadas;

movimentações de estoque;

histórico de veículos;

pagamentos;

faturamento;

clientes atendidos.

Relatórios mais avançados poderão ser adicionados posteriormente.

26. Tecnologias Previstas

A primeira versão do projeto será desenvolvida utilizando:

PHP;

MySQL;

HTML5;

CSS3;

JavaScript;

Git;

GitHub;

XAMPP para ambiente de desenvolvimento.

Tecnologias e bibliotecas adicionais poderão ser incorporadas quando necessárias para funcionalidades específicas, especialmente na implementação da representação visual e dos recursos 3D.

27. Escopo Inicial — MVP

A primeira versão deverá priorizar os processos fundamentais da oficina.
O MVP deverá concentrar-se em:

autenticação;

usuários e permissões;

clientes;

veículos;

serviços;

peças;

estoque;

diagnóstico;

execução;

pagamento;

histórico do veículo;

dashboard básico;

portal básico do cliente;

registro de componentes relacionados às manutenções;

visualização 3D simples;

animações básicas para demonstrar componentes que receberam manutenção.

O MVP não deverá depender de um catálogo completo de modelos 3D específicos para todas as marcas e versões de veículos.
Inicialmente, a representação visual deverá utilizar modelos simples e controlados, priorizando a estrutura de dados e a relação entre componentes, serviços e histórico.

28. Funcionalidades Futuras

Após a consolidação do MVP, o sistema poderá evoluir para incluir:

modelos 3D mais completos;

animações adicionais de componentes;

catálogo de diferentes modelos de veículos;

consulta automática de veículos por placa;

notificações por e-mail;

integração com WhatsApp;

pagamentos online;

emissão de documentos fiscais;

integração com fornecedores;

relatórios avançados;

indicadores financeiros;

aplicativo mobile;

API pública;

integrações com sistemas externos;

planos e assinaturas automatizadas;

recursos de inteligência artificial.

Essas funcionalidades deverão ser consideradas na arquitetura, mas não precisam fazer parte da primeira versão.

29. Arquitetura Preparada para Evolução

O sistema deverá possuir uma estrutura modular.
A separação entre os principais módulos deverá permitir que novas funcionalidades sejam adicionadas sem a necessidade de reconstrução completa da aplicação.
A arquitetura deverá considerar desde o início:

separação entre frontend e backend;

organização de módulos;

banco de dados estruturado;

controle de acesso;

controle de acesso por usuário;

possibilidade de integração com APIs;

possibilidade de utilização de serviços externos;

estrutura para armazenamento e associação de modelos 3D;

estrutura para associação de animações a componentes;

manutenção e evolução do código.

30. Objetivo Acadêmico e Profissional

Além de funcionar como uma solução para oficinas, o Mecano será utilizado como projeto prático de Desenvolvimento de Sistemas.
O desenvolvimento deverá possibilitar a aplicação de conhecimentos relacionados a:

levantamento de requisitos;

análise de processos;

modelagem de dados;

modelagem de sistemas;

desenvolvimento frontend;

desenvolvimento backend;

banco de dados;

autenticação;

controle de permissões;

segurança;

testes;

versionamento;

documentação;

organização de código;

implantação.

O projeto deverá representar um ciclo completo de desenvolvimento de software, desde a definição do problema até a implementação da solução.

31. Resultado Esperado

Ao final da primeira versão, espera-se obter uma plataforma web funcional capaz de centralizar os principais processos administrativos e operacionais de uma oficina mecânica.
A oficina deverá conseguir:
Cadastrar o cliente → cadastrar o veículo → registrar o problema → realizar o diagnóstico → executar o serviço → registrar peças → atualizar o estoque → registrar o pagamento → armazenar o histórico.
O cliente, por sua vez, deverá conseguir acompanhar seus veículos através de seu próprio portal.
O sistema deverá permitir que ele compreenda:
o que foi feito, onde foi feito, qual peça foi utilizada, quando foi realizado e em qual quilometragem.
A representação visual deverá complementar essas informações por meio de um modelo 3D simples.
Quando uma manutenção estiver relacionada a um componente suportado pelo sistema, o cliente poderá visualizar uma animação curta que demonstrará:
Veículo → região do veículo → componente → peça/manutenção realizada.
Dessa forma, o histórico tradicional será transformado em uma experiência mais visual e compreensível.
O conceito central do Mecano será:

Um sistema de gestão no qual o veículo não é apenas um cadastro, mas o centro de todo o histórico de manutenção.

32. Visão de Longo Prazo

A visão de longo prazo do Mecano é evoluir a plataforma de gestão da oficina, ampliando seus recursos de gestão, comunicação, integração e análise de informações.
O sistema deverá evoluir gradualmente, ampliando seus recursos de gestão, comunicação, integração e análise de informações.
Apesar da expansão do sistema, a proposta central deverá permanecer:

Simplificar a gestão da oficina e transformar o histórico de manutenção do veículo em uma experiência organizada, acessível e visualmente compreensível para profissionais e clientes.