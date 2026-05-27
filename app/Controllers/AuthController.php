<?php
namespace App\Controllers;

use App\Models\Usuario;

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->autenticar($email, $senha);

            if ($usuario) {
                $_SESSION['usuario_id']   = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                header("Location: /projeto02/public/index.php?controller=Dashboard&action=index");
                exit;
            } else {
                $erro = "Email ou senha inválidos.";
                require_once __DIR__ . "/../views/auth/login.php";
            }
        } else {
            require_once __DIR__ . "/../views/auth/login.php";
        }
    }

    public function logout() {
        session_destroy();
        header("Location: /projeto02/public/index.php?controller=Auth&action=login");
        exit;
    }
}