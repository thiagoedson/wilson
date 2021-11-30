<?php
$pedido = $_GET["codigo"];
#include "protecao.php";
$senha = $_SESSION["codigo"];
$custonartigo = $_SESSION["custonprodutos"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mauricio</title>
<style type="text/css">
#cx_01 {
	position:absolute;
	left:0;
	top:0;
	width:900px;
	height:35px;
	background-color: #000000;
	font-family: Verdana, Geneva, sans-serif;
	color: #FFF;
	font-size: 10pt;
}
body {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10pt;
	color: #000;
}
#menu {
	position:absolute;
	left:-0;
	top:35px;
	width:900px;
	height:35px;
	background-color: #FFFFCC;
	font-family: Verdana, Geneva, sans-serif;
	color: #FFF;
	font-size: 10pt;
}

a:visited {
	color:#00F;
	}
a:hover {
	color:#F00;}
#lista_pedido {
	width: 900px;
	position:absolute;
	height:auto;
	background-color:#FF9;
	top:100px;
	left:0;
	font-size:10pt;
}
.pading {
	font-size:10pt;}
</style>
</head>

<body>
<div>
<div id="cx_01">
Seja Bem Vindo, 
<?php 
$con = mysql_connect($host, $user, $pass) or die (mysql_error());
mysql_select_db($banco);
$query = mysql_query("SELECT * FROM clientes WHERE codigocliente = '$senha'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array = mysql_fetch_array($query)){	
	$nome_cliente = $array["cliente"];
	$limite_credito = $array["limite de credito"];
	$grupo = $array["descricaodogrupo"];
};
echo $nome_cliente; ?> 
seu limite de crédito atual é <?php echo $limite_credito; ?>  - 
<a href="sair.php">Sair</a><br />

Sua linha de produtos é <?php echo $custonartigo; ?>  -  Você pertence ao grupo <?php echo $grupo; ?> .
</div>
<div id="menu">
<a href="principal.php" >Inicio</a> - <a href="pedido.php?codigo=<?php echo $senha;?>" >Meus Pedidos</a> - 
</div>
<div id="lista_pedido">
<table width="100%" class="pading">
   <tr>
     <td colspan="5">Pedidos</td>
   </tr>
   <tr>
     <td>Seu Código</td><td>Nº Pedido</td><td>Valor</td><td>Data do pedido</td><td>Situação</td>
   </tr>
   
   <?php
   
 

$sql2 = mysql_select_db("adidas", $con);

$query2 = mysql_query("select * from pedidos WHERE codigocliente = '$senha' ORDER BY pedido ") or die(mysql_error());

while($array2 = mysql_fetch_array($query2)){


$codigo      = $array2["codigocliente"];
$npedido     = $array2["npedido"];
$pedido      = $array2["pedido"];
$data_pedido = $array2["data_pedido"];
$preco_total = $array2["preco_total"];

$data_pedido = date('d/m/Y', strtotime(str_replace("-", "/", $data_pedido )));


echo "

 <tr bgcolor=\"$cor\" >
   <td>&nbsp;$codigo</td><td>&nbsp;$npedido</td><td>$precototal</td><td>$data_pedido</td><td>$pedido</td>
 </tr>";
}
?>
 </table>
</div>
</div>
</body>
</html>