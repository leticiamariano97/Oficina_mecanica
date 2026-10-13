<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clientes | Oficina</title>
    <link rel="stylesheet" href="views/layout.css">
</head>
<body>
    <header class="top">
        <strong>🔧 Oficina Mecânica / Clientes</strong>
        <nav><a href="index.php?rota=principal">Painel</a><a href="index.php?rota=logout">Sair</a></nav>
    </header>
    <main class="wrap">
        <h1>Clientes</h1>
        <?php if ($mensagem): ?>
            <div class="notice">
                <?= [
                    'salvo' => 'Cadastrado com sucesso.',
                    'erro' => 'Não foi possível salvar. Confira os dados e o CPF (11 dígitos) para novo cliente.',
                    'excluido' => 'Cliente excluído.',
                    'vinculado' => 'Não é possível excluir: o cliente possui veículo vinculado.',
                ][$mensagem] ?? 'Operação concluída.' ?>
            </div>
        <?php endif; ?>

        <section class="panel">
            <h2>Cadastrar cliente</h2>
            <form method="post" action="index.php?rota=cliente_salvar">
                <div class="gridform">
                    <div><label for="nome">Nome *</label><input id="nome" name="nome" required maxlength="120"></div>
                    <div><label for="cpf">CPF (11 dígitos) *</label><input id="cpf" name="cpf" inputmode="numeric" pattern="[0-9.\-]{11,14}" required></div>
                    <div><label for="telefone">Telefone</label><input id="telefone" name="telefone" maxlength="30"></div>
                    <div><label for="email">E-mail</label><input id="email" type="email" name="email" maxlength="150"></div>
                    <div><label for="endereco">Endereço</label><input id="endereco" name="endereco" maxlength="255"></div>
                </div>
                <button type="submit">Salvar cliente</button>
            </form>
        </section>

        <section class="panel">
            <h2>Pesquisar clientes</h2>
            <form method="get" action="index.php">
                <input type="hidden" name="rota" value="clientes">
                <div class="gridform">
                    <div><label for="busca">Nome, telefone ou e-mail</label><input id="busca" name="busca" value="<?= h($busca) ?>" placeholder="Digite um termo..."></div>
                </div>
                <button type="submit">Buscar</button>
                <a class="btn secondary" href="index.php?rota=clientes">Limpar</a>
            </form>
            <div class="overflow">
                <table>
                    <thead><tr><th>Nome</th><th>Telefone</th><th>E-mail</th><th>Endereço</th><th>Editar</th><th>Excluir</th></tr></thead>
                    <tbody>
                        <?php foreach ($clientes as $c): ?>
                            <tr>
                                <td><?= h($c['nome']) ?></td>
                                <td><?= h($c['telefone']) ?></td>
                                <td><?= h($c['email']) ?></td>
                                <td><?= h($c['endereco']) ?></td>
                                <td>
                                    <details>
                                        <summary>Editar</summary>
                                        <form method="post" action="index.php?rota=cliente_salvar">
                                            <input type="hidden" name="id" value="<?= h($c['id']) ?>">
                                            <label>Nome</label><input name="nome" value="<?= h($c['nome']) ?>" required maxlength="120">
                                            <label>Novo CPF (opcional)</label><input name="cpf" placeholder="Em branco mantém o atual">
                                            <label>Telefone</label><input name="telefone" value="<?= h($c['telefone']) ?>" maxlength="30">
                                            <label>E-mail</label><input type="email" name="email" value="<?= h($c['email']) ?>" maxlength="150">
                                            <label>Endereço</label><input name="endereco" value="<?= h($c['endereco']) ?>" maxlength="255">
                                            <button type="submit">Atualizar</button>
                                        </form>
                                    </details>
                                </td>
                                <td>
                                    <form method="post" action="index.php?rota=cliente_excluir" onsubmit="return confirm('Excluir este cliente?')">
                                        <input type="hidden" name="id" value="<?= h($c['id']) ?>">
                                        <button class="danger" type="submit">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (!$clientes): ?><tr><td colspan="6">Nenhum cliente encontrado.</td></tr><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
