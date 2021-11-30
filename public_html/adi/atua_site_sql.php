<?php
session_start();
include "conexao.php";

$colecao = $_POST["colecao"];
$data_atua = $_POST["data_atua"];
$titulo = $_POST["titulo"];
$carteira = $_POST["carteira"];
$faturamento = $_POST["faturamento"];
$situa = $_POST["situa"];
$cancelamento = $_POST["cancelamento"];
$textil = $_POST["textil"];
$calcados = $_POST["calcados"];
$equi = $_POST["equi"];
$cle = $_POST["cle"];
$loja_status = "1";
$data_atua = date('Y-m-d', strtotime(str_replace("/", "-", $data_atua )));
$carteira = date('Y-m-d', strtotime(str_replace("/", "-", $carteira )));
$cancelamento = date('Y-m-d', strtotime(str_replace("/", "-", $cancelamento )));
$faturamento = date('Y-m-d', strtotime(str_replace("/", "-", $faturamento )));
$situa = date('Y-m-d', strtotime(str_replace("/", "-", $situa )));
$textil = date('Y-m-d', strtotime(str_replace("/", "-", $textil )));
$calcados = date('Y-m-d', strtotime(str_replace("/", "-", $calcados )));
$equi = date('Y-m-d', strtotime(str_replace("/", "-", $equi )));
$cle = date('Y-m-d', strtotime(str_replace("/", "-", $cle )));
$sql = mysqli_select_db($con,"site", $con);

$ssql = mysqli_query($con,"UPDATE  site SET
`colecao` = '$colecao',`data_atua` = '$data_atua', `titulo` = '$titulo', `carteira` = '$carteira', `faturamento` = '$faturamento', `situa` = '$situa', `cancelamento` = '$cancelamento', `loja` = '$loja_status', `textil` = '$textil', `calcados` = '$calcados', `equi` = '$equi', `cle` = '$cle' WHERE id = '1'; ") or die(mysql_error());


$mensagem = "Atualizou Status do site";
salvaLog($con,$mensagem);

echo "<meta http-equiv=\"refresh\" content=\"0;URL=home.php\">";

?>