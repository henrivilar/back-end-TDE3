<?php
require_once 'config/Conexao.php';
require_once 'Model/Viagem.php';

class ViagemDAO {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConn();
    }

    public function salvar(Viagem $viagem) {
        $stmt = $this->conn->prepare("INSERT INTO viagens (destino, data_ida, data_volta, valor) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $viagem->getDestino(),
            $viagem->getData_ida(),
            $viagem->getData_volta(),
            $viagem->getValor()
        ]);
    }

    public function listar() {
        $stmt = $this->conn->query("SELECT * FROM viagens");
        $viagens = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $v = new Viagem($row['destino'], $row['data_ida'], $row['data_volta'], $row['valor']);
            $v->setId($row['id']);
            $viagens[] = $v;
        }

        return $viagens;
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM viagens WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function editar(Viagem $viagem) {
        $stmt = $this->conn->prepare("UPDATE viagens SET destino = ?, data_ida = ?, data_volta = ?, valor = ? WHERE id = ?");
        $stmt->execute([
            $viagem->getDestino(),
            $viagem->getData_ida(),
            $viagem->getData_volta(),
            $viagem->getValor(),
            $viagem->getId()
        ]);
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM viagens WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $viagem = new Viagem($row['destino'], $row['data_ida'], $row['data_volta'], $row['valor']);
            $viagem->setId($row['id']);
            return $viagem;
        }

        return null;
    }
}