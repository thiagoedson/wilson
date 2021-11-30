<?php
session_start();
include "conexao.php";
$chamar = $_GET["chamar"];
$chemar = $_GET["chemar"];


function excOrder($con) {
	
$p_pedido = $_GET["pedido"];
$p_tipo   = $_GET["tipo"];
$query_pedidos = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`loja_table` WHERE `tipo` = '$p_tipo'");        
		while($array_pedido = mysqli_fetch_assoc($query_pedidos)){			
			$table = $array_pedido["banco"];
			$table_2 = $array_pedido["banco_artigo"];
}

$delete_pedido = mysqli_query($con,"DELETE FROM `$table` WHERE npedido = '$p_pedido'");
$delete_artigos = mysqli_query($con,"DELETE FROM `$table_2`	WHERE npedido = '$p_pedido'");
$mensagem = "Exclui pedido numero $p_pedido ";
salvaLog($con,$mensagem);

}

function resOrder($con) {
	
$p_pedido = $_GET["pedido"];
$p_tipo   = $_GET["tipo"];
$query_pedidos = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`loja_table` WHERE `tipo` = '$p_tipo'");        
		while($array_pedido = mysqli_fetch_assoc($query_pedidos)){			
			$table = $array_pedido["banco"];
}
$atua_total_pedido = mysqli_query($con,"UPDATE `$table` SET `status` = '4'  WHERE  `npedido` = '$p_pedido'"); 
$mensagem = "Restaurar pedido numero $p_pedido ";
salvaLog($con,$mensagem);

}

#------------------------------------------------------------------------
if(isset($chamar)){
excOrder($con);
}

if(isset($chemar)){
resOrder($con);
}
#-------------------------------------------------------------------------

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="images/iso.png" rel="shortcut icon"  type="image/png"/>
<link href="images/iso.png" rel="apple-touch-icon" type="image/png"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="mint.js" type="text/javascript"></script>
<title>ADISUL- Controle Administrativo</title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<script type="text/javascript" src="jquery.js">    </script>
<link rel="STYLESHEET" type="text/css" href="codebase/skins/dhtmlxcalendar_dhx_skyblue.css">
<link rel="STYLESHEET" type="text/css" href="codebase/dhtmlxgrid.css">
<link rel="stylesheet" type="text/css" href="codebase/skins/dhtmlxgrid_dhx_skyblue.css">
<link rel="stylesheet" type="text/css" href="codebase/dhtmlxcalendar.css">
<script  src="codebase/dhtmlxcommon.js"></script>
<script  src="codebase/dhtmlxgrid.js"></script>
<script  src="codebase/dhtmlxgridcell.js"></script>
<script  src="codebase/ext/dhtmlxgrid_srnd.js"></script>
<script  src="codebase/excells/dhtmlxgrid_excell_link.js"></script>
<script  src="codebase/ext/dhtmlxgrid_filter.js"></script>    
<script  src="codebase/dhtmlxgridcell.js"></script>
<script  src="codebase/dhtmlxdataprocessor.js"></script>
<script  src="codebase/dhtmlxcalendar.js"></script>    
<script  src="codebase/excells/dhtmlxgrid_excell_dhxcalendar.js"></script>
<script language= 'javascript'>
<!--
function aviso(id){
if(confirm (' Deseja realmente excluir? '))
{
window.alert(' Continuando.. ');
location.href="excluirdoc2.php?id="+id;
}
else
{
return false;
}
}
//-->
</script>
<style type="text/css" media="all">
@import url("menu.css");
</style>
</head>

<body>

<div id="container">
<?php echo $menu_adi;?>
</div>
<div id="pedidos_excluidos">
<a href="limpa_lixeira.php" style="padding:10px;background-color:#F60;color:#FFF;margin:20px;">Esvaziar lixeira</a>
<div id="gridbox" style="width:100%; height:550px; background-color:white; margin-top:100px;"></div>
<script>
mygrid = new dhtmlXGridObject('gridbox');
mygrid.enableEditEvents(false);
mygrid.setImagePath("codebase/imgs/");
mygrid.setHeader("Razão Social,Nº Pedido,Download DP,Download PE,Tipo pedido,Total,Data,Status, Excluir, Restaurar, Último Acesso");
mygrid.attachHeader("#text_search,#text_search,&nbsp;,&nbsp;,#select_filter,&nbsp;,&nbsp;,#select_filter,&nbsp;,&nbsp;,&nbsp;");
mygrid.setInitWidths("300,100,100,100,150,100,100,200,100,100,*");
mygrid.enableAutoWidth(true);
mygrid.setColAlign("left,left,left,left,left,left,left,left,left");
mygrid.setColTypes("link,link,link,link,ed,price,dhxCalendar,txt,link,link,dhxCalendar");
mygrid.getCombo(5).put(2, 2);
mygrid.enableMultiselect(true);
mygrid.setDateFormat("%d-%m-%Y")
mygrid.setColSorting("str,str,str,str,str,date,str,str,str,str,date");
mygrid.setSkin("dhx_skyblue");
mygrid.init();
mygrid.enableSmartRendering(true);
gridQString = "grid/trash.php";//save query string to global variable (see step 5 for details)
mygrid.loadXML(gridQString);
</script>
</div>

  
<?php

$mensagem = "Pagina de Pedidos Excluidos";
salvaLog($con,$mensagem);

?>



</body>
</html>