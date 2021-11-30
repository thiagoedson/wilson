<?php
session_start();
include "dire.php";
$senha = $_SESSION["codigo"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>adisul.com</title>
<link href="img/Adidas.ico" rel="shortcut icon" type="image/x-icon" />
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="menu.js"></script>
<style type="text/css" media="all">
@import url("estilo.css");

a { text-decoration:none;
}
a:hover {
	color:#F00;
	}
a:visited {
	color:#00F;}
	
tr:hover {
	background-color:#CFF;}

</style>
<script type='text/javascript' src='x_core.js'></script> 
<script type='text/javascript'> 
 
function muestra_imagen(archivo,ancho,alto){
	//xInnerHtml('c1','')
	xWidth ('ampliacion',ancho + 5)
	xHeight ('ampliacion',alto + 15 + 5)
	xWidth ('c1',ancho)
	xHeight ('c1',alto)
	xWidth ('cerrarampliacion',ancho)
	
	
	xInnerHtml('c1','<img src="' + archivo + '" width="' + ancho + '" height="' + alto + '" border="0">')	
	xShow('ampliacion');
}
 
function cerrar_ampliacion(){
	xHide('ampliacion');
	
}
 
window.onload = function(){
 
}
 
</script>
</head>
<body >
<?php 
include"../adisul_prt1.php";
	   echo $menu_principal; 
?>

</div>
 
<div id="rela">
<table width="100%" class="pading">
   <tr>
     <td height="30px" colspan="6" bgcolor="#CF9" align="center">Carteira da loja <?php echo $nome_cliente?> | <?php echo $senha ;?> Data da Carteira <?php echo $carteira; ?></td>
     <td width="58" colspan="6" align="center" bgcolor="#FFFFFF"><a href="xls/gera_carteira_loja_ss.php" ><img src="images/excel.jpg" width="130" height="30" alt="Download Excel" longdesc="Download Excel" /></a></td>
   </tr>
   <tr bgcolor="#FFFF99">
     <td width="110px">Divisão</td>
     <td width="110px">Artigo</td>
     <td width="10">Coleção</td>
     <td>Descrição</td>
     <td width="27">Qt</td>
     <td>Total</td>
     <td width="288">Quantidade por tamanho</td>
     <td>Entrega Revisada</td>
     <td>Nº Pedido</td>
     <td>OBS</td>
     <td>Status</td>
     <td>Status Credito</td>
   </tr>
   
   <?php

$sql2 = mysql_select_db("$banco", $con);

$query2 = mysql_query("SELECT * FROM `carteira` WHERE `Codigo Cliente` = '$senha' AND `Data Entrega  Revisada` BETWEEN '2011-01-01' AND '2015-12-30' ORDER BY `Data Entrega  Revisada`, `Categoria`") or die(mysql_error());

while($array2 = mysql_fetch_array($query2)){

$categoria         = $array2["Categoria"];
$cod_Artigo        = $array2["Codigo Artigo"];
$cliente_grupo     = $array2["Cliente"];
$order_type        = $array2["Order Type"];
$desc_artigo       = $array2["Descricao Artigo"];
$qtnd_faturada     = $array2["Qtde Total a Faturar"];
$total_faturado    = $array2["Valor total a Faturar"];
$qtnd_tamanho      = $array2["Qtde por Tamanho"];
$entrega_revisada  = $array2["Data Entrega  Revisada"];
$status            = $array2["Status do pedido"];
$status_credito    = $array2["Status"];
$n_pedido_ca       = $array2["Numero do Pedido"];
$ccodigo_cliente   = $array2["Codigo Cliente"];
$cidade            = $array2["Cidade"];
$obs               = $array2["Observacao do Pedido"];

$entrega_revisada  = date('d/m/Y', strtotime(str_replace("-", "/", $entrega_revisada )));


if( $status == "Confirmado"){
			 $cor = "#CF9";}
		else
			{$cor = "#FFFFFF";}

if (strstr($categoria, "Footwear")) {$categoria = "Calçado";}
if (strstr($categoria, "Apparel"))  {$categoria = "Têxtil";}
if (strstr($categoria, "Hardware")) {$categoria = "Equip";}

$total_faturado = str_replace(",", ".", $total_faturado);
$total_faturado =  number_format($total_faturado, 2, ',', '.');
$total_faturado = "R$ $total_faturado";

echo "
 <tr bgcolor=\"$cor\"  >
   <td>$categoria</td>
   <td><a href=\"javascript:muestra_imagen('http://adisul.net/demandimage/thumb/".$cod_Artigo."_F.jpg',300,210)\">$cod_Artigo Ver foto</a></td>
   <td>$order_type</td>
   <td>$desc_artigo</td>
   <td>$qtnd_faturada</td>
   <td>$total_faturado</td>
   <td>$qtnd_tamanho</td>
   <td>$entrega_revisada</td>
   <td>$n_pedido_ca</td>
   <td>$obs</td>
   <td>$status</td>
   <td>$status_credito</td>
 </tr>";

}
?>
 </table>
 <div id="ampliacion"  style="padding:2 2 2 2px; position:fixed; left:300px; top:150px; width:50px;   visibility: hidden; border: 1px solid #666666; background-image: url(images/cargando.gif); background-repeat: no-repeat;"> 
<a href="javascript:cerrar_ampliacion()" style="color:#000000; margin-left:250px;"><img src="img/fechar.jpg" /></a> 
<div id="c1"> 
 
</div> 
<div id="cerrarampliacion" style="background-color:333333; font-family:arial,verdana; font-size:8pt; line-height:20px; text-align:right;float:right; height: 20px; padding-right:5px;"> 

</div> 
</div>
</div>
</body>
</html>