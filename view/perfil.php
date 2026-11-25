<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../controller/UsuarioController.php';

$idUsuario = $_SESSION['id_usuario'] ?? 1;
$usuarioController = new UsuarioController();
$usuario = $usuarioController->buscar($idUsuario);
$todosUsuarios = $usuarioController->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSync - Meu Perfil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="tela-celular">
        <header class="topo-app">
            <h1 class="logo">🐾 PetSync</h1>
            <div class="perfil-topo">
                <a href="perfil.php" class="usuario-logado">
                    <span class="avatar-usuario">MB</span>
                    <span><?= htmlspecialchars($usuario ? $usuario->getNome() : 'Balula') ?></span>
                </a>
                <a href="../controller/UsuarioController.php?acao=sair" class="btn-sair">Sair</a>
            </div>
        </header>

        <main class="conteudo-app">
            <section class="cartao">
                <h2>Editar Perfil do Tutor</h2>
                <p class="subtexto">Atualize os dados da sua conta no PetSync.</p>

                <?php if (isset($_GET['msg'])): ?>
                    <p style="color:#16a34a; font-size:12px; margin-bottom:10px; font-weight:bold;">
                        <?= htmlspecialchars($_GET['msg']) ?>
                    </p>
                <?php endif; ?>

                <?php if ($usuario): ?>
                <form action="../controller/UsuarioController.php" method="POST">
                    <input type="hidden" name="acao" value="atualizar">
                    <input type="hidden" name="id_usuario" value="<?= $usuario->getIdUsuario() ?>">

                    <div class="campo">
                        <label>Nome Completo</label>
                        <input type="text" name="nome" value="<?= htmlspecialchars($usuario->getNome()) ?>" required>
                    </div>

                    <div class="campo">
                        <label>E-mail</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($usuario->getEmail()) ?>" required>
                    </div>

                    <div class="campo">
                        <label>Telefone</label>
                        <input type="text" name="telefone" value="<?= htmlspecialchars($usuario->getTelefone() ?? '') ?>">
                    </div>

                    <button type="submit" class="btn-laranja">Salvar Alterações</button>
                </form>

                <a href="meus-pets.php" class="btn-cancelar">Voltar para Meus Pets</a>
                <a href="../controller/UsuarioController.php?acao=deletar&id=<?= $usuario->getIdUsuario() ?>" 
                   onclick="return confirm('Tem certeza? Isso excluirá sua conta e todos os seus pets (ON DELETE CASCADE).')" 
                   class="btn-sair-conta">Excluir Minha Conta</a>
                <?php endif; ?>
            </section>

            <section class="cartao">
                <h2>Tutores Cadastrados (Banco)</h2>
                <div class="lista-resumo">
                    <?php foreach ($todosUsuarios as $u): ?>
                        <div class="item-resumo">
                            <span><?= htmlspecialchars($u->getNome()) ?></span>
                            <strong><?= htmlspecialchars($u->getEmail()) ?></strong>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </main>
    </div>
</body>
</html>