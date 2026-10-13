<?php
class Veiculo
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
public function listar(): array
    {
        $sql = 'SELECT v.*, c.nome AS cliente_nome
                FROM veiculos v JOIN clientes c ON c.id = v.cliente_id
                ORDER BY v.placa';
        return $this->db->query($sql)->fetchAll();
    }

    public function clientes(): array
    {
        return $this->db->query('SELECT id, nome FROM clientes ORDER BY nome')->fetchAll();
    }

    public function cadastrar(array $dados): bool
    {
        $clienteId = (int) ($dados['cliente_id'] ?? 0);
        $placa = strtoupper(trim($dados['placa'] ?? ''));
        $marca = trim($dados['marca'] ?? '');
        $modelo = trim($dados['modelo'] ?? '');
        $ano = (int) ($dados['ano'] ?? 0);
        $cor = trim($dados['cor'] ?? '');

        if ($clienteId < 1 || $placa === '' || $marca === '' || $modelo === '' || $ano < 1900 || $ano > ((int) date('Y') + 1)) {
            return false;
        }
        $sql = 'INSERT INTO veiculos (cliente_id, placa, marca, modelo, ano, cor)
                VALUES (:cliente_id, :placa, :marca, :modelo, :ano, :cor)';
        return $this->db->prepare($sql)->execute([
            ':cliente_id' => $clienteId, ':placa' => $placa, ':marca' => $marca,
            ':modelo' => $modelo, ':ano' => $ano, ':cor' => $cor,
        ]);
    }
}
