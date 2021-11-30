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

tr:hover {
	background-color:#CFF;}
</style>
</head>
<body >
<?php 
include"../adisul_prt1.php";
	   echo $menu_principal; 
?>
</div>

<div id="rela">
<table width="100%" class="pading">
   <tr >
     <td colspan="7" bgcolor="#FFFFFF" align="center" style="padding:10px;">Faturamento da loja <?php echo $nome_cliente?> Data do Faturamento <?php echo $faturamento; ?></td>
     <td bgcolor="#FFFFFF" align="center"><a href="faturamento.php" target="_new" >Imprimir</a></td>
   </tr>
   <tr bgcolor="#FF0000">
     <td>Artigo</td>
     <td>Descrição</td>
     <td>Quantidade Faturada</td>
     <td>Total Faturado</td>
     <td>Quantidade por tamanho</td>
     <td>Data Emissão Nota Fiscal</td>
     <td>Nº Nota Fiscal</td>
     <td>OBS</td>
   </tr>
   
   <?php
   
 

$sql2 = mysql_select_db("adidas", $con);

$query2 = mysql_query("select * from faturamento WHERE `Codigo Cliente` = '$senha' ORDER BY `Data Emissao NF` DESC ") or die(mysql_error());

while($array2 = mysql_fetch_array($query2)){


$cod_Artigo      = $array2["Codigo Artigo"];
$desc_artigo     = $array2["Descricao do Artigo"];
$qtnd_faturada   = $array2["Qtde Faturada"];
$total_faturado  = $array2["Total Faturado"];
$qtnd_tamanho    = $array2["Qtde por Tamanho"];
$emiss_fiscal    = $array2["Data Emissao NF"];
$num_nota        = $array2["Docto No"];
$obs             = $array2["Observacao do Pedido"];
$emiss_fiscal = date('d/m/Y', strtotime(str_replace("-", "/", $emiss_fiscal )));
if( $cont%2 == 0){
			$cor = "#FFFFFF";}
		else
			{$cor = "#CCCCCC";}
			
$total_faturado = str_replace(",", ".", $total_faturado);
$total_faturado =  number_format($total_faturado, 2, ',', '.');
$total_faturado = "R$ $total_faturado";

echo "

 <tr bgcolor=\"$cor\"  >
   <td>$cod_Artigo</td>
   <td>$desc_artigo</td>
   <td>$qtnd_faturada</td>
   <td>$total_faturado</td>
   <td>$qtnd_tamanho</td>
   <td>$emiss_fiscal</td>
   <td>$num_nota</td>  
   <td>$obs</td>
 </tr>";
  $cont++;
}
?>
 </table>
</div>
</body>
</html>