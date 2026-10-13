<?php
//Conexão PDO com MySQL.
class Database
{
    private string $host = 'localhost';
    private string $dbName = 'oficina_mecanica';
    private string $username = 'root';
    private string $password = '';
    private ?PDO $conn = null;

    public function getConnection(): PDO
    {
        if ($this->conn instanceof PDO) {
            return $this->conn;
        }

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
            return $this->conn;
        } catch (PDOException $e) {
            http_response_code(500);
            exit('Não foi possível conectar ao banco. Confira o banco oficina_mecanica e config/Database.php.');
        }
    }
}
