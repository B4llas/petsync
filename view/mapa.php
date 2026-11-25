<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../controller/PetController.php';

$idPet = (int) ($_GET['id'] ?? 1);
$pet = (new PetController())->buscar($idPet);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSync - Mapa</title>
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

        <div class="mapa">
            <iframe 
                src="https://www.google.com/maps?q=pet+shop+Ponta+Grossa+PR&ll=-25.095,-50.161&z=12&output=embed" 
                width="100%" 
                height="260" 
                style="border:0;">
            </iframe>
        </div>

        <main class="conteudo-app">
            <section class="cartao">
                <h2>Pet Shops Próximos</h2>
                <p class="subtexto">Locais recomendados para <?= htmlspecialchars($pet ? $pet->getNome() : 'seu pet') ?>:</p>

                <div class="item-petshop">
                    <div>
                        <strong>Pet Center Campos Gerais</strong>
                        <p>Av. Vicente Machado, 500 - Ponta Grossa</p>
                    </div>
                    <span class="etiqueta-verde">4.8 ★</span>
                </div>

                <div class="item-petshop">
                    <div>
                        <strong>Clínica VetPG</strong>
                        <p>Rua Balduíno Taques, 120 - Ponta Grossa</p>
                    </div>
                    <span class="etiqueta-verde">24h</span>
                </div>
            </section>
        </main>

        <footer class="menu-inferior">
            <a href="painel-pet.php?id=<?= $idPet ?>">Início</a>
            <a href="racao.php?id=<?= $idPet ?>">Ração</a>
            <a href="saude.php?id=<?= $idPet ?>">Saúde</a>
            <a href="mapa.php?id=<?= $idPet ?>" class="aba-ativa">Mapa</a>
        </footer>
    </div>
</body>
</html>