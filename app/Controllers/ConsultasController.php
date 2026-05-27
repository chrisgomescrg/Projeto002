<?php
namespace App\Controllers;

use App\Models\Consulta;
use App\Models\Paciente;
use App\Models\Medico;

class ConsultasController {
    private $consultaModel;

    public function __construct() {
        $this->consultaModel = new Consulta();
    }

    // Página inicial de consultas
    public function index() {
        $consultas = $this->consultaModel->getAll();
        require_once __DIR__ . "/../views/consultas/index.php";
    }

    // Cadastro de nova consulta
    public function create() {
        $pacientes = (new Paciente())->getAll();
        $medicos   = (new Medico())->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Captura apenas os campos necessários
            $data = [
                'paciente_id'   => (int)$_POST['paciente_id'],
                'medico_id'     => (int)$_POST['medico_id'],
                'data_consulta' => $_POST['data_consulta'],
                'observacoes'   => $_POST['observacoes'] ?? ''
            ];

            if ($this->consultaModel->create($data)) {
                $_SESSION['sucesso'] = "Consulta cadastrada com sucesso!";
                header("Location: /projeto02/public/index.php?controller=Consultas&action=index");
                exit;
            } else {
                $_SESSION['erro'] = "Erro ao cadastrar consulta!";
            }
        }

        require_once __DIR__ . "/..projeto02/app/views/consultas/create.php";
    }

    // Edição de consulta existente
    public function edit() {
        $pacientes = (new Paciente())->getAll();
        $medicos   = (new Medico())->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];
            $data = [
                'paciente_id'   => (int)$_POST['paciente_id'],
                'medico_id'     => (int)$_POST['medico_id'],
                'data_consulta' => $_POST['data_consulta'],
                'observacoes'   => $_POST['observacoes'] ?? ''
            ];

            if ($this->consultaModel->update($id, $data)) {
                $_SESSION['sucesso'] = "Consulta atualizada com sucesso!";
                header("Location: /projeto02/public/index.php?controller=Consultas&action=index");
                exit;
            } else {
                $_SESSION['erro'] = "Erro ao atualizar consulta!";
            }
        } else {
            $id = (int)($_GET['id'] ?? 0);
            $consulta = $this->consultaModel->getById($id);
            if (!$consulta) {
                $_SESSION['erro'] = "Consulta não encontrada!";
                header("Location: /projeto02/public/index.php?controller=Consultas&action=index");
                exit;
            }
        }

        require_once __DIR__ . "/../views/consultas/edit.php";
    }

    // Exclusão de consulta
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];
            if ($this->consultaModel->delete($id)) {
                $_SESSION['sucesso'] = "Consulta excluída com sucesso!";
            } else {
                $_SESSION['erro'] = "Erro ao excluir consulta!";
            }
            header("Location: /projeto02/public/index.php?controller=Consultas&action=index");
            exit;
        } else {
            $id = (int)($_GET['id'] ?? 0);
            $consulta = $this->consultaModel->getById($id);
            require_once __DIR__ . "/../views/consultas/delete.php";
        }
    }
}