<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Veículos | Oficina</title>
    <link rel="stylesheet" href="views/layout.css">
</head>
<body>
    <header class="top">
        <strong>🔧 Oficina Mecânica / Veículos</strong>
        <nav><a href="index.php?rota=principal">Painel</a><a href="index.php?rota=logout">Sair</a></nav>
    </header>
    <main class="wrap">
        <h1>Veículos</h1>
        <?php if ($msg): ?>
            <div class="notice">
                <?= $msg === 'salvo' ? 'Veículo cadastrado.' : 'Não foi possível cadastrar. Confira os campos e se a placa já existe.' ?>
            </div>
        <?php endif; ?>
        <section class="panel">
            <h2>Novo veículo</h2>
            <?php if (!$clientes): ?>
                <p>Cadastre um cliente antes de incluir um veículo.</p>
            <?php else: ?>
                <form method="post" action="index.php?rota=veiculo_cadastrar">
                    <div class="gridform">
                        <div>
                            <label for="cliente_id">Cliente proprietário *</label>
                            <select id="cliente_id" name="cliente_id" required>
                                <option value="">Selecione</option>
                                <?php foreach ($clientes as $c): ?>
                                    <option value="<?= h($c['id']) ?>"><?= h($c['nome']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div><label for="placa">Placa *</label><input id="placa" name="placa" required maxlength="8" placeholder="ABC1D23"></div>
                        <div><label for="marca">Marca *</label><input id="marca" name="marca" required></div>
                        <div><label for="modelo">Modelo *</label><input id="modelo" name="modelo" required></div>
                        <div><label for="ano">Ano *</label><input id="ano" type="number" name="ano" min="1900" max="<?= (int) date('Y') + 1 ?>" required></div>
                        <div><label for="cor">Cor</label><input id="cor" name="cor"></div>
                    </div>
                    <button type="submit">Cadastrar veículo</button>
                </form>
            <?php endif; ?>
        </section>
        <section class="panel">
            <h2>Veículos cadastrados</h2>
            <div class="overflow">
                <table>
                    <thead><tr><th>Placa</th><th>Marca/modelo</th><th>Ano</th><th>Cor</th><th>Cliente</th></tr></thead>
                    <tbody>
                        <?php foreach ($veiculos as $v): ?>
                            <tr>
                                <td><?= h($v['placa']) ?></td>
                                <td><?= h($v['marca'] . ' ' . $v['modelo']) ?></td>
                                <td><?= h($v['ano']) ?></td>
                                <td><?= h($v['cor']) ?></td>
                                <td><?= h($v['cliente_nome']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (!$veiculos): ?><tr><td colspan="5">Nenhum veículo cadastrado.</td></tr><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
