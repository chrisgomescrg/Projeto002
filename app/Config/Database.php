<?php
namespace App\Config;

use PDO;
use PDOException;

class Database {
    private string $host = "localhost";
    private string $db_name = "clinica";
    private string $username = "root";       // ajuste conforme seu MySQL
    private string $password = "";           // ajuste conforme seu MySQL
    private ?PDO $conn = null;

    public function connect(): ?PDO {
        if ($this->conn === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8";
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Erro na conexão com o banco: " . $e->getMessage());
            }
        }
        return $this->conn;
    }
}