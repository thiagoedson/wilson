<?php
session_start();
include'conexao.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADISUL- Controle Administrativo</title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<style type="text/css">
#p_painel {
	position:absolute;
	left:0;
	top:78px;
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
</style>
<link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
<style type="text/css" media="all">
@import url("menu.css");
#bt_atua {
	position:absolute;
	left:592px;
	top:107px;
	width:168px;
	height:79px;
	background-color: #FFFF00;
}
#pesquisa {
	position:absolute;
	left:200px;
	top:45px;
	width:350px;
	height:24px;
	background-color: #FFFFFF;
	text-align: center;
	vertical-align: middle;
	padding-top: 6px;
}

.span {
	float:left;
	display:block;
	width:120px;
	height:120px;
	padding:10px;
	background-color:#FFF;
	margin:5px;
	border-radius:8px;
	
	
	}
.nome {
	font-size:8pt;!importat
	}
	
.numero {
	position:absolute;
	margin-left:100px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:20pt;
	padding:5px 5px 0 5px;	
	background:#090;
	color:#FFF;
	border-radius:8px;}
</style>
</head>
<body>
<div id="faixa"></div>
<div id="container">
<?php echo $menu_adi;?>
<div id="campo_novo_3">
<table background="white">
  <tr>
    <td>Cliente</td><td>Latitude</td><td>Longitude</td><td>Data e Hora</td>
  </tr>
<?php


$query_site2 = mysqli_query($con,"SELECT * FROM `location_user` ORDER BY `data` DESC LIMIT 35") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site2 = mysqli_fetch_assoc($query_site2)){	
	$rela_cliente   = $array_site2["codigo"];
	$rela_latitude  = $array_site2["latitude"];
	$rela_longitude = $array_site2["longitude"];
	$rela_data      = $array_site2["data"];

	
	echo "<tr><td>$rela_cliente</td><td>$rela_latitude</td><td>$rela_longitude</td><td>$rela_data</td></tr>";
	
}
?> 

</table> 
<?php
$mensagem = "Pagina de Location";
salvaLog($con,$mensagem);

?>
</div>
</div>
</body>
</html>