
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL);

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    cpf_hash CHAR(64) NOT NULL UNIQUE,
    telefone VARCHAR(30),
    email VARCHAR(150),
    endereco VARCHAR(255));

CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    cpf_hash CHAR(64) NOT NULL UNIQUE,
    telefone VARCHAR(30),
    salario DECIMAL(10,2),
    cargo VARCHAR(80) NOT NULL
    );

CREATE TABLE veiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    placa VARCHAR(8) NOT NULL UNIQUE,
    marca VARCHAR(60) NOT NULL,
    modelo VARCHAR(80) NOT NULL,
    ano SMALLINT NOT NULL,
    cor VARCHAR(40),
    CONSTRAINT fk_veiculo_cliente FOREIGN KEY(cliente_id) 
    REFERENCES clientes(id) ON UPDATE CASCADE ON DELETE RESTRICT);

CREATE TABLE ordens_servico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    veiculo_id INT NOT NULL,
    data_abertura DATE NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL DEFAULT 0,
    status ENUM('Aberta','Em andamento','Aguardando peças','Concluída','Cancelada') NOT NULL DEFAULT 'Aberta',
    CONSTRAINT fk_os_veiculo FOREIGN KEY(veiculo_id) 
    REFERENCES veiculos(id) ON UPDATE CASCADE ON DELETE RESTRICT);

INSERT IGNORE INTO usuarios(nome,email,senha) VALUES
('Administrador','admin@oficina.com','$2y$12$e5bWH3gUCg6M3sexrl6M0e/60r6GXfAbWvYpPfFopM9KnRHc7FKGu'),
('Marcos Silva','marcos@oficina.com','$2y$12$e5bWH3gUCg6M3sexrl6M0e/60r6GXfAbWvYpPfFopM9KnRHc7FKGu'),
('Juliana Costa','juliana@oficina.com','$2y$12$e5bWH3gUCg6M3sexrl6M0e/60r6GXfAbWvYpPfFopM9KnRHc7FKGu');

INSERT IGNORE INTO clientes(nome,cpf_hash,telefone,email,endereco) VALUES
('Ana Souza',SHA2('11111111111',256),'(49) 99999-1111','ana@email.com','Centro'),('Carlos Lima',SHA2('22222222222',256),'(49) 99999-2222','carlos@email.com','Efapi'),('Mariana Alves',SHA2('33333333333',256),'(49) 99999-3333','mariana@email.com','Palmital');
INSERT IGNORE INTO veiculos(cliente_id,placa,marca,modelo,ano,cor) VALUES (1,'ABC1D23','Honda','Civic',2019,'Azul'),(2,'DEF2G34','Fiat','Argo',2022,'Branco'),(3,'HIJ3K45','Chevrolet','Onix',2021,'Prata');
INSERT INTO ordens_servico(veiculo_id,data_abertura,descricao,valor,status) SELECT 1,'2026-10-08','Troca de óleo e filtros',350.00,'Aberta' WHERE NOT EXISTS(SELECT 1 FROM ordens_servico WHERE veiculo_id=1 AND descricao='Troca de óleo e filtros');
INSERT INTO ordens_servico(veiculo_id,data_abertura,descricao,valor,status) SELECT 2,'2026-10-09','Revisão dos freios',620.00,'Em andamento' WHERE NOT EXISTS(SELECT 1 FROM ordens_servico WHERE veiculo_id=2 AND descricao='Revisão dos freios');
INSERT INTO ordens_servico(veiculo_id,data_abertura,descricao,valor,status) SELECT 3,'2026-10-10','Diagnóstico de injeção eletrônica',180.00,'Aberta' WHERE NOT EXISTS(SELECT 1 FROM ordens_servico WHERE veiculo_id=3 AND descricao='Diagnóstico de injeção eletrônica');
