<?php 
session_start();
include "conexao.php";
if($userx == "adisul_ema")          {$xxxend = "http://www.adisul.net/ema";}
elseif($userx == "adisul_adidas")   {$xxxend = "http://www.adisul.net/mau";}
elseif($userx == "adisul_eifer")    {$xxxend = "http://www.adisul.net/eifer";}
elseif($userx == "adisul_betaluc")  {$xxxend = "http://www.adisul.net/betaluc";}
elseif($userx == "adisul_durrer")   {$xxxend = "http://www.adisul.net/durrer";}
elseif($userx == "adisul_paschoal") {$xxxend = "http://www.adisul.net/paschoal";}
elseif($userx == "adisul_jl3")      {$xxxend = "http://www.adisul.net/jl3";}
elseif($userx == "adisul_moa")      {$xxxend = "http://www.adisul.net/moa";}
elseif($userx == "adisul_schuma")   {$xxxend = "http://www.adisul.net/schuma";}
$sul = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADISUL- Controle Administrativo</title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<style type="text/css">
#p_painel {
	position:absolute;
	left:0;
	top:50px;
	width:860px;
	height:auto;
	background-color: #CCCCCC;
	padding: 20px;
}
* {
	margin: 0px;
	padding: 0px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 8pt;
}
#container {
	position:relative;
	margin:auto;
	width:900px;}
body {
	background-color:#000;}
</style>
<link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
<style type="text/css" media="all">
@import url("menu.css");
#bt_atua {
	position:absolute;
	left:592px;
	top:107px;
	width:82px;
	height:22px;
	background-image: url(images/bt.png);
	-webkit-transition-duration: 1s;
	-moz-transition-duration: 1s;
	-o-transition-duration: 1s;
	transition-duration: 1s;
}

#bt_atua:hover {
	-webkit-transform:scale(1.2) skew(1deg); /* prefixo para browsers webkit */
	-moz-transform:scale(1.2) skew(1deg); /* prefixo para browsers gecko */
	-o-transform:scale(1.2) skew(1deg); /* prefixo para opera */
	transform:scale(1.2) skew(1deg);
	opacity:0.65;
	-moz-opacity: 0.65;
	filter: alpha(opacity=65);}
</style>
</head>
<body>
<div id="faixa"></div>
<div id="container">
<?php echo $menu_adi;?>
<div id="p_artigos">
<?php
$tipo = $_GET["tipo"];

$npedido = $_GET["npedido"];
$p_pedido = $_GET["npedido"];

if($tipo == "DISPO")         {$tipo = "lista_artigo_pedido";          $voltar = "pedido.php?type=DISPO";    $banco = "pedido"; }
elseif($tipo == "CLE")  {$tipo = "lista_artigo_pedido_cle";           $voltar = "pedido.php?type=CLE";      $banco = "pedido_cle";     $sul = 1;}
elseif($tipo == "CLE1") {$tipo = "lista_artigo_pedido_cle_1";         $voltar = "pedido.php?type=CLE1";     $banco = "pedido_cle_1";   $sul = 1;}
elseif($tipo == "SS12")      {$tipo = "lista_artigo_pedido_ss12";     $voltar = "pedido.php?type=SS12";     $banco = "pedido_ss12";    $sul = 1; $tpl = $xxxend."/motor_xls_adisul.php?npedido=$npedido&var=DISPO2012";}
elseif($tipo == "FW12")      {$tipo = "lista_artigo_pedido_fw12";     $voltar = "pedido.php?type=FW12";     $banco = "prevendafw12";   $sul = 1; $tpl = $xxxend."/motor_xls_adisul.php?npedido=$npedido&var=FW12";}
elseif($tipo == "CLE2012")   {$tipo = "lista_artigo_pedido_cle2012";  $voltar = "pedido.php?type=CLE2012";  $banco = "pedido_cle2012"; $sul = 1; $tpl = $xxxend."/motor_xls_adisul.php?npedido=$npedido&var=CLE2012";}
elseif($tipo == "CLE12012")  {$tipo = "lista_artigo_pedido_cle_12012";$voltar = "pedido.php?type=CLE12012"; $banco = "pedido_cle_12012";$sul = 1; $tpl = $xxxend."/motor_xls_adisul.php?npedido=$npedido&var=CLE12012";}

?>
<a href="<?php echo $voltar; ?>"><input type="submit" value="Voltar" style="padding:5px;" /></a> <a href="<?php echo $tpl; ?>"><input type="submit" value="Download em XLS" style="padding:5px;" /></a><br /><br />
Pedido Numero <?php echo $npedido;?><br />
<br />
<br />

<table class="car_table" width="100%"> 
<thead> 
  <tr>
    <th></th><th>Artigo</th><th>Descrição</th><th>Quantidade</th><th>Segmentação</th><th>Valor Unitário</th><th>Valor Total</th><th>Data</th><th></th></tr>
</thead>
<tbody>
<?php
$tora = 0;
$query_pedido_aberto = mysqli_query($con,"SELECT DISTINCT artigo, data FROM  $tipo  WHERE npedido = '$npedido'") or die(mysql_error());	
	$lin = mysqli_num_rows($query_pedido_aberto);
    if($lin==0) // verifica se retornou algum registro
    {
		$atua_total_pedido_zero = mysqli_query($con,"UPDATE $banco SET `total` = '$zero'  WHERE  `npedido` = '$p_pedido'"); 
    echo "<center class=\"car_vazio\">Carrinho Vazio</center>";     }	
    while($array_pedido_aberto = mysqli_fetch_assoc($query_pedido_aberto)){		
    $sqlpedido_artigo      = $array_pedido_aberto["artigo"];
    $sqlpedido_data        = $array_pedido_aberto["data"];
	$sqlpedido_datax       = $array_pedido_aberto["data"];
#------conta a quantidade de produtos------------------------
$query_total = mysqli_query($con,"SELECT SUM(quantidade) as soma FROM  $tipo  WHERE `artigo` = '$sqlpedido_artigo' AND `npedido` = '$p_pedido' AND `data` = '$sqlpedido_data'") or die(mysql_error());
while($linha_array = mysqli_fetch_assoc($query_total)){$linha = $linha_array["soma"];}
#------------------------------------------------------------
#----------------------Soma Pedido---------------------------
$query_total_pe = mysqli_query($con,"SELECT SUM(total) as soma FROM  $tipo  WHERE  `npedido` = '$p_pedido'") or die(mysql_error());
while($linha_array_pe = mysqli_fetch_assoc($query_total_pe)){$linha_pe = $linha_array_pe["soma"];}
#------------------------------------------------------------
#----------------------Recolhendo Informações-----------------
$query_total_info = mysqli_query($con,"SELECT * FROM  $tipo  WHERE  `npedido` = '$p_pedido' AND `artigo` = '$sqlpedido_artigo'") or die(mysql_error());
while($linha_array_info = mysqli_fetch_assoc($query_total_info)){$info_valor_unite = $linha_array_info["valor"];$info_descricao_unite = $linha_array_info["descricao"];$info_segmento_unite = $linha_array_info["segmento"];$sqlpedido_total = $linha_array_info["valor"];}
#------------------------------------------------------------
#-----------Tratanto valores e fazendo conta -------------------  	
	$sqlpedido_data    = date('d/m/Y', strtotime(str_replace("-", "/", $sqlpedido_data )));
	$info_valor_unitex = number_format($info_valor_unite, 2, ',', '.');
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
	echo "<tr><td><img src=\"http://www.adisul.com/thumb/".$sqlpedido_artigo."_F.jpg\" width=\"60px\" style=\"background:none;\" /></td><td>$sqlpedido_artigo</td><td>$info_descricao_unite</td><td>$linha</td><td>$info_segmento_unite</td><td>R$ $info_valor_unite</td><td>R$ $total_item</td><td>$sqlpedido_data</td><td>-</td></tr>";	
	}
$atua_total_pedido = mysqli_query($con,"UPDATE $banco SET `total` = '$total_pedido'  WHERE  `npedido` = '$p_pedido'"); 
?>
</tbody>
</table>
</div>
</div>
</body>
</html>