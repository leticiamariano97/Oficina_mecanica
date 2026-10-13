<?php
class ClienteController
{
    private $model;

    public function __construct(Cliente $model)
    {
        $this->model = $model;
    }
public function index(): void
    {
        $busca = trim($_GET['busca'] ?? '');
        $clientes = $this->model->listar($busca);
        $mensagem = $_GET['msg'] ?? '';
        require __DIR__ . '/../views/cliente/index.php';
    }

    public function salvar(): void
{
    $id = isset($_POST['id']) && $_POST['id'] !== ''
        ? (int) $_POST['id']
        : null;

    try {
        $ok = $this->model->salvar($_POST, $id);

        if ($ok) {
            $msg = 'salvo';
        } else {
            $msg = 'erro';
        }

    } catch (PDOException $e) {
        error_log('Erro no cadastro de cliente: ' . $e->getMessage());
        $msg = 'erro';
    }

    header('Location: index.php?rota=clientes&msg=' . $msg);
    exit;
}

    public function excluir(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        try {
            $ok = $id > 0 && $this->model->excluir($id);
            $msg = $ok ? 'excluido' : 'erro';
        } catch (PDOException $e) {
            $msg = 'vinculado'; // a FK impede excluir cliente que possui veículo
        }
        header('Location: index.php?rota=clientes&msg=' . $msg);
        exit;
    }
}
