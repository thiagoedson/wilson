<?php
session_start();
include "conexao.php";



$senha     = $_SESSION["codigo"];
$comprador = $_POST["comprador"];
$telefone  = $_POST["telefone"];
$celular1  = $_POST["celular1"];
$celular2  = $_POST["celular2"];
$email     = $_POST["email"];

$email = strtolower($email);



$sql = mysql_select_db("login", $con);

$ssql = mysql_query("UPDATE  `$banco`.`login` SET
`comprador` = '$comprador',`telefone` = '$telefone', `celular1` = '$celular1', `celular2` = '$celular2', `email` = '$email' WHERE B = '$senha'; ") or die(mysql_error());


echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=info2.php'>";


?>