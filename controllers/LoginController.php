<?php
class LoginController
{
    private $model;

    public function __construct(Usuario $model)
    {
        $this->model = $model;
    }
public function index(): void
    {
        if (!empty($_SESSION['usuario_id'])) {
            header('Location: index.php?rota=principal');
            exit;
        }
        require __DIR__ . '/../views/login/index.php';
    }

    public function autenticar(): void
    {
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';
        if ($email === '' || $senha === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: index.php?rota=login&erro=preencha');
            exit;
        }

        $usuario = $this->model->autenticar($email, $senha);
        if (!$usuario) {
            header('Location: index.php?rota=login&erro=credenciais');
            exit;
        }

        session_regenerate_id(true);
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['login_time'] = time();
        header('Location: index.php?rota=principal');
        exit;
    }

    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        header('Location: index.php?rota=login');
        exit;
    }
}
