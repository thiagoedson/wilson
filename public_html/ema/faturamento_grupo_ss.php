<?php
session_start();
include"dire.php";
$senha = $_SESSION["codigo"];

$query_1 = mysql_query("SELECT `nome`,`status` FROM login WHERE `B` = '$senha'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_1 = mysql_fetch_array($query_1)){	
	
	$grupo = $array_1["nome"];
	$status = $array_1["status"];
};
if($status == "3") {echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=fail_2.html'>"; exit;}
if($status == "2") {echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=fail_2.html'>"; exit;}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FATURAMENTO GRUPO</title>
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
<script type='text/javascript' src='x_core.js'></script> 
<script type='text/javascript'> 
 
function muestra_imagen(archivo,ancho,alto){
	//xInnerHtml('c1','')
	xWidth ('ampliacion',ancho + 10)
	xHeight ('ampliacion',alto + 10 + 30)
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

<body>
<div id="ampliacion" style="padding:2 2 2 2px; position:fixed; left:300px; top:150px;   visibility: hidden; border: 1px solid #666666; background-image: url(images/cargando.gif); background-repeat: no-repeat;"> 
<a href="javascript:cerrar_ampliacion()" style="color:#000000; margin-left:250px;"><img src="img/fechar.jpg" /></a> 
<div id="c1"> 
 
</div> 
<div id="cerrarampliacion" style="background-color:333333; font-family:arial,verdana; font-size:8pt; line-height:20px; text-align:right;float:right; height: 20px; padding-right:5px;"> 

</div> 
</div> 
<div id="lista_pedido">
<table width="100%" class="pading">
   <tr>
     <td colspan="10" align="center">Carteira do Grupo <?php echo $grupo; ?></td>
   </tr>
   <tr bgcolor="#FF0000">
     <td>C??d</td>
     <td>Cliente</td>
     <td>Cidade</td>
     <td>Cole????o</td>
     <td>Artigo</td>
     <td>Descri????o</td>
     <td>Qt</td>
     <td>Total</td>
     <td>Quantidade por tamanho</td>
     <td>Data Emissao NF</td>
     <td>N?? Pedido</td>
   </tr>
   
   <?php
   
 

$sql2 = mysql_select_db("adidas", $con);

$query2 = mysql_query("SELECT * FROM `faturamento` INNER JOIN `login` ON `faturamento`.`Codigo Cliente` = `login`.`B` WHERE `login`.`nome` = '$grupo' ORDER BY `Data Emissao NF` DESC ") or die(mysql_error());

while($array2 = mysql_fetch_array($query2)){

$colecao			 = $array2["Order Type"];
$cod_Artigo 		 = $array2["Codigo Artigo"];
$cliente_grupo 		 = $array2["Nome do Cliente"];
$desc_artigo 		 = $array2["Descricao do Artigo"];
$qtnd_faturada 		 = $array2["Qtde Faturada"];
$total_faturado 	 = $array2["Total Faturado"];
$qtnd_tamanho 		 = $array2["Qtde por Tamanho"];
$entrega_revisada 	 = $array2["Data Emissao NF"];
$codigo_cliente  	 = $array2["Codigo Cliente"];
$cidade 			 = $array2["Cidade"];
$n_pedido_ca		 = $array2["Numero Pedido"];
$entrega_revisada 	 = date('d/m/Y', strtotime(str_replace("-", "/", $entrega_revisada )));


if( $status == "Confirmado"){
			$cor = "#00CC00";}
		else
			{$cor = "#CCCCCC";}

if (strstr($categoria, "Footwear")) {$categoria = "Cal??ado";}
if (strstr($categoria, "Apparel")) {$categoria = "T??xtil";}
if (strstr($categoria, "Hardware")) {$categoria = "Equip";}


if (strstr($qtnd_tamanho, "Footwear")) {$qtnd_tamanho= "Cal??ado";}
if (strstr($qtnd_tamanho, "Apparel")) {$categoria = "T??xtil";}
if (strstr($qtnd_tamanho, "Hardware")) {$categoria = "Equip";}

echo "

 <tr bgcolor=\"$cor\"  >
   <td>$codigo_cliente</td>
   <td>$cliente_grupo</td>
   <td>$cidade</td>
   <td>$colecao</td>
   <td><a href=\"javascript:muestra_imagen('http://adisul.net/demandimage/thumb/".$cod_Artigo."_F.jpg',300,210)\">$cod_Artigo Ver foto</a></td>
   <td>$desc_artigo</td>
   <td>$qtnd_faturada</td>
   <td>R$ $total_faturado</td>
   <td>$qtnd_tamanho</td>
   <td>$entrega_revisada</td>
   <td>$n_pedido_ca</td>
 </tr>";
 $cont++;

}
?>
</table>

</div>
</body>
</html>