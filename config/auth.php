<?php
//Redireciona os usuários não autenticados e encerra sessões expiradas. 
function exigirLogin(): void
{
    if (empty($_SESSION['usuario_id'])) {
        header('Location: index.php?rota=login');
        exit;
    }

    $limite = 1800; // 30 minutos de inatividade
    if (isset($_SESSION['login_time']) && time() - (int) $_SESSION['login_time'] > $limite) {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php?rota=login&expirada=1');
        exit;
    }

    $_SESSION['login_time'] = time();
}

function h(mixed $valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
