<?php
namespace App\Controllers;

use App\Config\Database;
use PDO;

class UsuariosController {
    public function index() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /projeto02/public/index.php?controller=Auth&action=login");
            exit;
        }

        $db = (new Database())->connect();
        $usuarios = $db->query("SELECT id, nome, email FROM usuarios")->fetchAll();

        require_once __DIR__ . "/../views/usuarios/index.php";
    }

    public function create() {
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
                ':senha' => $senha
            ]);

            $_SESSION['sucesso'] = "Usuário cadastrado com sucesso!";
            header("Location: /projeto02/public/index.php?controller=Usuarios&action=index");
            exit;
        }

        require_once __DIR__ . "/../views/usuarios/create.php";
    }

    public function edit() {
        $db = (new Database())->connect();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id    = $_POST['id'];
            $nome  = $_POST['nome'];
            $email = $_POST['email'];

            // Atualiza nome e email
            $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':id' => $id
            ]);

            // Se o checkbox "alterar_senha" foi marcado
            if (isset($_POST['alterar_senha']) && $_POST['alterar_senha'] === '1') {
                if (!empty($_POST['senha_atual']) && !empty($_POST['nova_senha'])) {
                    $stmt = $db->prepare("SELECT senha FROM usuarios WHERE id = :id");
                    $stmt->execute([':id' => $id]);
                    $usuario = $stmt->fetch();

                    if ($usuario && $usuario['senha'] === $_POST['senha_atual']) {
                        $stmt = $db->prepare("UPDATE usuarios SET senha = :nova WHERE id = :id");
                        $stmt->execute([
                            ':nova' => $_POST['nova_senha'],
                            ':id' => $id
                        ]);
                        $_SESSION['sucesso'] = "Senha atualizada com sucesso!";
                    } else {
                        $_SESSION['erro'] = "Usuário não pode ser atualizado: senha atual incorreta.";
                        header("Location: /projeto02/public/index.php?controller=Usuarios&action=index");
                        exit;
                    }
                }
            }

            // Atualização concluída → volta para listagem
            if (!isset($_SESSION['sucesso'])) {
                $_SESSION['sucesso'] = "Usuário atualizado com sucesso!";
            }
            header("Location: /projeto02/public/index.php?controller=Usuarios&action=index");
            exit;
        } else {
            $id = $_GET['id'] ?? null;
            $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $usuario = $stmt->fetch();

            require_once __DIR__ . "/../views/usuarios/edit.php";
        }
    }
}