<?php
namespace App\Models;

use PDO;
use App\Config\Database; // importa a classe Database da pasta config

class Consulta {
    private $db;

    public function __construct() {
        // Usa o método connect() da sua classe Database
        $database = new Database();
        $this->db = $database->connect();
    }

    public function getAll() {
        $sql = "SELECT c.*, 
                       p.nome AS paciente_nome, 
                       m.nome AS medico_nome
                FROM consultas c
                JOIN pacientes p ON c.paciente_id = p.id
                JOIN medicos m ON c.medico_id = m.id
                ORDER BY c.data_consulta DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT c.*, 
                       p.nome AS paciente_nome, 
                       m.nome AS medico_nome
                FROM consultas c
                JOIN pacientes p ON c.paciente_id = p.id
                JOIN medicos m ON c.medico_id = m.id
                WHERE c.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO consultas (paciente_id, medico_id, data_consulta, observacoes)
                VALUES (:paciente_id, :medico_id, :data_consulta, :observacoes)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':paciente_id', $data['paciente_id'], PDO::PARAM_INT);
        $stmt->bindValue(':medico_id', $data['medico_id'], PDO::PARAM_INT);
        $stmt->bindValue(':data_consulta', $data['data_consulta']);
        $stmt->bindValue(':observacoes', $data['observacoes']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $sql = "UPDATE consultas 
                SET paciente_id = :paciente_id, 
                    medico_id = :medico_id, 
                    data_consulta = :data_consulta, 
                    observacoes = :observacoes
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':paciente_id', $data['paciente_id'], PDO::PARAM_INT);
        $stmt->bindValue(':medico_id', $data['medico_id'], PDO::PARAM_INT);
        $stmt->bindValue(':data_consulta', $data['data_consulta']);
        $stmt->bindValue(':observacoes', $data['observacoes']);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM consultas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}