<?php


use App\App;

session_start();
require_once '../../include/info.php';

if (isset($_GET['ACAO'])) {

    if ($_GET['ACAO'] == 'AutenticacaoSISTEMA') {
        $retorno = autenticacaoSISTEMA($_POST);
        echo json_encode($retorno);
        exit;
    }
}