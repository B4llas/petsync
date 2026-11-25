<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../controller/PetController.php';

$nomeUsuario = $_SESSION['nome_usuario'] ?? 'Marco Balula';
$petController = new PetController();
$pets = $petController->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSync - Meus Pets</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="tela-celular">
        <header class="topo-app">
            <h1 class="logo">🐾 PetSync</h1>
            <div class="perfil-topo">
                <a href="perfil.php" class="usuario-logado">
                    <span class="avatar-usuario">MB</span>
                    <span><?= htmlspecialchars($nomeUsuario) ?></span>
                </a>
                <a href="../controller/UsuarioController.php?acao=sair" class="btn-sair">Sair</a>
            </div>
        </header>

        <main class="conteudo-app">
            <div class="topo-saudacao">
                <h2 class="saudacao-usuario">Olá, <?= htmlspecialchars(explode(' ', $nomeUsuario)[0]) ?>!</h2>
                <a href="novo-pet.php" class="btn-adicionar-pet">+ Adicionar Pet</a>
            </div>

            <?php if (isset($_GET['msg'])): ?>
                <p style="color:#16a34a; font-size:12px; font-weight:bold;">
                    <?= htmlspecialchars($_GET['msg']) ?>
                </p>
            <?php endif; ?>

            <p class="subtexto-pets">Pets cadastrados no sistema (INNER JOIN com Tutor):</p>

            <?php foreach ($pets as $pet): ?>
                <div class="cartao" style="padding: 14px;">
                    <a href="painel-pet.php?id=<?= $pet->getIdPet() ?>" style="text-decoration:none; display:flex; justify-content:space-between; align-items:center;">
                        <div class="perfil-pet sem-margem">
                            <img src="../<?= htmlspecialchars($pet->getFoto() ?: 'img/Mel.jpg') ?>" alt="Foto do Pet">
                            <div>
                                <strong><?= htmlspecialchars($pet->getNome()) ?></strong>
                                <span><?= htmlspecialchars($pet->getEspecie()) ?> • <?= htmlspecialchars($pet->getRaca() ?: 'SRD') ?> • <?= $pet->getPesoAtual() ? $pet->getPesoAtual() . ' kg' : 'Sem peso' ?></span>
                                <span style="font-size:11px; color:#ff6b00;">Tutor: <?= htmlspecialchars($pet->getNomeTutor()) ?></span>
                            </div>
                        </div>
                        <span class="seta-pet">›</span>
                    </a>

                    <div style="display:flex; gap:8px; margin-top:12px; border-top:1px solid #eeeeee; padding-top:10px;">
                        <a href="editar-pet.php?id=<?= $pet->getIdPet() ?>" class="btn-editar" style="flex:1; text-align:center; text-decoration:none;">✏️ Editar</a>
                        <a href="../controller/PetController.php?acao=deletar&id=<?= $pet->getIdPet() ?>" 
                           onclick="return confirm('Deseja excluir este pet?')" 
                           class="btn-editar" style="flex:1; text-align:center; text-decoration:none; color:#dc2626; border-color:#fecaca;">🗑️ Excluir</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </main>
    </div>
</body>
</html>