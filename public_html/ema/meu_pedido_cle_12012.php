<?php
session_start();
include "dire.php";
$senha = $_SESSION["codigo"];
$p_pedido = $_GET["npedido"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $titulo;?></title>
<link href="img/Adidas.ico" rel="shortcut icon" type="image/x-icon" />
<link type="text/css" href="menu.css" rel="stylesheet" />
<link type="text/css" href="coin-slider-styles.css" rel="stylesheet" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="menu.js"></script>
<script type="text/javascript" src="coin-slider.min.js"></script>
<script type="text/javascript" src="coin-slider.js"></script>
<style type="text/css" media="all">
@import url("estilo.css");

</style>
</head>
<body >
<?php echo $menu_principal ;?>
<div id="iframe">
<div id="car">
<a href="pedidos.php" >Voltar</a>
<br />

<img src="shop/img/carrinho.png"  />
<hr />
<hr />
<hr />
<br />

<table class="car_table"> 
<thead> 
  <tr>
    <th></th><th>Artigo</th><th>Descrição</th><th>Quantidade</th><th>Segmentação</th><th>Valor Unitário</th><th>Valor Total</th><th>Data</th><th></th></tr>

</thead>
<tbody>
<?php

$tora = 0;

$query_pedido_aberto = mysql_query("SELECT DISTINCT artigo, data FROM  lista_artigo_pedido_cle_12012  WHERE npedido = '$p_pedido'") or die(mysql_error());

	
	$lin = mysql_num_rows($query_pedido_aberto);
    if($lin==0) // verifica se retornou algum registro
    {
    echo "<center class=\"car_vazio\">Carrinho Vazio</center>";     }
	
    while($array_pedido_aberto = mysql_fetch_array($query_pedido_aberto)){
		
    $sqlpedido_artigo      = $array_pedido_aberto["artigo"];
    $sqlpedido_data        = $array_pedido_aberto["data"];
	$sqlpedido_datax       = $array_pedido_aberto["data"];
	

#------conta a quantidade de produtos------------------------
$query_total = mysql_query("SELECT SUM(quantidade) as soma FROM  lista_artigo_pedido_cle_12012  WHERE `artigo` = '$sqlpedido_artigo' AND `npedido` = '$p_pedido' AND `data` = '$sqlpedido_data'") or die(mysql_error());
while($linha_array = mysql_fetch_array($query_total)){$linha = $linha_array["soma"];}
$sqlpedido_data = date('d/m/Y', strtotime(str_replace("-", "/", $sqlpedido_data )));

#------------------------------------------------------------
#----------------------Soma Pedido---------------------------

$query_total_pe = mysql_query("SELECT SUM(total) as soma FROM  lista_artigo_pedido_cle_12012  WHERE  `npedido` = '$p_pedido'") or die(mysql_error());
while($linha_array_pe = mysql_fetch_array($query_total_pe)){$linha_pe = $linha_array_pe["soma"];}

#------------------------------------------------------------
#------recolhendo informações------------------------
$query_info = mysql_query("SELECT * FROM  lista_artigo_pedido_cle_12012  WHERE `artigo` = '$sqlpedido_artigo' AND `npedido` = '$p_pedido'") or die(mysql_error());
while($linha_array_info = mysql_fetch_array($query_info)){
	$info_valor_unite     = $linha_array_info["valor"];
	$info_descricao_unite = $linha_array_info["descricao"];
	$info_segmento_unite  = $linha_array_info["segmento"];
	$sqlpedido_total      = $linha_array_info["valor"];}

#------------------------------------------------------------

#-----------Tratanto valores e fazendo conta -------------------

	
	#$sqlpedido_data    = date('d/m/Y', strtotime(str_replace("-", "/", $sqlpedido_data )));
	$info_valor_unitex = str_replace(",", ".", $info_valor_unite);	
	$total_item        = $sqlpedido_total * $linha;
	$total_item        = $total_item * $sul;
	$linha_pe          = $linha_pe * $sul;	
	$total_pedido      = $linha_pe;	
	$total_item        =  number_format($total_item, 2, ',', '.');	
	$info_valor_unite  = str_replace(",", ".", $info_valor_unite);	
	$info_valor_unite  = $info_valor_unite * $sul;	
	$info_valor_unite  =  number_format($info_valor_unite, 2, ',', '.');
	$linha_pe          =  number_format($linha_pe, 2, ',', '.');
	
	
#------------------------------------------------------------------
	
	echo "<tr><td><img src=\"http://www.adisul.com/thumb/".$sqlpedido_artigo."_F.jpg\" width=\"60px\" style=\"background:none;\" /></td><td>$sqlpedido_artigo</td><td>$info_descricao_unite</td><td>$linha</td><td>$info_segmento_unite</td><td>R$ $info_valor_unite</td><td>R$ $total_item</td><td>$sqlpedido_data</td><td>|</td></tr>
	
	";
	
	}


$atua_total_pedido = mysql_query("UPDATE pedido_cle_12012 SET `total` = '$total_pedido'  WHERE  `npedido` = '$p_pedido'"); 



if($total_pedido <= 1000) { $condicao = "menor";
												
							$ver_total = "<b class=\"$condicao\">Total do Pedido Nº $p_pedido R$ ".$total_pedido =  number_format($total_pedido, 2, ',', '.') ."</b>
							<br /> Somente será aceito pedido com valor mínimo de R$ 1.000,00<br />
									";} 
					else {
						$condicao = "maior";
						$ver_total = "<b class=\"$condicao\">Total do Pedido Nº $p_pedido R$ ".$total_pedido =  number_format($total_pedido, 2, ',', '.') ."</b><br />
						";}


?>

<tr><td colspan="9" align="center" style="height:40px;"><?php echo $ver_total;?></td></tr>
</tbody>
</table>

</div>



</div>

<script type="text/javascript">
$(document).ready(function() {
$('#coin-slider').coinslider();
});
</script>
</body>
</html>