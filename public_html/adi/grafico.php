<?php
session_cache_limiter( 'nocache' );
session_start();
 include"conexao.php"; ?>﻿
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Relatório Gráfico</title>	
		<link href="demoPages.css" media="screen" rel="Stylesheet" type="text/css" />	
		<link type="text/css" rel="stylesheet" href="visualize.jQuery.css"/>
		<link type="text/css" rel="stylesheet" href="demopage.css"/>
		<script type="text/javascript" src="jquery.js">    </script>
		<!--[if IE]><script type="text/javascript" src="excanvas.compiled.js"></script><![endif]-->
		<script type="text/javascript" src="visualize.jQuery.js"></script>
		<script type="text/javascript" src="editabletable.js"></script>
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
	<script src="mint.js" type="text/javascript"></script>
</head>

<body>	



<p class="editableNote"><em>Relatório dinâmico</em></p>
</body>
</html>