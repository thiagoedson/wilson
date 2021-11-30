<?php
session_start();
include "conexao.php";

$adisul_cod_adi   = $_POST["cod_adidas"];
$adisul_comprador = $_POST["comprador"];
$adisul_grupo     = $_POST["grupodosite"];
$adisul_senha     = $_POST["senha"];
$adisul_email     = $_POST["email"];
$adisul_celu1     = $_POST["celular1"];
$adisul_celu2     = $_POST["celular2"];
$adisul_telef     = $_POST["telefone"];
$adisul_status    = $_POST["status"];
$adisul_segmento_1 = $_POST["segmento_1"];
$adisul_segmento_2 = $_POST["segmento_2"];
$adisul_loja      = $_POST["loja"];
$adisul_usuario   = $_POST["cnpj"];
$adisul_cod_grupo        = $_POST["cod_grupo"];
$adisul_cod_referencia   = $_POST["cod_referencia"];
$adisul_cidade           = $_POST["cod_cidades"];
$adisul_estado           = $_POST["cod_estados"];


$query_site3 = mysqli_query($con, "SELECT * FROM login WHERE `B` = '$adisul_cod_adi'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site3 = mysqli_fetch_assoc($query_site3)){	
	$adisul_cidade_x          = $array_site3["cidade"];
	$adisul_estado_x          = $array_site3["UF"];
	
}

if($adisul_cidade == "") { $adisul_cidade = $adisul_cidade_x;}
if($adisul_estado == "") { $adisul_estado = $adisul_estado_x;}

$adisul_grupo = strtoupper($adisul_grupo);

$query_states = mysqli_query($con,"SELECT `UF` FROM `rbkne024_reebok`.`tb_estados` WHERE `id` = '$adisul_estado'");
 while($array_uf = mysqli_fetch_assoc($query_states))
   {
	$adisul_estado      = $array_uf["UF"];
   }

if($adisul_grupo == "") {$adisul_grupo = "SEM GRUPO";}
if($adisul_grupo == "SEM GRUPO") {$adisul_status = "2";}
if($adisul_grupo == "SEM GRUPO" && $_POST["status"] == "3") {$adisul_status = "3";}

$adisul_grupo = strtoupper($adisul_grupo);
$adisul_loja  = strtoupper($adisul_loja);
$adisul_cod_referencia  = strtoupper($adisul_cod_referencia);

$ssql = mysqli_query($con,"UPDATE  login SET
`comprador` = '$adisul_comprador', 
`nome` = '$adisul_grupo', 
`D` = '$adisul_senha', 
`segmento_1` = '$adisul_segmento_1',
`segmento_2` = '$adisul_segmento_2',
`email` = '$adisul_email', 
`celular1` = '$adisul_celu1', 
`celular2` = '$adisul_celu2', 
`telefone` = '$adisul_telef', 
`status` = '$adisul_status' , 
`C` = '$adisul_usuario' , 
`cod_grupo` = '$adisul_cod_grupo' , 
`cod_referencia` = '$adisul_cod_referencia' , 
`cidade` = '$adisul_cidade' , 
`UF` = '$adisul_estado' , 
`loja` = '$adisul_loja' WHERE 
`B` = '$adisul_cod_adi' ") or die(mysql_error());

$mensagem = "Atualizou Cadastro do Cliente Codigo Adidas $adisul_cod_adi";
salvaLog($con,$mensagem);

echo "<meta http-equiv=\"refresh\" content=\"0;URL=perfil.php?login=$adisul_cod_adi\">";
?>