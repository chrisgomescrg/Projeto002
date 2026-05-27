<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class Usuario {
    private PDO $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function autenticar(string $email, string $senha): ?array {
        $sql = "SELECT id, nome, email, senha FROM usuarios WHERE email = :email AND senha = :senha LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':senha' => $senha
        ]);
        $usuario = $stmt->fetch();

        return $usuario ?: null;
    }
}