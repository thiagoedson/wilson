<?php
session_start();
include'conexao.php';

$p_pedido = $_GET["npedido"];
$p_tipo   = $_GET["tipo"];
$query_pedidos = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`loja_table` WHERE `tipo` = '$p_tipo'");        
		while($array_pedido = mysqli_fetch_assoc($query_pedidos)){			
			$table = $array_pedido["banco"];
}
$atua_total_pedido = mysqli_query($con,"UPDATE `$banco`.`$table` SET `status` = '4'  WHERE  `npedido` = '$p_pedido'"); 
$mensagem = "Atualizou Status do Pedido $p_pedido para Finalizado $p_tipo";
salvaLog($con,$mensagem);

	header("location:pedido_2.php?type=$p_tipo");




#----------------------------------------------
?>
