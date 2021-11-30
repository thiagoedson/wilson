<?php 

include "protecao.php";
$linha    = $_GET["linha"];
$p_pedido = $_GET["npedido"];
$status   = $_GET["status"];
$p_codigo = $_GET["cliente"];
$p_nomecliente = $_GET["nomecliente"];
$p_estado = "Pendente";
$p_data_pedido = date("Y-m-d");

if ( $status == "novopedido"){

$p_sql = mysql_query("INSERT INTO  `adidas`.`pedidos` (`id` ,`npedido` ,`codigocliente` ,`preco_total` ,`pedido`,`data_pedido` )VALUES (NULL , '$p_pedido',  '$p_codigo',  '$p_recototal',  '$p_estado',  '$p_data_pedido')") or die(mysql_error());

header("Location:loja/index.php?cliente=".$p_codigo."&npedido=".$p_pedido."&nomecliente=".$p_nomecliente."&status=".$p_estado."&linha=".$linha );
}

?>