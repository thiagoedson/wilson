<?php
session_cache_limiter( 'nocache' );
session_start();
include"conexao.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<link href="images/iso.png" rel="shortcut icon"  type="image/png"/>
<link href="images/iso.png" rel="apple-touch-icon" type="image/png"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="visualize.jQuery.css"/>
<script type="text/javascript" src="visualize.jQuery.js"></script>
<script src="mint.js" type="text/javascript"></script>
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


.efeito {
	text-decoration:blink;
	}
</style>
<script type="text/javascript" src="jquery.js">    </script>
<script src="jquery-blink.js" language="javscript" type="text/javascript"></script>
 
<script type="text/javascript" language="javascript">
 
$(document).ready(function()
{
        $('.blink').blink(); // default is 500ms blink interval.
        //$('.blink').blink({delay:100}); // causes a 100ms blink interval.
});
 
</script>

<link type="text/css" href="menu.css" rel="stylesheet" />

<script type="text/javascript" src="menu.js"></script>
<style type="text/css" media="all">
@import url("menu.css");
</style>
<script type="text/javascript">
			$(function(){
				//make some charts
				// mais detalhes em http://www.filamentgroup.com/lab/jquery_visualize_plugin_accessible_charts_graphs_from_tables_html5_canvas/
				//$('table').visualize({type: 'pie', pieMargin: 10, title: 'asdqwe'});	
				//$('table').visualize({type: 'line'});
				//$('table').visualize({type: 'area'});
				$('table').visualize();
			});
		</script>

</head>
<body>
<div id="faixa"></div>
<div id="container">
<?php echo $menu_adi;?>
<div id="campo33">
  <iframe src="grafico.php" border="0" frameborder="0" width="100%" height="100%" scrolling="no">

</iframe>
</div>
</div>
<?php
$mensagem = "Nova visita no site";
salvaLog($con,$mensagem);
?>
<script type="text/javascript">
	$(function(){
		$("#stats").charts();
	})
</script>
</body>
</html>