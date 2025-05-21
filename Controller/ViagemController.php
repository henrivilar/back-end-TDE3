<?php
require_once 'Model/ViagemDAO.php';

class ViagemController {
    public function salvar($destino, $data_ida, $data_volta, $valor) {
        $viagem = new Viagem($destino, $data_ida, $data_volta, $valor);
        $dao = new ViagemDAO();
        $dao->salvar($viagem);
    }

    public function listar() {
        $dao = new ViagemDAO();
        return $dao->listar();
    }

    public function excluir($id) {
        $dao = new ViagemDAO();
        $dao->excluir($id);
    }

    public function editar($id, $destino, $data_ida, $data_volta, $valor) {
        $viagem = new Viagem($destino, $data_ida, $data_volta, $valor);
        $viagem->setId($id);
        $dao = new ViagemDAO();
        $dao->editar($viagem);
    }

    public function buscarPorId($id) {
        $dao = new ViagemDAO();
        return $dao->buscarPorId($id);
    }
}