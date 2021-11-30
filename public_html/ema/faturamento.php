<?php
session_start();
$cont = 0;
include "dire.php";
$senha = $_SESSION["codigo"];
$custonartigo = $_SESSION["custonprodutos"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Faturamento</title>
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
   <tr >
     <td colspan="6" align="center">Faturamento</td><td><a href="faturamento.php" target="_new">Imprimir</a></td>
   </tr>
   <tr bgcolor="#FF0000">
     <td>Artigo</td><td>Descrição</td><td>Quantidade Faturada</td><td>Total Faturado</td><td>Quantidade por tamanho</td><td>Data Emissão Nota Fiscal</td><td>Nº Nota Fiscal</td>
   </tr>
   
   <?php
   
 

$sql2 = mysql_select_db("adisul_adidas", $con);

$query2 = mysql_query("select * from faturamento WHERE `Codigo Cliente` = '$senha' ORDER BY `Data Emissao NF` DESC ") or die(mysql_error());

while($array2 = mysql_fetch_array($query2)){


$cod_Artigo  = $array2["Codigo Artigo"];
$desc_artigo  = $array2["Descricao do Artigo"];
$qtnd_faturada  = $array2["Qtde Faturada"];
$total_faturado  = $array2["Total Faturado"];
$qtnd_tamanho  = $array2["Qtde por Tamanho"];
$emiss_fiscal  = $array2["Data Emissao NF"];
$num_nota  = $array2["Docto No"];
$emiss_fiscal = date('d/m/Y', strtotime(str_replace("-", "/", $emiss_fiscal )));
if( $cont%2 == 0){
			$cor = "#FFFFFF";}
		else
			{$cor = "#CCCCCC";}

echo "

 <tr bgcolor=\"$cor\"  >
   <td>&nbsp;$cod_Artigo</td><td>&nbsp;$desc_artigo</td><td>$qtnd_faturada</td><td>$total_faturado</td><td>$qtnd_tamanho</td><td>$emiss_fiscal</td><td>$num_nota</td>
 </tr>";
  $cont++;
}
?>
 </table>
</div>
</body>
</html>