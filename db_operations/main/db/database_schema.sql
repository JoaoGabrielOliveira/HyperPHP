--CREATE DATABASE IF NOT EXISTS kaudb;

--USE kaudb;

CREATE TABLE IF NOT EXISTS tb_endereco (
    ID INT PRIMARY KEY, --AUTO_INCREMENT,
    logradouro_id INT NOT NULL,
    titulo TEXT NOT NULL,
    numero VARCHAR(7),
    bairro TEXT NOT NULL,
    cidade_id VARCHAR(10) NOT NULL );

CREATE TABLE IF NOT EXISTS tb_cliente (
    ID INT PRIMARY KEY AUTOINCREMENT,
    nome VARCHAR(80) NOT NULL,
    endereco_id INT NOT NULL,
    criado_em DATETIME NOT NULL,
    atualizado_em DATETIME NOT NULL );

CREATE TABLE IF NOT EXISTS tb_pedido (
    ID INT PRIMARY KEY, -- AUTO_INCREMENT,
    cliente_id INT NOT NULL,
    pedido TEXT NOT NULL,
    data_para_entrega DATETIME NOT NULL,
    criado_em DATETIME NOT NULL,
    atualizado_em DATETIME NOT NULL );