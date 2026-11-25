DROP DATABASE IF EXISTS PetSync_teste;
CREATE DATABASE PetSync_teste DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE PetSync_teste;

CREATE TABLE USUARIO (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NULL,
    telefone VARCHAR(20) NULL,
    metodo_autenticacao VARCHAR(50) DEFAULT 'local',
    id_provedor_externo VARCHAR(255) NULL
) ENGINE=InnoDB;

CREATE TABLE PET (
    id_pet INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especie VARCHAR(50) NOT NULL,
    raca VARCHAR(50) NULL,
    peso_atual DECIMAL(5,2) NULL,
    data_nascimento DATE NULL,
    foto VARCHAR(255) NULL,
    id_usuario INT NOT NULL,
    CONSTRAINT fk_pet_usuario FOREIGN KEY (id_usuario) REFERENCES USUARIO(id_usuario) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO USUARIO (nome, email, senha_hash, telefone, metodo_autenticacao, id_provedor_externo) VALUES
('Marco Balula', 'marco@petsync.com', '123456', '(42) 99999-0001', 'local', NULL),
('Glazi Souza', 'glazi@petsync.com', '123456', '(42) 99999-0002', 'local', NULL);

INSERT INTO PET (nome, especie, raca, peso_atual, data_nascimento, foto, id_usuario) VALUES
('Mel', 'Cachorro', 'Shih-tzu', 5.00, '2022-05-10', 'mel.jpg', 1),
('Tico', 'Primata', 'Macaco-prego', 2.90, '2021-08-15', 'tico.jpg', 2);