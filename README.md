# 🐾 PetSync — Sistema de Gerenciamento de Tutores e Pets

Aplicação web desenvolvida em **PHP Orientado a Objetos** aplicando os padrões arquiteturais **MVC (Model-View-Controller)** e **DAO (Data Access Object)** com persistência relacional em **MySQL (PDO)**.

## Autor
* **Marco Vinícius Balula** — R.A.: 9352

## Tecnologias Utilizadas
* **Backend:** PHP 8+ (POO, PDO, Prepared Statements)
* **Banco de Dados:** MySQL / MariaDB (InnoDB, Foreign Keys com `ON DELETE CASCADE` e Triggers)
* **Frontend:** HTML5, CSS3 (Interface responsiva mobile-first)
* **Ambiente Local:** XAMPP (Apache + MySQL)

## Estrutura de Pastas (MVC + DAO)
* `config/` — Conexão Singleton com o banco via PDO (`Conexao.php`).
* `model/` — Entidades de domínio (`Usuario.php`, `Pet.php`) e classes de acesso a dados (`UsuarioDAO.php`, `PetDAO.php`).
* `controller/` — Regras de negócio, sessão e tratamento de formulários (`UsuarioController.php`, `PetController.php`).
* `view/` — Telas da aplicação e estilização (`index.php`, `meus-pets.php`, `novo-pet.php`, `editar-pet.php`, `perfil.php`, `style.css`).
* `database/` — Script SQL completo (`petsync.sql`) com criação das tabelas, chaves estrangeiras e dados iniciais.
* `img/` — Imagens e uploads dos pets.

## Instruções de Execução
1. Inicie os serviços **Apache** e **MySQL** no painel do **XAMPP**.
2. Coloque a pasta `petsync` dentro de `C:\xampp\htdocs\`.
3. Acesse `http://localhost/phpmyadmin`, crie o banco `PetSync_teste` e execute o script `database/petsync.sql`.
4. Abra `http://localhost/petsync/view/index.php` e entre com `marco@petsync.com`.

## Transparência no Uso de Inteligência Artificial
* **Desenvolvimento pelo autor:** Levantamento de requisitos, modelagem relacional das tabelas (`USUARIO` e `PET`), regras de negócio (`ON DELETE CASCADE`), prototipação das telas mobile e testes de integração.
* **Apoio de IA (Google Gemini):** Refatoração da estrutura orientada a objetos para aderência estrita aos padrões MVC e DAO, implementação de *Prepared Statements* no PDO e organização da documentação técnica.