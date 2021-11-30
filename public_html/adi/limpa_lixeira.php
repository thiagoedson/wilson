<?php
session_start();
include "conexao.php";

$query_pedidos = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`loja_table`");        
		while($array_pedido = mysqli_fetch_assoc($query_pedidos)){			
			$table = $array_pedido["banco"];
			$table_2 = $array_pedido["banco_artigo"];
			
			#---------------------------------------------------------------------------------------------
			$query_pedido_l = mysqli_query($con,"SELECT * FROM `$table` WHERE `status` = '5'");        
		    while($array_pedido_l = mysqli_fetch_assoc($query_pedido_l)){$table_npedido = $array_pedido_l["npedido"];
			$delete_artigos = mysqli_query($con,"DELETE FROM `$table_2` WHERE `npedido` = '$table_npedido'");
			#---------------------------------------------------------------------------------------------
			$delete_pedido = mysqli_query($con,"DELETE FROM `$table` WHERE `npedido` = '$table_npedido'");
			}
			
$mensagem = "Esvaziando a Lixeira";
salvaLog($con,$mensagem);

		}
		
header("location:lixeira.php");
?>