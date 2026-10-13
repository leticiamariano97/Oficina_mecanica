<?php $erro = $_GET['erro'] ?? ''; ?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oficina Mecânica | Entrar</title>
    <link rel="stylesheet" href="views/layout.css">
</head>
<body>
    <div class="panel login">
        <h1>🔧 Oficina Mecânica</h1>
        <p class="muted">Sistema de gestão de clientes, veículos e ordens de serviço.</p>
        <?php if (isset($_GET['expirada'])): ?>
            <div class="notice">Sua sessão expirou. Entre novamente.</div>
        <?php endif; ?>
        <?php if ($erro): ?>
            <div class="notice">
                <?= $erro === 'preencha' ? 'Preencha e-mail e senha.' : 'E-mail ou senha inválidos.' ?>
            </div>
        <?php endif; ?>
        <form method="post" action="index.php?rota=autenticar">
            <label for="email">E-mail</label>
            <input id="email" type="email" name="email" required autocomplete="username">
            <label for="senha">Senha</label>
            <input id="senha" type="password" name="senha" required autocomplete="current-password">
            <button type="submit">Entrar</button>
        </form>
        <p class="muted">Acesso de demonstração: admin@oficina.com / Oficina@123</p>
    </div>
</body>
</html>
