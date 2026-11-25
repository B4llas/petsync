<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../model/UsuarioDAO.php';
require_once __DIR__ . '/../model/PetDAO.php';

class UsuarioController {
    private $dao;

    public function __construct() {
        $this->dao = new UsuarioDAO();
    }

    public function processarRequisicao() {
        $acao = $_POST['acao'] ?? $_GET['acao'] ?? '';

        try {
            // Login
            if ($acao === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = trim($_POST['email'] ?? '');
                $usuarios = $this->dao->listarTodos();

                foreach ($usuarios as $u) {
                    if (strtolower($u->getEmail()) === strtolower($email)) {
                        $_SESSION['id_usuario'] = $u->getIdUsuario();
                        $_SESSION['nome_usuario'] = $u->getNome();
                        header('Location: ../view/meus-pets.php');
                        exit;
                    }
                }
                header('Location: ../view/index.php?erro=E-mail não encontrado');
                exit;
            }

            // Criar Usuário (e o 1º pet se preenchido no cadastro)
            if ($acao === 'criar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $senhaHash = password_hash($_POST['senha'] ?? '123456', PASSWORD_DEFAULT);
                $usuario = new Usuario(
                    trim($_POST['nome']),
                    trim($_POST['email']),
                    $senhaHash,
                    trim($_POST['telefone'] ?? '')
                );
                $this->dao->criar($usuario);

                $todos = $this->dao->listarTodos();
                $novoUsuario = $todos[0];
                $_SESSION['id_usuario'] = $novoUsuario->getIdUsuario();
                $_SESSION['nome_usuario'] = $novoUsuario->getNome();

                if (!empty(trim($_POST['nome_pet'] ?? ''))) {
                    $petDao = new PetDAO();
                    $pet = new Pet(
                        trim($_POST['nome_pet']),
                        trim($_POST['especie_pet'] ?? 'Cachorro'),
                        null,
                        null,
                        null,
                        'img/Mel.jpg',
                        $novoUsuario->getIdUsuario()
                    );
                    $petDao->criar($pet);
                }

                header('Location: ../view/meus-pets.php?msg=Conta criada com sucesso!');
                exit;
            }

            // Atualizar Usuário
            if ($acao === 'atualizar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = (int) $_POST['id_usuario'];
                $usuario = new Usuario(
                    trim($_POST['nome']),
                    trim($_POST['email']),
                    '',
                    trim($_POST['telefone'] ?? ''),
                    'local',
                    null,
                    $id
                );
                $this->dao->atualizar($usuario);
                $_SESSION['nome_usuario'] = $usuario->getNome();
                header('Location: ../view/perfil.php?msg=Perfil atualizado!');
                exit;
            }

            // Deletar Usuário
            if ($acao === 'deletar' && isset($_GET['id'])) {
                $this->dao->deletar((int) $_GET['id']);
                session_destroy();
                header('Location: ../view/index.php?msg=Conta excluída com sucesso');
                exit;
            }

            // Sair
            if ($acao === 'sair') {
                session_destroy();
                header('Location: ../view/index.php');
                exit;
            }
        } catch (PDOException $e) {
            $erro = urlencode("Erro no banco: " . $e->getMessage());
            header("Location: ../view/perfil.php?erro=$erro");
            exit;
        }
    }

    public function buscar($id) {
        return $this->dao->buscarPorId($id);
    }

    public function listar() {
        return $this->dao->listarTodos();
    }
}

if (basename($_SERVER['PHP_SELF']) === 'UsuarioController.php') {
    $controller = new UsuarioController();
    $controller->processarRequisicao();
}