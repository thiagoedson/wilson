<?php
session_start();
session_cache_limiter( 'nocache' );

include"conexao.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="images/iso.png" rel="shortcut icon"  type="image/png"/>
<link href="images/iso.png" rel="apple-touch-icon" type="image/png"/>
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
.efeito {
	text-decoration:blink;

	}

</style>
<script type="text/javascript" src="jquery.js"></script>
<script src="jquery-blink.js" language="javscript" type="text/javascript"></script>
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="menu.js"></script>
<style type="text/css" media="all">
@import url("menu.css");
</style>
</head>
<body>
<div id="faixa"></div>
<div id="container">
<?php echo $menu_adi;?>
<div id="campo33">
<p class="titulo">Informações do representante</p>
E-mail de recebimento de pedidos : 
<?php 
$query_info = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`usuarios`  WHERE `id` = '$represe'") or die(mysql_error()); 
while($array_info = mysqli_fetch_assoc($query_info))
{echo $array_info["email"]; 

$array_info = "";
}?>
<br />
Telefone : 
<?php 
$query_info = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`usuarios`  WHERE `id` = '$represe'") or die(mysql_error()); 
while($array_info = mysqli_fetch_assoc($query_info))
{echo $array_info["telefone"];
$array_info = ""; 
}?>
<br />
Celular : 
<?php 
$query_info = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`usuarios`  WHERE `id` = '$represe'") or die(mysql_error()); 
while($array_info = mysqli_fetch_assoc($query_info))
{echo $array_info["celular"]; 
$array_info = "";
}?>
<br />
Contato : 
<?php 
$query_info = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`usuarios`  WHERE `id` = '$represe'") or die(mysql_error()); 
while($array_info = mysqli_fetch_assoc($query_info))
{echo $array_info["contato"]; 
$array_info = "";
}?>
<br />
Tipo : 
<?php 
$query_info = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`usuarios`  WHERE `id` = '$represe'") or die(mysql_error()); 
while($array_info = mysqli_fetch_assoc($query_info))
{echo $array_info["tipo"]; 
$array_info = "";
}?><br />
Região : 
<?php 
$query_info = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`usuarios`  WHERE `id` = '$represe'") or die(mysql_error()); 
while($array_info = mysqli_fetch_assoc($query_info))
{echo $array_info["region"]; 
$array_info = "";
}?>
<br />
ICMS : 
<?php 
$query_info = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`usuarios`  WHERE `id` = '$represe'") or die(mysql_error()); 
while($array_info = mysqli_fetch_assoc($query_info))
{echo $array_info["icms"]; 
$array_info = "";
}?>
<br />
<br />
<br />
Se as informações acima não estiveram certas ou se haver dúvidas por favor entre em contato .<br />
<br />
<br />
<a href="mailto:staff@adisul.net?Subject=ADISUL - Info Representante"><img src="images/email_envio.png" /></a>
<br />
<br />
<br />

<a href="home.php"><img src="images/house.png" /></a>

</div>
</div>
</body>
</html>