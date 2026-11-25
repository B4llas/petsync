<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../model/PetDAO.php';

class PetController {
    private $dao;

    public function __construct() {
        $this->dao = new PetDAO();
    }

    private function salvarFotoUpload($arquivo, $fotoAtual = 'img/Mel.jpg') {
        if (isset($arquivo) && $arquivo['error'] === UPLOAD_ERR_OK) {
            $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
            $permitidas = ['jpg', 'jpeg', 'png', 'webp'];

            if (in_array($extensao, $permitidas)) {
                $novoNome = 'pet_' . uniqid() . '.' . $extensao;
                $destino = __DIR__ . '/../img/' . $novoNome;

                if (move_uploaded_file($arquivo['tmp_name'], $destino)) {
                    return 'img/' . $novoNome;
                }
            }
        }
        return $fotoAtual;
    }

    public function processarRequisicao() {
        $acao = $_POST['acao'] ?? $_GET['acao'] ?? '';

        try {
            // Criar Pet
            if ($acao === 'criar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $peso = !empty($_POST['peso_atual']) ? (float) str_replace(',', '.', $_POST['peso_atual']) : null;
                $idUsuario = (int) ($_POST['id_usuario'] ?? $_SESSION['id_usuario'] ?? 1);
                $foto = $this->salvarFotoUpload($_FILES['foto'] ?? null, 'img/Mel.jpg');

                $pet = new Pet(
                    trim($_POST['nome']),
                    trim($_POST['especie']),
                    trim($_POST['raca'] ?? ''),
                    !empty($_POST['data_nascimento']) ? $_POST['data_nascimento'] : null,
                    $peso,
                    $foto,
                    $idUsuario
                );
                $this->dao->criar($pet);
                header('Location: ../view/meus-pets.php?msg=Pet cadastrado!');
                exit;
            }

            // Atualizar Pet
            if ($acao === 'atualizar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $peso = !empty($_POST['peso_atual']) ? (float) str_replace(',', '.', $_POST['peso_atual']) : null;
                $idUsuario = (int) ($_POST['id_usuario'] ?? $_SESSION['id_usuario'] ?? 1);
                $fotoAtual = !empty($_POST['foto_atual']) ? trim($_POST['foto_atual']) : 'img/Mel.jpg';
                $foto = $this->salvarFotoUpload($_FILES['foto'] ?? null, $fotoAtual);

                $pet = new Pet(
                    trim($_POST['nome']),
                    trim($_POST['especie']),
                    trim($_POST['raca'] ?? ''),
                    !empty($_POST['data_nascimento']) ? $_POST['data_nascimento'] : null,
                    $peso,
                    $foto,
                    $idUsuario,
                    (int) $_POST['id_pet']
                );
                $this->dao->atualizar($pet);
                header('Location: ../view/meus-pets.php?msg=Pet atualizado!');
                exit;
            }

            // Deletar Pet
            if ($acao === 'deletar' && isset($_GET['id'])) {
                $this->dao->deletar((int) $_GET['id']);
                header('Location: ../view/meus-pets.php?msg=Pet removido!');
                exit;
            }
        } catch (PDOException $e) {
            $erro = urlencode("Erro no banco: " . $e->getMessage());
            header("Location: ../view/meus-pets.php?erro=$erro");
            exit;
        }
    }

    public function listar() {
        return $this->dao->listarTodos();
    }

    public function buscar($id) {
        return $this->dao->buscarPorId($id);
    }
}

if (basename($_SERVER['PHP_SELF']) === 'PetController.php') {
    $controller = new PetController();
    $controller->processarRequisicao();
}