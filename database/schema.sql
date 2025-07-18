CREATE DATABASE IF NOT EXISTS desafio_revvo;
USE desafio_revvo;

CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    imagem VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    duracao VARCHAR(50) NOT NULL,
    id_categoria INT NOT NULL,
    status ENUM('ativo','inativo') DEFAULT 'ativo',
    link VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id)
);

CREATE TABLE IF NOT EXISTS slideshow (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    imagem VARCHAR(255) NOT NULL,
    link_botao VARCHAR(255),
    texto_botao VARCHAR(100),
    ordem INT DEFAULT 0,
    status ENUM('ativo','inativo') DEFAULT 'ativo'
);

CREATE TABLE IF NOT EXISTS logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NULL,
    acao VARCHAR(255) NOT NULL,
    detalhes TEXT,
    ip VARCHAR(45) NULL,
    data_hora DATETIME DEFAULT CURRENT_TIMESTAMP
);