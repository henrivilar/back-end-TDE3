<?php
require_once 'Controller/ViagemController.php';

$controller = new ViagemController();

$mensagem = "";
if (isset($_GET['msg']) && $_GET['msg'] === 'excluido') {
    $mensagem = "<p style='color:green;'>Viagem excluída com sucesso!</p>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir_id'])) {
    $controller->excluir($_POST['excluir_id']);
    header("Location: index.php?msg=excluido");
    exit;
}

$destino = "";
$data_ida = "";
$data_volta = "";
$valor = "";
$editar_id = null;

if (isset($_GET['editar_id'])) {
    $editar_id = intval($_GET['editar_id']);
    $viagemEdit = $controller->buscarPorId($editar_id);
    if ($viagemEdit) {
        $destino = $viagemEdit->getDestino();
        $data_ida = $viagemEdit->getData_ida();
        $data_volta = $viagemEdit->getData_volta();
        $valor = $viagemEdit->getValor();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destino = $_POST['destino'] ?? "";
    $data_ida = $_POST['data_ida'] ?? "";
    $data_volta = $_POST['data_volta'] ?? "";
    $valor = isset($_POST['valor']) ? floatval($_POST['valor']) : "";

    $hoje = date('Y-m-d');

    if ($data_ida < $hoje) {
        $mensagem = "<p style='color:red;'>Erro: A data de ida não pode ser no passado.</p>";
    } elseif ($data_volta < $data_ida) {
        $mensagem = "<p style='color:red;'>Erro: A data de volta não pode ser antes da ida.</p>";
    } elseif ($valor <= 0) {
        $mensagem = "<p style='color:red;'>Erro: O valor da viagem deve ser positivo.</p>";
    } else {
        if (isset($_POST['editar_id']) && !empty($_POST['editar_id'])) {
            $controller->editar(intval($_POST['editar_id']), $destino, $data_ida, $data_volta, $valor);
            $mensagem = "<p style='color:green;'>Viagem atualizada com sucesso!</p>";
        } elseif (isset($_POST['acao']) && $_POST['acao'] === 'salvar') {
            $controller->salvar($destino, $data_ida, $data_volta, $valor);
            $mensagem = "<p style='color:green;'>Viagem salva com sucesso!</p>";
        }

        $editar_id = null;
        $destino = $data_ida = $data_volta = $valor = "";
    }
}

$viagens = $controller->listar();

include 'View/viagemform.php';
?>