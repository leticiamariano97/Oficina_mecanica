<?php
class Cliente
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
public function listar(string $busca = ''): array
{
    $sql = 'SELECT id, nome, cpf_hash, telefone, email, endereco
            FROM clientes
            WHERE nome LIKE :busca_nome
               OR telefone LIKE :busca_telefone
               OR email LIKE :busca_email
            ORDER BY nome';

    $stmt = $this->db->prepare($sql);

    $termo = '%' . $busca . '%';

    $stmt->execute([
        ':busca_nome' => $termo,
        ':busca_telefone' => $termo,
        ':busca_email' => $termo
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function porId(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM clientes WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function salvar(array $dados, ?int $id = null): bool
    {
        $nome = trim($dados['nome'] ?? '');
        $cpf = preg_replace('/\D/', '', $dados['cpf'] ?? '');
        $telefone = trim($dados['telefone'] ?? '');
        $email = trim($dados['email'] ?? '');
        $endereco = trim($dados['endereco'] ?? '');

        if ($nome === '' || ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL))) {
            return false;
        }

        if ($id !== null && $id > 0) {
            $sql = 'UPDATE clientes SET nome = :nome, telefone = :telefone,
                    email = :email, endereco = :endereco';
            $params = [
                ':nome' => $nome, ':telefone' => $telefone, ':email' => $email,
                ':endereco' => $endereco, ':id' => $id,
            ];
            if ($cpf !== '') {
                if (strlen($cpf) !== 11) return false;
                $sql .= ', cpf_hash = :cpf_hash';
                $params[':cpf_hash'] = hash('sha256', $cpf);
            }
            $sql .= ' WHERE id = :id';
            return $this->db->prepare($sql)->execute($params);
        }

        if (strlen($cpf) !== 11) {
            return false;
        }
        $sql = 'INSERT INTO clientes (nome, cpf_hash, telefone, email, endereco)
                VALUES (:nome, :cpf_hash, :telefone, :email, :endereco)';
        return $this->db->prepare($sql)->execute([
            ':nome' => $nome, ':cpf_hash' => hash('sha256', $cpf),
            ':telefone' => $telefone, ':email' => $email, ':endereco' => $endereco,
        ]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM clientes WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
