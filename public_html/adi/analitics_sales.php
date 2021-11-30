<?php
session_cache_limiter( 'nocache' );
session_start();
include"conexao.php";
$tipo = $_GET["tipo"];
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
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<!--<script type="text/javascript" src="menu.js"></script>-->
<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs a").click(function() {
			$(this).parent().siblings().removeClass('active').end().addClass('active');
			$(this).parents('ul').next().children().hide().eq( $(this).parent().index() ).show();
		});
	});
</script>
<script type="text/javascript" src="menu.js"></script><strong></strong>
<title>ADISUL- Controle Administrativo</title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<link type="text/css" href="menu.css" rel="stylesheet" />
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

#container {
	position:relative;
	margin:auto;
	width:900px;}



.efeito {
	text-decoration:blink;
	}
</style>

<style type="text/css" media="all">
@import url("menu.css");
#location {
	position: absolute;
	left: 561px;
	top: 249px;
	width: 148px;
	height: 111px;
	background-color: #FFFFFF;
	
	background-image: url(images/logo_location.jpg);
}

#lix {
	position: absolute;
	left: 561px;
	top: 400px;
	width: 148px;
	height: 111px;
	background-color: #FFFFFF;
	
	background-image: url(images/logo_pedidos.jpg);
}
#lista_negra {
	position: absolute;
	left: 561px;
	top: 100px;
	width: 148px;
	height: 111px;
	background-color: #FFFFFF;
	background-image: url(images/logo_negra.jpg);
}

#fundo_white {
	background-color:#FFF;
	margin-top:100px;
	height:auto;
	display:block;}
</style>
</head>
<body>


<div id="container">
<?php echo $menu_adi;?>
<div id="fundo_white">

<ul class="tabs vinte">
  <li  class="active"><a href="#">Estoque</a>     </li>
  <li>				  <a href="#">Venda</a>       </li>
  <li>				  <a href="#">Orgânico</a>    </li>
  <li>			      <a href="#">Avançado</a>    </li>

</ul>
<div class="tab_container">

<div class="fin">
  
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawVisualization);

function drawVisualization() {
  // Some raw data (not necessarily accurate)
  var data = google.visualization.arrayToDataTable([
    ['Month', 'Calçado', 'Têxtil', 'Equipamento' ],
	
	<?php
	$query_total_dispo = mysqli_query($con,"SELECT * FROM `$banco`.`total_divisao_cron_pedido` WHERE `tipo` = '$tipo' ORDER BY `data` DESC LIMIT 5 ") or die (mysql_error());
     while($array_pedido_sabe = mysqli_fetch_assoc($query_total_dispo)){		
	 $total_pedido_x       = $array_pedido_sabe["apparel"];
	 $total_pedido_y       = $array_pedido_sabe["footwear"];
	 $total_pedido_z       = $array_pedido_sabe["hardware"];
	 $data_rel 			   = $array_pedido_sabe["data"];
	 
	 $total_pedido_x = round($total_pedido_x, 2);
	 $total_pedido_y = round($total_pedido_y, 2);
	 $total_pedido_z = round($total_pedido_z, 2);
	 
	 $total_promo_x          =  number_format($total_pedido_x, 2, ',', '.');
	 $total_promo_y          =  number_format($total_pedido_y, 2, ',', '.');
	 $total_promo_z          =  number_format($total_pedido_z, 2, ',', '.');
	 
	 $data_rel = date('d/m/Y', strtotime(str_replace("-", "/", $data_rel )));
	 
	 echo "['$data_rel',  $total_pedido_y,      $total_pedido_x,         $total_pedido_z],\n";
	 }
	 ?>

  ]);

  var options = {
    title : 'Total de Venda por Divisao <?php echo $tipo;?>',
    vAxis: {title: "Cups"},
    hAxis: {title: "Semana"},
    seriesType: "bars",
    series: {5: {type: "line"}}
  };

  var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
  chart.draw(data, options);
}
    </script>
     <div id="chart_div" style="width: 700px; height: 400px;"></div>


</div>

<div class="fin" style="display:none"></div>
<div class="fin" style="display:none"></div>
<div class="fin" style="display:none"></div>

</div>


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