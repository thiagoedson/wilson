<?php


session_start();
require_once '../../include/info.php';

header("Content-type: application/json; charset=utf-8");

if (isset($_REQUEST['ACAO'])) {


    if ($_REQUEST['ACAO'] == 'ListaPedidos') {

        $retorno = listaPedidosADISUL($_REQUEST);
        echo json_encode($retorno);
        exit;

    }
    if ($_REQUEST['ACAO'] == 'UploadFileNovo') {

        $retorno = uploadTabelaADISUL($_POST,$_FILES);
        echo json_encode($retorno);
        exit;

    }
}