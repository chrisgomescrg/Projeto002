<?php
namespace App\Controllers;

use App\Config\Database;
use PDO;

class PacientesController {

    // Listagem de pacientes
    public function index() {
        $db = (new Database())->connect();

        $stmt = $db->query("SELECT id, nome, cpf, telefone, email, data_nascimento FROM pacientes");
        $pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . "/../views/pacientes/index.php";
    }

    // Cadastro de paciente
    public function create() {
        $db = (new Database())->connect();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome  = trim($_POST['nome'] ?? '');
            $cpf   = trim($_POST['cpf'] ?? '');
            $telefone = trim($_POST['telefone'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $data_nascimento = trim($_POST['data_nascimento'] ?? '');

            // Validação: todos os campos obrigatórios
            if (empty($nome) || empty($cpf) || empty($telefone) || empty($email) || empty($data_nascimento)) {
                $_SESSION['erro'] = "Todos os campos são obrigatórios!";
                header("Location: /projeto02/public/index.php?controller=Pacientes&action=create");
                exit;
            }

            $sql = "INSERT INTO pacientes (nome, cpf, telefone, email, data_nascimento) 
                    VALUES (:nome, :cpf, :telefone, :email, :data_nascimento)";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':nome' => $nome,
                ':cpf' => $cpf,
                ':telefone' => $telefone,
                ':email' => $email,
                ':data_nascimento' => $data_nascimento
            ]);

            $_SESSION['sucesso'] = "Paciente cadastrado com sucesso!";
            header("Location: /projeto02/public/index.php?controller=Pacientes&action=index");
            exit;
        }

        require_once __DIR__ . "/../views/pacientes/create.php";
    }

    // Edição de paciente
    public function edit() {
        $db = (new Database())->connect();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id    = $_POST['id'] ?? null;
            $nome  = trim($_POST['nome'] ?? '');
            $cpf   = trim($_POST['cpf'] ?? '');
            $telefone = trim($_POST['telefone'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $data_nascimento = trim($_POST['data_nascimento'] ?? '');

            if (empty($id) || empty($nome) || empty($cpf) || empty($telefone) || empty($email) || empty($data_nascimento)) {
                $_SESSION['erro'] = "Todos os campos são obrigatórios!";
                header("Location: /projeto02/public/index.php?controller=Pacientes&action=edit&id=" . $id);
                exit;
            }

            $sql = "UPDATE pacientes 
                    SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email, data_nascimento = :data_nascimento 
                    WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':nome' => $nome,
                ':cpf' => $cpf,
                ':telefone' => $telefone,
                ':email' => $email,
                ':data_nascimento' => $data_nascimento,
                ':id' => $id
            ]);

            $_SESSION['sucesso'] = "Paciente atualizado com sucesso!";
            header("Location: /projeto02/public/index.php?controller=Pacientes&action=index");
            exit;
        } else {
            $id = $_GET['id'] ?? null;
            if (!$id) {
                $_SESSION['erro'] = "Paciente não encontrado!";
                header("Location: /projeto02/public/index.php?controller=Pacientes&action=index");
                exit;
            }

            $stmt = $db->prepare("SELECT * FROM pacientes WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$paciente) {
                $_SESSION['erro'] = "Paciente não encontrado!";
                header("Location: /projeto02/public/index.php?controller=Pacientes&action=index");
                exit;
            }

            require_once __DIR__ . "/../views/pacientes/edit.php";
        }
    }

    // Exclusão de paciente (com confirmação)
    public function delete() {
        $db = (new Database())->connect();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if ($id) {
                $stmt = $db->prepare("DELETE FROM pacientes WHERE id = :id");
                $stmt->execute([':id' => $id]);

                $_SESSION['sucesso'] = "Paciente excluído com sucesso!";
            } else {
                $_SESSION['erro'] = "Paciente não encontrado!";
            }

            header("Location: /projeto02/public/index.php?controller=Pacientes&action=index");
            exit;
        } else {
            $id = $_GET['id'] ?? null;
            if (!$id) {
                $_SESSION['erro'] = "Paciente não encontrado!";
                header("Location: /projeto02/public/index.php?controller=Pacientes&action=index");
                exit;
            }

            $stmt = $db->prepare("SELECT * FROM pacientes WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$paciente) {
                $_SESSION['erro'] = "Paciente não encontrado!";
                header("Location: /projeto02/public/index.php?controller=Pacientes&action=index");
                exit;
            }

            require_once __DIR__ . "/../views/pacientes/delete.php";
        }
    }
}