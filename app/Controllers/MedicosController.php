<?php
namespace App\Controllers;

use App\Models\Medico;

class MedicosController {

    public function index() {
        $model = new Medico();
        $medicos = $model->getAll();
        require_once __DIR__ . "/../views/medicos/index.php";
    }

    public function create() {
        $model = new Medico();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($model->create($_POST)) {
                $_SESSION['sucesso'] = "Médico cadastrado com sucesso!";
                header("Location: /projeto02/public/index.php?controller=Medicos&action=index");
                exit;
            } else {
                $_SESSION['erro'] = "Todos os campos são obrigatórios!";
                header("Location: /projeto02/public/index.php?controller=Medicos&action=create");
                exit;
            }
        }

        require_once __DIR__ . "/../views/medicos/create.php";
    }

    public function edit() {
        $model = new Medico();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id && $model->update($id, $_POST)) {
                $_SESSION['sucesso'] = "Médico atualizado com sucesso!";
                header("Location: /projeto02/public/index.php?controller=Medicos&action=index");
                exit;
            } else {
                $_SESSION['erro'] = "Todos os campos são obrigatórios!";
                header("Location: /projeto02/public/index.php?controller=Medicos&action=edit&id=" . $id);
                exit;
            }
        } else {
            $id = $_GET['id'] ?? null;
            $medico = $model->getById($id);
            if (!$medico) {
                $_SESSION['erro'] = "Médico não encontrado!";
                header("Location: /projeto02/public/index.php?controller=Medicos&action=index");
                exit;
            }
            require_once __DIR__ . "/../views/medicos/edit.php";
        }
    }

    public function delete() {
        $model = new Medico();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if ($id) {
                if ($model->hasFutureConsultas($id)) {
                    $_SESSION['erro'] = "Não é possível excluir: o médico possui consultas futuras agendadas.";
                } elseif ($model->delete($id)) {
                    $_SESSION['sucesso'] = "Médico excluído com sucesso!";
                } else {
                    $_SESSION['erro'] = "Médico não encontrado!";
                }
            }

            header("Location: /projeto02/public/index.php?controller=Medicos&action=index");
            exit;
        } else {
            $id = $_GET['id'] ?? null;
            $medico = $model->getById($id);
            if (!$medico) {
                $_SESSION['erro'] = "Médico não encontrado!";
                header("Location: /projeto02/public/index.php?controller=Medicos&action=index");
                exit;
            }
            require_once __DIR__ . "/../views/medicos/delete.php";
        }
    }
}