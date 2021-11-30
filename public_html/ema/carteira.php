<?php
session_start();
$cont = 0;
include "dire.php";
$senha = $_SESSION["codigo"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Carteira</title>
<style type="text/css">
.pading {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 8pt;
	text-align:left;
	margin:0;
	padding:0;

}

body,html {
	padding:0;
	margin:0;}
	
#lista_pedido {
	padding:0;
	margin:0;}
</style>
</head>

<body>
<div id="lista_pedido">
<table width="100%" class="pading">
   <tr>
     <td colspan="6" align="center">Carteira</td><td><a href="carteira.php" target="_new">Imprimir</a></td>
   </tr>
   <tr bgcolor="#FF0000">
     <td>Artigo</td><td>Descrição</td><td>Quantidade</td><td>Total</td><td>Quantidade por tamanho</td><td>Entrega Revisada</td><td>Status</td>
   </tr>
   
   <?php
   
 

$sql2 = mysql_select_db("adidas", $con);

$query2 = mysql_query("select * from carteira WHERE `Codigo Cliente` = '$senha' ORDER BY `Data Entrega  Revisada`") or die(mysql_error());

while($array2 = mysql_fetch_array($query2)){

$categoria = $array2["Categoria"];
$cod_Artigo  = $array2["Codigo Artigo"];
$cliente_grupo  = $array2["Cliente"];
$desc_artigo  = $array2["Descricao Artigo"];
$qtnd_faturada  = $array2["Qtde Total a Faturar"];
$total_faturado  = $array2["Valor total a Faturar"];
$qtnd_tamanho  = $array2["Qtde por Tamanho"];
$entrega_revisada  = $array2["Data Entrega  Revisada"];
$status  = $array2["Status do pedido"];
$ccodigo_cliente= $array2["Codigo Cliente"];
$cidade = $array2["Cidade"];
#$entrega_revisada = date('d/m/Y', strtotime(str_replace("-", "/", $entrega_revisada )));


if( $status == "Confirmado"){
			$cor = "#00CC00";}
		else
			{$cor = "#CCCCCC";}

if (strstr($categoria, "Footwear")) {$categoria = "Calçado";}
if (strstr($categoria, "Apparel")) {$categoria = "Têxtil";}
if (strstr($categoria, "Hardware")) {$categoria = "Equip";}


echo "

 <tr bgcolor=\"$cor\"  >
   <td>&nbsp;$cod_Artigo</td><td>&nbsp;$desc_artigo</td><td>$qtnd_faturada</td><td>$total_faturado</td><td>$qtnd_tamanho</td><td>$entrega_revisada</td><td>$status</td>
 </tr>";
 $cont++;

}
?>
 </table>
</div>
</body>
</html>