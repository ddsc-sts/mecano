SET NAMES utf8mb4;

CREATE TABLE orcamentos (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  veiculo_id BIGINT UNSIGNED NOT NULL,
  status ENUM('rascunho','enviado','aprovado','recusado','expirado','convertido') NOT NULL DEFAULT 'rascunho',
  versao_atual INT UNSIGNED NOT NULL DEFAULT 1,
  validade DATE NULL,
  total DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at TIMESTAMP NULL,
  FOREIGN KEY (veiculo_id) REFERENCES veiculos(id)
) ENGINE=InnoDB;

CREATE TABLE orcamento_versoes (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  orcamento_id BIGINT UNSIGNED NOT NULL,
  versao INT UNSIGNED NOT NULL,
  itens JSON NOT NULL,
  total DECIMAL(12,2) NOT NULL,
  hash CHAR(64) NOT NULL,                     -- sha256 do conteúdo
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_orc_versao (orcamento_id, versao),
  FOREIGN KEY (orcamento_id) REFERENCES orcamentos(id)
) ENGINE=InnoDB;

CREATE TABLE orcamento_aprovacoes (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  orcamento_id BIGINT UNSIGNED NOT NULL,
  versao INT UNSIGNED NOT NULL,
  hash_versao CHAR(64) NOT NULL,
  decisao ENUM('aprovado','recusado') NOT NULL,
  usuario_id BIGINT UNSIGNED NULL,
  ip VARCHAR(45) NULL,
  user_agent VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (orcamento_id) REFERENCES orcamentos(id)
) ENGINE=InnoDB;
