<?php
class VeiculoController
{
    private $model;

    public function __construct(Veiculo $model)
    {
        $this->model = $model;
    }
public function index(): void
    {
        $veiculos = $this->model->listar();
        $clientes = $this->model->clientes();
        $msg = $_GET['msg'] ?? '';
        require __DIR__ . '/../views/veiculo/index.php';
    }

    public function cadastrar(): void
    {
        try {
            $ok = $this->model->cadastrar($_POST);
            $msg = $ok ? 'salvo' : 'erro';
        } catch (PDOException $e) {
            $msg = 'erro'; //placa duplicada ou cliente inexistente
        }
        header('Location: index.php?rota=veiculos&msg=' . $msg);
        exit;
    }
}
