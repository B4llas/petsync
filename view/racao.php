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
    <title>PetSync - Ração</title>
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
                    <h2>Dispenser — <?= htmlspecialchars($pet ? $pet->getNome() : 'Pet') ?></h2>
                    <button type="button" class="btn-editar">Editar</button>
                </div>

                <div class="box-racao">
                    <div class="texto-racao">
                        <span>Nível de Ração</span>
                        <strong>78%</strong>
                    </div>
                    <div class="barra-fundo">
                        <div class="barra-preenchida" style="width: 78%;"></div>
                    </div>
                </div>

                <h4>Horários Programados</h4>
                <ul class="lista-horarios">
                    <li>
                        <div>
                            <div class="hora-status">
                                <strong>08:00</strong>
                                <span class="etiqueta-verde">Ativo</span>
                            </div>
                            <span>Porção: 100g • Ração Seca</span>
                        </div>
                        <div class="chave-switch ligada">
                            <span class="bolinha"></span>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div class="hora-status">
                                <strong>19:00</strong>
                                <span class="etiqueta-verde">Ativo</span>
                            </div>
                            <span>Porção: 100g • Ração Seca</span>
                        </div>
                        <div class="chave-switch ligada">
                            <span class="bolinha"></span>
                        </div>
                    </li>
                </ul>
            </section>
        </main>

        <footer class="menu-inferior">
            <a href="painel-pet.php?id=<?= $idPet ?>">Início</a>
            <a href="racao.php?id=<?= $idPet ?>" class="aba-ativa">Ração</a>
            <a href="saude.php?id=<?= $idPet ?>">Saúde</a>
            <a href="mapa.php?id=<?= $idPet ?>">Mapa</a>
        </footer>
    </div>
</body>
</html>