<?php
class Viagem {
    private $id;
    private $destino;
    private $data_ida;
    private $data_volta;
    private $valor;

    public function __construct($destino = '', $data_ida = '', $data_volta = '', $valor = 0.01) {
        $this->destino = $destino;
        $this->data_ida = $data_ida;
        $this->data_volta = $data_volta;
        $this->valor = $valor;
    }

    public function getId() { return $this->id; }
    public function getDestino() { return $this->destino; }
    public function getData_ida() { return $this->data_ida; }
    public function getData_volta() { return $this->data_volta; }
    public function getValor() { return $this->valor; }

    public function setId($id) { $this->id = $id; }
    public function setDestino($destino) { $this->destino = $destino; }
    public function setData_ida($data_ida) { $this->data_ida = $data_ida; }
    public function setData_volta($data_volta) { $this->data_volta = $data_volta; }
    public function setValor($valor) { $this->valor = $valor; }
}