<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel | Oficina</title>
    <link rel="stylesheet" href="views/layout.css">
</head>
<body>
    <header class="top">
        <strong>🔧 Oficina Mecânica</strong>
        <nav>
            <span>Olá, <?= h($_SESSION['usuario_nome'] ?? 'Usuário') ?></span>
            <a href="index.php?rota=logout">Sair</a>
        </nav>
    </header>
    <main class="wrap">
        <h1>Painel principal</h1>
        <p>Selecione uma área para continuar.</p>
        <div class="cards">
            <a class="card" href="index.php?rota=clientes">
                <h2>👥 Clientes</h2>
                <p>Cadastro, pesquisa, edição e exclusão.</p>
            </a>
            <a class="card" href="index.php?rota=veiculos">
                <h2>🚗 Veículos</h2>
                <p>Cadastre veículos associados a clientes.</p>
            </a>
            <a class="card" href="index.php?rota=ordens">
                <h2>🧰 Ordens de serviço</h2>
                <p>Consulte serviços, clientes e veículos.</p>
            </a>
        </div>
    </main>
</body>
</html>
