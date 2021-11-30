<?php 
session_start();
include "conexao.php";
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
	width:82px;
	height:22px;
	background-image: url(images/bt.png);
	-webkit-transition-duration: 1s;
	-moz-transition-duration: 1s;
	-o-transition-duration: 1s;
	transition-duration: 1s;
}

#bt_atua:hover {
	-webkit-transform:scale(1.2) skew(1deg); /* prefixo para browsers webkit */
	-moz-transform:scale(1.2) skew(1deg); /* prefixo para browsers gecko */
	-o-transform:scale(1.2) skew(1deg); /* prefixo para opera */
	transform:scale(1.2) skew(1deg);
	opacity:0.65;
	-moz-opacity: 0.65;
	filter: alpha(opacity=65);}
	
.span {
	float:left;
	display:block;
	width:168px;
	height:160px;
	padding:5px;
	border-style:inset;	
	border-width:1px;	
	background-color:#FFF;
	}
.titulo {
	text-align:center;
	display:block;
	font-size:48px;}
</style>
</style>
</head>

<body>
<div id="container">
<?php echo $menu_adi;?>
<div id="p_painel">

<span class="titulo">Produtos Vendidos Loja Disponibilidade</span><br />


<?php
$relatorio = mysqli_query($con,"SELECT DISTINCT artigo, descricao FROM lista_artigo_pedido ORDER BY descricao");
 while($array = mysqli_fetch_assoc($relatorio)){		
    $artigo      = $array["artigo"];
	$descricao      = $array["descricao"];
	$cont = mysqli_query($con,"SELECT SUM(quantidade) as soma FROM lista_artigo_pedido WHERE artigo = '$artigo'");
	while($array_to = mysqli_fetch_assoc($cont)){		
    $lin      = $array_to["soma"];	}	
	
	$resulado ="<span class=\"span\"><img src=\"../thumb/".$artigo."_F.jpg\" width=\"120px\" height=\"120px\" ><br /> $artigo | Total $lin <br /> $descricao</span>";
	
 echo $resulado;
 $descricao = "";
 }
 
?>
</div>
</div>
</body>
</html>