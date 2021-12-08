<?php


session_start();
require_once '../../include/info.php';

header("Content-type: application/json; charset=utf-8");

if (isset($_GET['ACAO'])) {


    if ($_GET['ACAO'] == 'CarregaProdutos') {

        $retorno = carregaProdutosADISUL($_POST);
        echo json_encode($retorno);
        exit;

    }
}