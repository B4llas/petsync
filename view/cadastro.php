<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSync - Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="tela-celular">
        <header class="topo-app">
            <h1 class="logo">🐾 PetSync</h1>
        </header>

        <main class="conteudo-app">
            <section class="cartao">
                <h2>Criar Nova Conta</h2>
                <p class="subtexto">Preencha seus dados e os do seu pet para começar.</p>

                <form action="../controller/UsuarioController.php" method="POST">
                    <input type="hidden" name="acao" value="criar">

                    <div class="campo">
                        <label>Nome Completo</label>
                        <input type="text" name="nome" placeholder="Ex: Marco Vinícius" required>
                    </div>

                    <div class="campo">
                        <label>E-mail</label>
                        <input type="email" name="email" placeholder="seuemail@exemplo.com" required>
                    </div>

                    <div class="campo">
                        <label>Telefone</label>
                        <input type="text" name="telefone" placeholder="Ex: 42999990001">
                    </div>

                    <div class="campo">
                        <label>Nome do 1º Pet (Opcional)</label>
                        <input type="text" name="nome_pet" placeholder="Ex: Mel">
                    </div>

                    <div class="campo">
                        <label>Espécie do Pet</label>
                        <input type="text" name="especie_pet" placeholder="Ex: Cachorro">
                    </div>

                    <div class="campo">
                        <label>Criar Senha</label>
                        <input type="password" name="senha" placeholder="Mínimo 6 caracteres" required>
                    </div>

                    <button type="submit" class="btn-escuro">Criar Conta</button>
                </form>

                <p class="link-alternar">
                    Já possui conta? <a href="index.php">Entrar</a>
                </p>
            </section>
        </main>
    </div>
</body>
</html>