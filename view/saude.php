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
    <title>PetSync - Saúde</title>
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
                <div class="titulo-linha">
                    <div class="hora-status">
                        <h2>Saúde — <?= htmlspecialchars($pet ? $pet->getNome() : 'Pet') ?></h2>
                        <span class="etiqueta-verde">Em dia</span>
                    </div>
                </div>

                <p class="subtexto">Peso registrado no banco: <strong><?= $pet && $pet->getPesoAtual() ? $pet->getPesoAtual() . ' kg' : 'Não informado' ?></strong></p>

                <table class="tabela-vacinas">
                    <thead>
                        <tr>
                            <th>Vacina</th>
                            <th>Data</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>V10 Polivalente</td>
                            <td>12/05/2026</td>
                            <td>Aplicada</td>
                        </tr>
                        <tr>
                            <td>Antirrábica</td>
                            <td>20/11/2026</td>
                            <td>Agendada</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>

        <footer class="menu-inferior">
            <a href="painel-pet.php?id=<?= $idPet ?>">Início</a>
            <a href="racao.php?id=<?= $idPet ?>">Ração</a>
            <a href="saude.php?id=<?= $idPet ?>" class="aba-ativa">Saúde</a>
            <a href="mapa.php?id=<?= $idPet ?>">Mapa</a>
        </footer>
    </div>
</body>
</html>