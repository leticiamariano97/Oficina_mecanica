# Exemplo de relacionamento
A consulta de ordens usa "ordens_servico.veiculo_id" para chegar ao veículo e "veiculos.cliente_id" para chegar ao cliente:

```sql
SELECT os.*, c.nome AS cliente_nome, v.placa, v.modelo
FROM ordens_servico os
JOIN veiculos v ON v.id = os.veiculo_id
JOIN clientes c ON c.id = v.cliente_id
ORDER BY os.data_abertura DESC;
```

A busca de clientes usa parâmetros preparados:
```php
$stmt = $pdo->prepare('SELECT id,nome FROM clientes WHERE nome LIKE :termo');
$stmt->execute([':termo' => '%' . $termo . '%']);
```
