<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../controller/PetController.php';

$idPet = (int) ($_GET['id'] ?? 1);
$petController = new PetController();
$pet = $petController->buscar($idPet);

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
    <title>PetSync - <?= htmlspecialchars($pet->getNome()) ?></title>
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
            <div class="topo-saudacao">
                <h2 class="saudacao-usuario">Painel do Pet</h2>
                <a href="meus-pets.php" class="btn-alterar-pet">⇄ Alterar Pet</a>
            </div>

            <section class="cartao">
                <div class="perfil-pet">
                    <img src="../<?= htmlspecialchars($pet->getFoto() ?: 'img/Mel.jpg') ?>" alt="Foto do Pet">
                    <div>
                        <strong>Pet: <?= htmlspecialchars($pet->getNome()) ?></strong>
                        <span><?= htmlspecialchars($pet->getEspecie()) ?> • <?= htmlspecialchars($pet->getRaca() ?: 'SRD') ?></span>
                    </div>
                </div>

                <div class="lista-resumo">
                    <div class="item-resumo">
                        <span>Tutor Responsável</span>
                        <strong><?= htmlspecialchars($pet->getNomeTutor()) ?></strong>
                    </div>
                    <div class="item-resumo">
                        <span>Status das Vacinas</span>
                        <strong class="texto-verde">Em dia</strong>
                    </div>
                    <div class="item-resumo">
                        <span>Peso Atual</span>
                        <strong><?= $pet->getPesoAtual() ? $pet->getPesoAtual() . ' kg' : 'Não informado' ?></strong>
                    </div>
                </div>
            </section>

            <section class="cartao">
                <h2>Atalhos Rápidos</h2>
                <a href="racao.php?id=<?= $pet->getIdPet() ?>" class="btn-laranja">🥣 Liberar Ração Agora</a>
                <a href="mapa.php?id=<?= $pet->getIdPet() ?>" class="btn-escuro">📍 Ver Pet Shops Próximos</a>
            </section>
        </main>

        <footer class="menu-inferior">
            <a href="painel-pet.php?id=<?= $pet->getIdPet() ?>" class="aba-ativa">Início</a>
            <a href="racao.php?id=<?= $pet->getIdPet() ?>">Ração</a>
            <a href="saude.php?id=<?= $pet->getIdPet() ?>">Saúde</a>
            <a href="mapa.php?id=<?= $pet->getIdPet() ?>">Mapa</a>
        </footer>
    </div>
</body>
</html>