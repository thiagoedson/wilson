<?php

include "dire.php";
$senha = $_SESSION["codigo"];
$custonartigo = $_SESSION["custonprodutos"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
<style type="text/css">
.pading {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 8pt;
}
</style>
</head>

<body>
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

$query2 = mysql_query("select * from pedido WHERE cliente = '$senha' ORDER BY data_pedido ") or die(mysql_error());

while($array2 = mysql_fetch_array($query2)){


$codigo      = $array2["cliente"];
$npedido     = $array2["npedido"];

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
</body>
</html>