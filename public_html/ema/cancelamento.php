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
     <td colspan="5" bgcolor="#CF9" align="center">Cancelamentos <?php echo $nome_cliente?> Data do Relatório de Cancelamento <?php echo $cancelamento; ?></td>
     <td align="center" bgcolor="#FFFFFF" colspan="2"><a href="xls/gera_cancelamento_loja.php" ><img src="images/excel.jpg" width="130" height="30" alt="Download Excel" longdesc="Download Excel" /></a></td>
   </tr>
   <tr bgcolor="#FF9900">
     <td width="82">Artigo</td>
     <td width="353">Descrição</td>
     <td width="25">Qt</td>
     <td width="57">Grade</td>
     <td width="80">Data do Cancelamento</td>
     <td width="87">Entrega Revisada</td>
     <td width="165">Motivo</td>
   </tr>   
   <?php
$sql2 = mysql_select_db("$banco", $con);

$date_atual = date("Y-m-d");
$date_6mes  = date('Y-m-d',strtotime("-6 MONTH"));


$query2 = mysql_query("SELECT * FROM cancelamento WHERE `Codigo Cliente` = '$senha' AND `Data de  Cancelamento` BETWEEN '$date_6mes' AND '$date_atual' ORDER BY `Data de  Cancelamento` DESC ") or die(mysql_error());

while($array2 = mysql_fetch_array($query2)){


$cod_Artigo         = $array2["Codigo Artigo"];
$desc_artigo        = $array2["Descricao do Artigo"];
$qtnd_tamanho       = $array2["Qtde  Cancelada"];
$entrega_revisada   = $array2["Data de Entrega"];
$data_cancelamento  = $array2["Data de  Cancelamento"];
$status             = $array2["Razao"];
$grade              = $array2["Grade"];
$entrega_revisada   = date('d/m/Y', strtotime(str_replace("-", "/", $entrega_revisada )));
$data_cancelamento  = date('d/m/Y', strtotime(str_replace("-", "/", $data_cancelamento  )));
if( $status == "Confirmado"){
		$cor = "#00CC00";}
		else
			{$cor = "#CCCCCC";}
if (strstr($categoria, "Footwear")) {$categoria = "Calçado";}
if (strstr($categoria, "Apparel"))  {$categoria = "Têxtil";}
if (strstr($categoria, "Hardware")) {$categoria = "Equip";}

echo "

 <tr bgcolor=\"$cor\"  >
   <td><a href=\"javascript:muestra_imagen('http://adisul.net/demandimage/thumb/".$cod_Artigo."_F.jpg',300,200)\">$cod_Artigo Ver foto</a></td>
   <td>$desc_artigo</td>
   <td>$qtnd_tamanho</td>
   <td>$grade</td>
   <td>$data_cancelamento</td>
   <td>$entrega_revisada</td>
   <td>$status</td>
 </tr>";
 $cont++;

}
?>
 </table>
 
<div id="ampliacion"  style="padding:2 2 2 2px; position:fixed; left:300px; top:150px; width:50px;   visibility: hidden; border: 1px solid #666666; background-image: url(images/cargando.gif); background-repeat: no-repeat;"> 
<div id="c1"> 
 
</div> 
<div id="cerrarampliacion" style="background-color:333333; font-family:arial,verdana; font-size:8pt; line-height:20px; text-align:right;float:right; height: 20px; padding-right:5px;"> 
<a href="javascript:cerrar_ampliacion()" style="color:#ffffff;">[X] FECHAR</a> 
</div> 
</div> 
</div>
</body>
</html>