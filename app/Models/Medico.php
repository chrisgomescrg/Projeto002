<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class Medico {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Buscar todos os médicos
    public function getAll() {
        $stmt = $this->db->query("SELECT id, nome, especialidade, crm FROM medicos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar médico por ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM medicos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Criar novo médico
    public function create($dados) {
        if (!$this->validar($dados)) return false;

        $sql = "INSERT INTO medicos (nome, especialidade, crm) 
                VALUES (:nome, :especialidade, :crm)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nome' => $dados['nome'],
            ':especialidade' => $dados['especialidade'],
            ':crm' => $dados['crm']
        ]);
    }

    // Atualizar médico
    public function update($id, $dados) {
        if (!$this->validar($dados)) return false;

        $sql = "UPDATE medicos 
                SET nome = :nome, especialidade = :especialidade, crm = :crm 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nome' => $dados['nome'],
            ':especialidade' => $dados['especialidade'],
            ':crm' => $dados['crm'],
            ':id' => $id
        ]);
    }

    // Excluir médico
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM medicos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Verificar se o médico tem consultas futuras
    public function hasFutureConsultas($id) {
        $sql = "SELECT COUNT(*) as total 
                FROM consultas 
                WHERE medico_id = :id 
                  AND data_consulta > NOW()";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] > 0;
    }

    // Validação básica
    private function validar($dados) {
        return !empty($dados['nome']) &&
               !empty($dados['especialidade']) &&
               !empty($dados['crm']);
    }
}