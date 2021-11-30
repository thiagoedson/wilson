<?php 
session_start();
include "dire.php";

$senha = $_SESSION["codigo"];


$query = mysql_query("SELECT * FROM login WHERE `B` = '$senha'");
while($array = mysql_fetch_array($query)){	
	  
	  $p_login        = $array["C"];
	  $p_senha        = $array["D"];
	  $p_comprador    = $array["comprador"];
	  $p_telefone     = $array["telefone"];
	  $p_celular1     = $array["celular1"];
	  $p_celular2     = $array["celular2"];
	  $p_email        = $array["email"];
	  $p_codigo       = $array["B"];
	  
};

#-----------------Condições-------------------------------------------
if ($situa == "Ativo") {$class1 = "ativo";}

if ($grupo == "SEM GRUPO") {
	$red = "#FFF000";
	$text_msg = "<a href=\"carteira.php\" target=\"iframe\">Minha Carteira</a>";}
	else {$text_msg ="<a href=\"carteira_grupo.php\" target=\"_blank\">Ver carteira do grupo</a>";}

$nega = "lost";	

if(strstr($cre_dispo, '-')) {
	$nega = "nega";}
#----------------Tratamento-------------------------------------------	
	
$limite_cre = "R$ ".$limite_cre;
$cre_dispo = "R$ ".$cre_dispo;
$total_aberto = "R$ ".$total_aberto;
$post_carteira = "R$ ".$post_carteira;
$proce_fatura = "R$ ".$proce_fatura;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Info -</title>
<style type="text/css">
body {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 8pt;
}
.list {
	color:#000;
	font-size: 8pt;
	background-color:#CCC;}
.lost {
	color:#666;
	font-size: 8pt;
	background-color:#FFC;}	
.ativo {
	color:#0C0;
	font-size: 8pt;}
.inativo {
	color:#F00;
	font-size: 8pt;}

li {
	text-decoration: none;
	list-style-type: none;
	
}

a{ text-decoration:none;
   color:#00F;
	}
a:hover {
	color:#F00;
	text-decoration:underline;}
.nega {
	
	color:#F00;}
.list11 {
	font-family:Verdana, Geneva, sans-serif;
	font-size:8pt;
	color:#333;
	text-align:center;}
</style>
</head>

<body>

<table>
  <tr >
    <td align="center" colspan="4" bordercolor="#000000">Minhas Informações</td>
  </tr>
  <tr>
    <td class="list" colspan="3">Codigo Cliente:</td><td  class="lost"><?php echo $p_codigo;?></td>
  </tr>
  <tr>
    <td class="list">Login:</td><td  class="lost" colspan="3"><?php echo $p_login;?></td>
  </tr>
  <tr>
    <td class="list">Senha:</td><td  class="lost" colspan="2">*********</td><td class="list"><a href="#" >Alterar Senha</a></td>
  </tr>
  <tr>
    <td class="list">Comprador:</td><td  class="lost"><?php echo $p_comprador;?></td><td class="list">Telefone:</td><td  class="lost"><?php echo $p_telefone;?></td>
  </tr>
  <tr>
    <td class="list">Celular 1:</td><td  class="lost" ><?php echo $p_celular1;?></td><td class="list">Celular 2:</td><td  class="lost"><?php echo $p_celular2;?></td>
  </tr>
  <tr>
    <td class="list">Email principal*:</td><td  class="lost" colspan="3"><?php echo $p_email;?></td>
  </tr>
  <tr>
    <td class="list11" colspan="4">Atenção para efetuar compras no site é obrigatório cadastrar seu email, é atraveis dele que iremos mandar um cópia do pedido, tirar duvidas, e demais funções.</td>
  </tr>
  <tr>
    <td class="list11" colspan="4"><a href="perfil_update.php">Atualizar meus dados</a></td>
  </tr>
</table>
<hr />


</body>
</html>