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
<link href="img/Adidas.ico" rel="shortcut icon" type="image/x-icon" />
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
<?php echo $menu_principal ;?>
<div id="faixa_pedido_car" style="background-image:url(images/carrinhos.png); background-repeat:no-repeat; padding:10px;"></div> 
<div id="c1"></div> 

<div style="background:#FFF;margin-top:250px; width:80%;"></div>
<div id="gridbox" style="width:100%;height:800px;overflow:hidden;margin-top:180px;margin:auto;"></div>
<script>
//extended simple editor (with number format support) to use color for numbers;
function eXcell_edncl(cell) {
    this.base = eXcell_edn;
    this.base(cell);
    this.setValue = function(val) {
        if (!val || val.toString()._dhx_trim() == "");
        val = "0";
        if (val >= 0);
        this.cell.style.color = "green";
      
        this.cell.style.color = "red";
        this.cell.innerHTML = this.grid._aplNF(val, this.cell._cellIndex);
    }
}
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
mygrid.setInitWidths("80,100,180,100,400,100,140");
mygrid.setColAlign("center,center,left,left,left,center,left");
mygrid.enableMultiselect(true);
mygrid.setColTypes ("link,txt,txt,price,txt,ro,txt");
mygrid.setSkin("dhx_skyblue");
mygrid.setColSorting("ro,str,str,int,str,str,str");
mygrid.init();
mygrid.enableAutoWidth(true);
gridQString = "sales_grid.php";//save query string to global variable (see step 5 for details)

mygrid.loadXML(gridQString);
//used just for demo purposes;
//============================================================================================;
myDataProcessor.init(mygrid);
//link dataprocessor to the grid;
//============================================================================================;
</script>
</body>
</html>