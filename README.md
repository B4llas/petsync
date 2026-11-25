<img width="1592" height="961" alt="image" src="https://github.com/user-attachments/assets/9dc16491-6c96-4eea-9631-710315d1cd62" />## PetSync · Gestão de Tutores e Pets

Aplicação web orientada a objetos em **PHP** para gerenciamento de tutores e seus animais de estimação. O sistema faz parte do ecossistema **PetSync**, construído com arquitetura **MVC**, padrão **DAO** e banco de dados **MySQL**, implementando CRUD completo em duas entidades relacionadas:

**Usuario 1 ────── N Pet**

Um tutor cadastrado (`USUARIO`) pode possuir vários animais de estimação (`PET`). Cada pet pertence a exatamente um tutor por meio da chave estrangeira `PET.id_usuario`, utilizando consulta relacional com `INNER JOIN` na listagem e integridade referencial com exclusão em cascata (`ON DELETE CASCADE`).

---

## 🎬 Vídeo de apresentação

<img width="506" height="904" alt="image" src="https://github.com/user-attachments/assets/e682b5b4-32c0-4cc5-bde5-925b50cd7ed7" />


---

## Telas

| Login e Cadastro de Tutor | Listagem de Pets (`INNER JOIN`) |
| :---: | :---: |
| <img width="482" height="908" alt="image" src="https://github.com/user-attachments/assets/94f2e35e-1858-4095-86e2-ed98cec96069" /> <img width="484" height="899" alt="image" src="https://github.com/user-attachments/assets/518d6807-e48c-448a-9924-c6f3e57f9f21" /> | <img width="495" height="908" alt="image" src="https://github.com/user-attachments/assets/8516ebb6-a77b-4e05-9a2c-ffa13f7d92c0" /> |

| Cadastro / Edição de Pet | Perfil e Exclusão em Cascata |
| :---: | :---: |
| <img width="433" height="861" alt="image" src="https://github.com/user-attachments/assets/2792a761-741c-4829-afee-afa0988d532a" /> | <img width="433" height="796" alt="image" src="https://github.com/user-attachments/assets/090fecea-826f-47eb-8e81-f68990142778" /> |

---

## Integrante

| Nome | R.A. |
| :--- | :--- |
| Marco Vinícius Balula | 9352 |

---

## Tecnologias

* **PHP 8** orientado a objetos, sem framework
* **PDO** com *prepared statements* para proteção contra SQL Injection
* **MySQL / MariaDB**, via XAMPP e MySQL Workbench
* **HTML5 e CSS3** responsivos na camada View
* Gerenciamento de sessão nativa (`$_SESSION`) e upload de imagens de pets

Não há dependências externas ou Composer para instalar.

---

## Como instalar e executar

### Com XAMPP (recomendado)

1. Instale o **XAMPP** e abra o **XAMPP Control Panel**.
2. Inicie os serviços **Apache** e **MySQL** (ou utilize o serviço local do MySQL Server na porta `3306`).
3. Copie a pasta do projeto para `C:\xampp\htdocs\petsync`. Caso baixe o ZIP do GitHub, renomeie a pasta `petsync-main` para `petsync`.
4. Acesse `http://localhost/phpmyadmin` (ou abra o **MySQL Workbench**), importe/execute o arquivo `database/petsync.sql` para criar o banco `PetSync_teste`, as tabelas `USUARIO` e `PET` e os registros iniciais.
5. Abra `http://localhost/petsync` no navegador.

Se o seu MySQL utilizar senha ou porta diferente da padrão (`3306`), ajuste as credenciais em `config/Conexao.php`.

---

## Banco de dados

Script completo disponível em `database/petsync.sql`.

```text
USUARIO                           PET
───────────────────────           ───────────────────────
id_usuario          PK ◄──────┐   id_pet              PK
nome                          └── id_usuario          FK
email               UNIQUE        nome
senha_hash                        especie
telefone                          raca
metodo_autenticacao               peso_atual
id_provedor_externo               data_nascimento
                                  foto
```

A chave estrangeira utiliza `ON DELETE CASCADE`: ao excluir um tutor na tela de perfil, todos os pets vinculados ao seu `id_usuario` são removidos automaticamente do banco de dados.

---

## Arquitetura

```text
petsync/
├── index.php                     Tela inicial / entrada de autenticação
├── config/
│   └── Conexao.php               Conexão única com o banco via PDO (Singleton)
├── model/
│   ├── Usuario.php               Entidade Usuario com atributos privados e getters/setters
│   ├── UsuarioDAO.php            Persistência e CRUD da tabela USUARIO
│   ├── Pet.php                   Entidade Pet com atributos privados e getters/setters
│   └── PetDAO.php                Persistência, CRUD e INNER JOIN da tabela PET
├── controller/
│   ├── UsuarioController.php     Regras de negócio, login, sessão e CRUD de tutores
│   └── PetController.php         Validações, upload de foto e CRUD de pets
├── view/
│   ├── meus-pets.php             Listagem principal de pets com dados do tutor
│   ├── cadastro-pet.php          Formulário de criação e edição de pets
│   └── perfil.php                Edição e exclusão do tutor logado
├── database/
│   └── petsync.sql               Script DDL e DML completo do banco MySQL
└── img/                          Diretório de armazenamento das fotos dos pets
```

---

## Como cada camada funciona

* **Model (Entidades):** `Usuario` e `Pet` encapsulam os dados do domínio com atributos privados, métodos de acesso (*getters* e *setters*) e tipagem consistente com o banco relacional.
* **Model (DAO):** Todo o SQL do sistema fica isolado em `UsuarioDAO` e `PetDAO`, utilizando `PDO` com *prepared statements* e consultas relacionais (`INNER JOIN` entre `PET` e `USUARIO`). A conexão é fornecida por `Conexao::getConexao()`.
* **Controller:** Recebe as requisições HTTP (`GET` e `POST`), controla a sessão do tutor autenticado, gerencia o upload de arquivos para `img/` e aciona os métodos do DAO.
* **View:** Camada de apresentação em PHP, HTML5 e CSS3 responsável por exibir as listas e formulários sem misturar consultas SQL.

---

## Conceitos de POO aplicados

| Conceito | Onde foi aplicado |
| :--- | :--- |
| **Encapsulamento** | Atributos `private` com métodos *getters* e *setters* em `Usuario` e `Pet` |
| **Abstração e Coesão** | Separação clara entre entidades de domínio (`Model`), persistência (`DAO`), controle (`Controller`) e interface (`View`) |
| **Associação / Relacionamento** | Vínculo `1:N` entre `Usuario` e `Pet` refletido na chave estrangeira `id_usuario` |
| **Singleton** | Classe `Conexao` garantindo uma única instância ativa de `PDO` por requisição |
| **Segurança e Persistência** | Uso de *prepared statements* (`:param`) nos DAOs para evitar injeção de SQL |

---

## CRUD

| Operação | Tutor (`Usuario`) | Pet (`Pet`) |
| :--- | :--- | :--- |
| **Create** | Cadastro de novo tutor → `UsuarioDAO::criar` | Formulário `+ Adicionar Pet` → `PetDAO::criar` |
| **Read** | Autenticação e perfil → `UsuarioDAO::buscarPorId` / `listarTodos` | Listagem com `INNER JOIN` → `PetDAO::listarTodos` / `buscarPorId` |
| **Update** | Edição de dados no perfil → `UsuarioDAO::atualizar` | Edição de dados e foto → `PetDAO::atualizar` |
| **Delete** | Exclusão de conta (`ON DELETE CASCADE`) → `UsuarioDAO::deletar` | Remoção individual do pet → `PetDAO::deletar` |

---

## Transparência de IA

Este projeto foi desenvolvido com apoio de ferramentas de inteligência artificial (**Gemini** e **Claude**) como assistentes de programação e revisão.

**Onde a IA foi utilizada:**
* Revisão e alinhamento entre as colunas do script SQL (`database/petsync.sql`) e os métodos dos arquivos `UsuarioDAO.php` e `PetDAO.php`
* Diagnóstico de erros de conexão PDO, sintaxe SQL e integridade referencial (`ON DELETE CASCADE`)
* Estruturação e formatação da documentação técnica deste `README.md`

**O que foi desenvolvido pelo aluno:**
* Concepção do projeto **PetSync** e definição dos requisitos funcionais de gestão de tutores e pets
* Implementação da arquitetura MVC/DAO em PHP, regras de negócio dos controllers e interfaces em HTML/CSS
* Configuração do ambiente local (XAMPP e MySQL Workbench), testes manuais de todas as operações CRUD e gravação do vídeo demonstrativo
