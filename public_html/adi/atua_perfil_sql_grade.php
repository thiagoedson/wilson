<?php
session_start();
include "conexao.php";

$min_c          = $_POST["min_c"];
$min_t          = $_POST["min_t"];
$min_e          = $_POST["min_e"];
$adisul_cod_adi = $_GET["cod_adidas"];


$ssql = mysqli_query($con,"UPDATE  login SET `min_c` = '$min_c', `min_t` = '$min_t', `min_e` = '$min_e' WHERE `B` = '$adisul_cod_adi' ") or die(mysql_error());

$mensagem = "Atualizou o limite de grade do Cliente Codigo Adidas $adisul_cod_adi";
salvaLog($con,$mensagem);

echo "<meta http-equiv=\"refresh\" content=\"0;URL=perfil.php?login=$adisul_cod_adi&atualizado_grade_minima\">";
?>