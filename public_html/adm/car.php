<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<title>adisul.net</title>
</head>
<body>
<?php

// ---------------------------------Verifica carrinho com produtos que foram dropeados----------------------------------------------------
include"conexao.php";


$query_artigo_tabela = mysqli_query($con, "SELECT `id`,`artigo`,`quantidade` FROM `$banco`.`lista_artigo_pedido_ss16`") or die(mysql_error());
	while($array_xx = mysqli_fetch_array($query_artigo_tabela)){
		$idpedido           = $array_xx["id"];
		$artigopedido       = $array_xx["artigo"];
		$quantipedido       = $array_xx["quantidade"];
			
		$query_tabela = mysqli_query($con_reebok, "SELECT `custo` FROM `$banco_reebok`.`prevendass16` WHERE `Artigo` = '$artigopedido'") or die(mysql_error());
			$lin = mysqli_num_rows($query_tabela);
    		if($lin==0) // verifica se retornou algum registro
    			{ $sql_limpa = mysqli_query($con, "DELETE  FROM `$banco`.`lista_artigo_pedido_ss16` WHERE `id` = '$idpedido'") or die(mysql_error()); }
				
			else {
					while($array_yy = mysqli_fetch_array($query_tabela)){
					$custo           = $array_yy["custo"];
					}
					$custo = str_replace(",", ".", $custo);
					
					$total = $custo * $quantipedido;
					
					$query_npedido = mysqli_query($con, "UPDATE  `$banco`.`lista_artigo_pedido_ss16` SET `valor` = '$custo' , `total` = '$total'  WHERE  `artigo` = '$artigopedido' AND `quantidade` = '$quantipedido' ") or die(mysql_error());
					
					echo " $artigopedido - $custo - $total - $quantipedido <br>";
					
					
					
				
				
				
			}
		
		}
		//---------------------------------------------Adicionar total do pedido --------------------------------------------------------------------------------------------
		
		$query_a_tabela = mysqli_query($con, "SELECT DISTINCT `npedido` FROM `$banco`.`lista_artigo_pedido_ss16`") or die(mysql_error());
			while($linha_array_ee = mysqli_fetch_array($query_a_tabela))
				{
					$pedido = $linha_array_ee["npedido"];
					
					$somar_total_pedido = mysqli_query($con, "SELECT SUM(total) as soma FROM  `lista_artigo_pedido_ss16`  WHERE  `npedido` = '$pedido'") or die(mysql_error());
    					while($linha_array_ee = mysqli_fetch_array($somar_total_pedido))
						{
							$linha_ee = $linha_array_ee["soma"];
							
							}
	
    					$atua_total_pedido = mysqli_query($con, "UPDATE `$banco`.`pedido_ss16` SET `total` = '$linha_ee'  WHERE  `npedido` = '$pedido'"); 
	
	}


?>	
</div>


</body>
</html>