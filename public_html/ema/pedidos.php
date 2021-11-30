<?php
session_start();
include "dire.php";
$senha = $_SESSION["codigo"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $titulo;?></title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="menu.js"></script>
<script  src="codebase/dhtmlxcommon.js"></script>
<script  src="codebase/dhtmlxgrid.js"></script>        
<script  src="codebase/dhtmlxgridcell.js"></script>
<script  src="codebase/dhtmlxdataprocessor.js"></script>
<script  src="codebase/dhtmlxcalendar.js"></script>    
<script  src="codebase/excells/dhtmlxgrid_excell_dhxcalendar.js"></script>
<script  src="codebase/excells/dhtmlxgrid_excell_link.js"></script>
<script  src="codebase/dhtmlxgrid_export.js"></script>
<link rel="STYLESHEET" type="text/css" href="codebase/skins/dhtmlxcalendar_dhx_skyblue.css">
<link rel="STYLESHEET" type="text/css" href="codebase/dhtmlxgrid.css">
<link rel="stylesheet" type="text/css" href="codebase/skins/dhtmlxgrid_dhx_skyblue.css">
<link rel="stylesheet" type="text/css" href="codebase/dhtmlxcalendar.css">


<style type="text/css" media="all">
@import url("estilo.css");

}
</style>
</head>
<body >
<?php 
include"../adisul_prt1.php";
	   echo $menu_principal; 
	   ?>
<div id="faixa_pedido_car" style="background-image:url(images/carrinhos.png); background-repeat:no-repeat; padding:10px;"></div> 
<div id="c1"></div> 

<div style="background:#FFF;margin-top:250px; width:80%;"></div>
<div id="gridbox" style="width:1018px;height:800px;overflow:hidden;margin-top:180px;margin:auto;"></div>
<script>
//extended simple editor (with number format support) to use color for numbers;

eXcell_edncl.prototype = new eXcell_edn;
//extended simple editor (with number format support) to be readonly;
function eXcell_ednro(cell) {
    this.base = eXcell_edn;
    this.base(cell);
    this.isDisabled = function() {
        return true;
    }
    this.edit = function() {
        return false;
    }
    this.detach = function() {
        return false;
    }
}
eXcell_ednro.prototype = new eXcell_edn;
</script> 
<script>
//init grid and set its parameters (this part as always);
mygrid = new dhtmlXGridObject('gridbox');
mygrid.enableEditEvents(false);
mygrid.setImagePath("codebase/imgs/");
mygrid.setHeader("Download,Nº Pedido,Tipo de Pedido,Total,Loja,Data do Pedido,Status");
mygrid.setInitWidths("80,100,180,100,*,100,140");
mygrid.setColAlign("center,center,left,left,left,center,left");
mygrid.enableMultiselect(true);
mygrid.setColTypes ("link,txt,txt,price,txt,dhxCalendar,txt");
mygrid.setSkin("dhx_skyblue");
mygrid.setDateFormat("%d-%m-%Y")
mygrid.setColSorting("ro,ro,ro,ro,ro,date,ro");
mygrid.init();
mygrid.enableAutoWidth(true);
gridQString = "sales_grid.php";//save query string to global variable (see step 5 for details)

mygrid.loadXML(gridQString);
//used just for demo purposes;
//============================================================================================;

</script>
</body>
</html>