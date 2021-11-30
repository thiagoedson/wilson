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
	width:150px;
	height:40px;
	padding:10px;
	background-color:#FFF;
	margin:2px;
	border-radius:2px;
	
	
	}
.nome {
	font-size:8pt;!importat
	}
	
.numero {
	position:absolute;
	margin-left:110px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12pt;
	padding:5px 5px 0 5px;	
	background:#000000;
	color:#FFF;
	}
</style>
</head>
<body>
<div id="faixa"></div>
<div id="container">
<?php echo $menu_adi;?>
<div id="campo_novo_3">
<?php


$query_site2 = mysqli_query($con,"select  DISTINCT `nome` from login ORDER BY `nome`") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site2 = mysqli_fetch_assoc($query_site2)){	
	$rela_cliente  = $array_site2["nome"];
	$rela_total_cliente  = $array_site2["B"];
	$query_site3 = mysqli_query($con,"select  *  from login WHERE `nome` = '$rela_cliente'") or die(mysql_error());    
    $num_rows = mysqli_num_rows($query_site3);
	echo "
	<tr>
   <a href=\"pesquisa_grupo.php?search=$rela_cliente\"><span class=\"span\"><span class=\"nome\">$rela_cliente</span><br />
	
	<span class=\"numero\">$num_rows</span></span></a>
   </label>";
}
?>  
<?php
$mensagem = "Pagina de grupos";
salvaLog($con,$mensagem);

?>
</div>
</div>
</body>
</html>