<?php
namespace App\Controllers;

use App\Config\Database;
use PDO;

class DashboardController {
    public function index() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /projeto02/public/index.php?controller=Auth&action=login");
            exit;
        }
        require_once __DIR__ . "/../views/dashboard/index.php";
    }

    public function cadastrarUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome  = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $db = (new Database())->connect();
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':senha' => $senha // sem criptografia, como você pediu
            ]);

            // Após cadastro, volta ao dashboard
            header("Location: /projeto02/public/index.php?controller=Dashboard&action=index");
            exit;
        }
    }
}