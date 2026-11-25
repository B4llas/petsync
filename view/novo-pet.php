<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../controller/UsuarioController.php';

$usuarioController = new UsuarioController();
$usuarios = $usuarioController->listar();
$idLogado = $_SESSION['id_usuario'] ?? 1;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSync - Adicionar Pet</title>
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
                <h2>Adicionar Novo Pet</h2>
                <p class="subtexto">Cadastre um animalzinho vinculado a um tutor.</p>

                <form action="../controller/PetController.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="acao" value="criar">

                    <div class="campo">
                        <label>Tutor Responsável (FK)</label>
                        <select name="id_usuario" style="padding:10px; border:1px solid #cccccc; border-radius:8px; font-size:14px; background-color:#f8f9fa;" required>
                            <?php foreach ($usuarios as $u): ?>
                                <option value="<?= $u->getIdUsuario() ?>" <?= $u->getIdUsuario() === $idLogado ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($u->getNome()) ?> (<?= htmlspecialchars($u->getEmail()) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="campo">
                        <label>Foto do Pet</label>
                        <input type="file" name="foto" accept="image/*">
                    </div>

                    <div class="campo">
                        <label>Nome do Pet</label>
                        <input type="text" name="nome" placeholder="Ex: Tico" required>
                    </div>

                    <div class="campo">
                        <label>Espécie</label>
                        <input type="text" name="especie" placeholder="Ex: Cachorro, Gato, Primata" required>
                    </div>

                    <div class="campo">
                        <label>Raça</label>
                        <input type="text" name="raca" placeholder="Ex: Golden Retriever">
                    </div>

                    <div class="campo">
                        <label>Data de Nascimento</label>
                        <input type="date" name="data_nascimento">
                    </div>

                    <div class="campo">
                        <label>Peso Atual (kg)</label>
                        <input type="text" name="peso_atual" placeholder="Ex: 5.5">
                    </div>

                    <button type="submit" class="btn-laranja">Salvar Pet</button>
                    <a href="meus-pets.php" class="btn-cancelar">Cancelar</a>
                </form>
            </section>
        </main>
    </div>
</body>
</html>