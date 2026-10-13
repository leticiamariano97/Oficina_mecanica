<?php
session_start();

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/config/auth.php';
foreach (['Usuario', 'Cliente', 'Veiculo', 'OrdemServico'] as $model) {
    require_once __DIR__ . "/models/{$model}.php";
}
foreach (['LoginController', 'ClienteController', 'VeiculoController', 'OrdemServicoController'] as $controller) {
    require_once __DIR__ . "/controllers/{$controller}.php";
}

$db = (new Database())->getConnection();
$rota = $_GET['rota'] ?? 'login';
$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

switch ($rota) {
    case 'login':
        (new LoginController(new Usuario($db)))->index();
        break;
    case 'autenticar':
        if ($metodo !== 'POST') {
            header('Location: index.php?rota=login');
            exit;
        }
        (new LoginController(new Usuario($db)))->autenticar();
        break;
    case 'logout':
        exigirLogin();
        (new LoginController(new Usuario($db)))->logout();
        break;
    case 'principal':
        exigirLogin();
        require __DIR__ . '/views/principal/index.php';
        break;
    case 'clientes':
        exigirLogin();
        (new ClienteController(new Cliente($db)))->index();
        break;
    case 'cliente_salvar':
        exigirLogin();
        if ($metodo !== 'POST') { http_response_code(405); exit('Método não permitido.'); }
        (new ClienteController(new Cliente($db)))->salvar();
        break;
    case 'cliente_excluir':
        exigirLogin();
        if ($metodo !== 'POST') { http_response_code(405); exit('Método não permitido.'); }
        (new ClienteController(new Cliente($db)))->excluir();
        break;
    case 'veiculos':
        exigirLogin();
        (new VeiculoController(new Veiculo($db)))->index();
        break;
    case 'veiculo_cadastrar':
        exigirLogin();
        if ($metodo !== 'POST') { http_response_code(405); exit('Método não permitido.'); }
        (new VeiculoController(new Veiculo($db)))->cadastrar();
        break;
    case 'ordens':
        exigirLogin();
        (new OrdemServicoController(new OrdemServico($db)))->index();
        break;
    case 'ordem_cadastrar':
        exigirLogin();
        if ($metodo !== 'POST') { http_response_code(405); exit('Método não permitido.'); }
        (new OrdemServicoController(new OrdemServico($db)))->cadastrar();
        break;
    case 'ordem_data':
        exigirLogin();
        if ($metodo !== 'POST') { http_response_code(405); exit('Método não permitido.'); }
        (new OrdemServicoController(new OrdemServico($db)))->atualizarData();
        break;
    default:
        header('Location: index.php?rota=login');
        exit;
}
