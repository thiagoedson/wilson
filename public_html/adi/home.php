<?php
session_cache_limiter( 'nocache' );
session_start();
include"conexao.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="images/iso.png" rel="shortcut icon"  type="image/png"/>
<link href="images/iso.png" rel="apple-touch-icon" type="image/png"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="visualize.jQuery.css"/>
<script type="text/javascript" src="visualize.jQuery.js"></script>
<script src="mint.js" type="text/javascript"></script>
<title>ADISUL- Controle Administrativo</title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<style type="text/css">


#container {
	position:relative;
	margin:auto;
	width:900px;}



.efeito {
	text-decoration:blink;
	}
</style>
<script type="text/javascript" src="jquery.js">    </script>
<script src="jquery-blink.js" language="javscript" type="text/javascript"></script>
 
<script type="text/javascript" language="javascript">
 
$(document).ready(function()
{
        $('.blink').blink(); // default is 500ms blink interval.
        //$('.blink').blink({delay:100}); // causes a 100ms blink interval.
});
 
</script>

<link type="text/css" href="menu.css" rel="stylesheet" />

<script type="text/javascript" src="menu.js"></script>
<style type="text/css" media="all">
@import url("menu.css");



#lista_negra {
	position: absolute;
	left: 553px;
	top: 140px;
	width: 160px;
	height: 107px;
	background-color: #FFFFFF;
	background-image: url(images/logo_negra.jpg);
}


</style>
<script type="text/javascript">
			$(function(){
				//make some charts
				// mais detalhes em http://www.filamentgroup.com/lab/jquery_visualize_plugin_accessible_charts_graphs_from_tables_html5_canvas/
				//$('table').visualize({type: 'pie', pieMargin: 10, title: 'asdqwe'});	
				//$('table').visualize({type: 'line'});
				//$('table').visualize({type: 'area'});
				$('table').visualize();
			});
		</script>

</head>
<body>


<div id="container">
<?php echo $menu_adi;?>
<div id="pesquisa">
<form action="pesquisa_cliente.php" method="post">
Busca por nome , Código Adidas OU CNPJ:<input type="text" name="search" /> <input type="submit" value="BUSCAR" style="padding:2px 5px 2px 5px;" />
</form>
</div>


<div id="p_painel">
<?php


$query_site = mysqli_query($con, "SELECT * FROM site") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site = mysqli_fetch_assoc($query_site)){	
	$colecao = $array_site["colecao"];
	$data_atua = $array_site["data_atua"];
	$titulo = $array_site["titulo"];
	$carteira = $array_site["carteira"];
	$faturamento = $array_site["faturamento"];
	$situa = $array_site["situa"];
	$cancelamento = $array_site["cancelamento"];

	
	
	
}
if($loja_status == "1"){$loja_status = "<font color=\"#00FF00\">ON</font>";}
	elseif($loja_status == "2") {$loja_status = "<font color=\"#FF0000\">OFF</font>";}


$data_atua = date('d/m/Y', strtotime(str_replace("-", "/", $data_atua )));
$carteira = date('d/m/Y', strtotime(str_replace("-", "/", $carteira )));
$faturamento = date('d/m/Y', strtotime(str_replace("-", "/", $faturamento )));
$situa = date('d/m/Y', strtotime(str_replace("-", "/", $situa )));
$cancelamento = date('d/m/Y', strtotime(str_replace("-", "/", $cancelamento )));

?>



<br />
<br />
<div class="banner_wide">
Titulo do Site : <?php echo $titulo ;?> <br />
<table>

  <tr>
    <td>Carteira</td><td><?php echo $carteira;?></td>
  </tr>
  <tr>
    <td>Faturamento</td><td><?php echo $faturamento;?></td>
  </tr>
  <tr>
    <td>Situação de Crédito</td><td><?php echo $situa;?></td>
  </tr>
  <tr>
    <td>Cancelamento</td><td><?php echo $cancelamento;?></td>
  </tr>

</table>


</div>

<div id="campo22" style="color:#000;background-color:#FFF;padding:20px;">


<!----- Começa aquii -->

<?php

$query_tabela = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`loja_table` WHERE `status` = '2' ORDER BY `id` DESC");
while($array_tale = mysqli_fetch_assoc($query_tabela)){
	$tx_banco = $array_tale["banco"];
	$tx_tipo  = $array_tale["tipo"];
	$tx_desc  = $array_tale["descricao"];
	
	
?>


<fieldset style="padding:1px; margin:1px;"><legend><?php echo $tx_desc ;?></legend>
<fieldset style="padding:1px; width:130px; margin:3px; float:left; border-color:#090;"><legend>Total Pedidos </legend>R$ 
<?php
$query_total_1000 = mysqli_query($con,"SELECT SUM(total) as soma FROM  `$tx_banco` WHERE `status` != '5'") or die(mysql_error());
while($array_1000 = mysqli_fetch_assoc($query_total_1000)){
	$linha_1000 = $array_1000["soma"];
	$linha_1000 =  number_format($linha_1000, 2, ',', '.');
	}

echo $linha_1000 ;
?>
</fieldset>
<fieldset style="padding:1px; width:130px; margin:3px; float:left; border-color:#F90;"><legend>Pedidos em aberto</legend>R$ 
<?php
$query_total_1001 = mysqli_query($con,"SELECT SUM(total) as soma FROM  `$tx_banco` WHERE `status` = '1'") or die(mysql_error());
while($array_1001 = mysqli_fetch_assoc($query_total_1001)){
	$linha_1001 = $array_1001["soma"];
	$linha_1001 =  number_format($linha_1001, 2, ',', '.');
	}

echo $linha_1001 ;
?>
</fieldset>
<fieldset style="padding:1px; width:130px; margin:3px; float:left; border-color:#F00;"><legend>Pedidos Enviados</legend>R$ 
<?php
$query_total_1002 = mysqli_query($con,"SELECT SUM(total) as soma FROM  `$tx_banco` WHERE `status` = '2'") or die(mysql_error());
while($array_1002 = mysqli_fetch_assoc($query_total_1002)){
	$linha_1002 = $array_1002["soma"];
	$linha_1002 =  number_format($linha_1002, 2, ',', '.');
	}

	if($linha_1002 <> "0,00") {

echo "<span class=\"blink\" >".$linha_1002." </span>" ;
}

else {echo $linha_1002;}
?>
</fieldset>
<a href="pedido_2.php?type=<?php echo $tx_tipo;?>" > <img src="images/pasta.jpg" /></a>
</fieldset>

<?php  } ?>


 <br />
	
</div>



</div>
<a href="atua_site.php"><div id="bt_atua">Atualizar</div></a>
<a href="location_new.php"><div id="location"></div></a>
<a href="lixeira.php"><div id="lix"></div></a>
<a href="lista_negra.php"><div id="lista_negra"></div></a>

</div>

</div>
<?php
$mensagem = "Nova visita no site";
salvaLog($con,$mensagem);
?>
<script type="text/javascript">
	$(function(){
		$("#stats").charts();
	})
</script>
</body>
</html>