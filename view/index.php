<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSync - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="tela-celular">
        <header class="topo-app">
            <h1 class="logo">🐾 PetSync</h1>
        </header>

        <main class="conteudo-app">
            <section class="cartao">
                <h2>Entrar no Aplicativo</h2>
                <p class="subtexto">Acesse sua conta para cuidar do seu pet.</p>

                <?php if (isset($_GET['erro'])): ?>
                    <p style="color:#dc2626; font-size:12px; margin-bottom:10px; font-weight:bold;">
                        <?= htmlspecialchars($_GET['erro']) ?>
                    </p>
                <?php endif; ?>
                <?php if (isset($_GET['msg'])): ?>
                    <p style="color:#16a34a; font-size:12px; margin-bottom:10px; font-weight:bold;">
                        <?= htmlspecialchars($_GET['msg']) ?>
                    </p>
                <?php endif; ?>

                <form action="../controller/UsuarioController.php" method="POST">
                    <input type="hidden" name="acao" value="login">

                    <div class="campo">
                        <label>E-mail do Tutor</label>
                        <input type="email" name="email" value="marco@petsync.com" placeholder="tutor@email.com" required>
                    </div>

                    <div class="campo">
                        <label>Senha</label>
                        <input type="password" name="senha" value="123456" placeholder="Digite sua senha" required>
                    </div>

                    <button type="submit" class="btn-laranja">Entrar</button>
                </form>

                <p class="link-alternar">
                    Ainda não tem conta? <a href="cadastro.php">Cadastre-se</a>
                </p>
            </section>
        </main>
    </div>
</body>
</html>