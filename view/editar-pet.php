<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../controller/PetController.php';
require_once __DIR__ . '/../controller/UsuarioController.php';

$idPet = (int) ($_GET['id'] ?? 0);
$petController = new PetController();
$usuarioController = new UsuarioController();

$pet = $petController->buscar($idPet);
$usuarios = $usuarioController->listar();

if (!$pet) {
    header('Location: meus-pets.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSync - Editar Pet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="tela-celular">
        <header class="topo-app">
            <h1 class="logo">🐾 PetSync</h1>
            <div class="perfil-topo">
                <a href="perfil.php" class="usuario-logado">
                    <span class="avatar-usuario">MB</span>
                    <span><?= htmlspecialchars($_SESSION['nome_usuario'] ?? 'Balula') ?></span>
                </a>
                <a href="../controller/UsuarioController.php?acao=sair" class="btn-sair">Sair</a>
            </div>
        </header>

        <main class="conteudo-app">
            <section class="cartao">
                <h2>Editar Pet: <?= htmlspecialchars($pet->getNome()) ?></h2>
                <p class="subtexto">Altere os dados ou transfira o tutor do pet.</p>

                <form action="../controller/PetController.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="acao" value="atualizar">
                    <input type="hidden" name="id_pet" value="<?= $pet->getIdPet() ?>">
                    <input type="hidden" name="foto_atual" value="<?= htmlspecialchars($pet->getFoto() ?? 'img/Mel.jpg') ?>">

                    <div class="campo">
                        <label>Tutor Responsável (FK)</label>
                        <select name="id_usuario" style="padding:10px; border:1px solid #cccccc; border-radius:8px; font-size:14px; background-color:#f8f9fa;" required>
                            <?php foreach ($usuarios as $u): ?>
                                <option value="<?= $u->getIdUsuario() ?>" <?= $u->getIdUsuario() === $pet->getIdUsuario() ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($u->getNome()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="campo">
                        <label>Alterar Foto do Pet (Opcional)</label>
                        <input type="file" name="foto" accept="image/*">
                    </div>

                    <div class="campo">
                        <label>Nome do Pet</label>
                        <input type="text" name="nome" value="<?= htmlspecialchars($pet->getNome()) ?>" required>
                    </div>

                    <div class="campo">
                        <label>Espécie</label>
                        <input type="text" name="especie" value="<?= htmlspecialchars($pet->getEspecie()) ?>" required>
                    </div>

                    <div class="campo">
                        <label>Raça</label>
                        <input type="text" name="raca" value="<?= htmlspecialchars($pet->getRaca() ?? '') ?>">
                    </div>

                    <div class="campo">
                        <label>Data de Nascimento</label>
                        <input type="date" name="data_nascimento" value="<?= htmlspecialchars($pet->getDataNascimento() ?? '') ?>">
                    </div>

                    <div class="campo">
                        <label>Peso Atual (kg)</label>
                        <input type="text" name="peso_atual" value="<?= htmlspecialchars((string) ($pet->getPesoAtual() ?? '')) ?>">
                    </div>

                    <button type="submit" class="btn-laranja">Atualizar Pet</button>
                    <a href="meus-pets.php" class="btn-cancelar">Cancelar</a>
                </form>
            </section>
        </main>
    </div>
</body>
</html>