<?php
class Usuario
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
public function autenticar(string $email, string $senha): ?array
    {
        $sql = 'SELECT id, nome, email, senha FROM usuarios WHERE email = :email LIMIT 1';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch();

        if (!$usuario || !password_verify($senha, $usuario['senha'])) {
            return null;
        }

        unset($usuario['senha']);
        return $usuario;
    }
}
