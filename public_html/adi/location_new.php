<?php
session_start();
include'conexao.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="images/iso.png" rel="shortcut icon"  type="image/png"/>
<link href="images/iso.png" rel="apple-touch-icon" type="image/png"/>
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="menu.js"></script>
<title>ADISUL- Controle Administrativo</title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<style type="text/css">
@import url("menu.css");
	
#new_location {
	display: block;
	position: absolute;
	left: 0;
	top: 100px;
	padding: 5px;
	background-color:#FFF;	
	background-image: url(images/bg_location.jpg);
	background-repeat: no-repeat;
	background-position: center top;
	padding-top: 200px;
	width: 100%;
}
</style>
</head>
<body>

<div id="container">
<?php echo $menu_adi;?>

</div>
<div id="new_location">
<p> As informações de localização podem não conferir com a localização exata do usuário por motivos diversos, porém a região sempre vai ser aproximada.<br />
Os acessos abaixo são dos últimos 100 que acessaram o site recentemente na ordem decrescente.</p>
<br />
<br />

<table width="100%" bgcolor="#FFFFFF">
<tr>
<td  class="estilo1">Razão Social</td>
<td  class="estilo1">Cidade</td>
<td  class="estilo1">Cidade/Cadas.</td>
<td  class="estilo1">Estado</td>
<td  class="estilo1">Estado/Cadas.</td>
<td  class="estilo1">País</td>
<td  class="estilo1">Grupo</td>
<td  class="estilo1">Data/Hora</td>
<td  class="estilo1">Google Maps</td>

</tr>
<?php

$mysql_location = mysqli_query($con,"SELECT * FROM `location_user` ORDER BY `data` DESC LIMIT 100")or die(mysql_error());
while($array_location = mysqli_fetch_assoc($mysql_location)){	
	$lo_codigo    = $array_location["codigo"];
	$lo_latitude  = $array_location["latitude"];
	$lo_longitude = $array_location["longitude"];
	$lo_data      = $array_location["data"];
	$lo_custon    = $array_location["custon"];
	$lo_city      = $array_location["city"];
	$lo_state     = $array_location["state"];
	$lo_code3     = $array_location["code3"];
	
	$lo_data = date('d/m/Y H:i:s', strtotime(str_replace("-", "/", $lo_data )));
#-----------------------------------------------------------------------------------------------
	
$query_nome_loja = mysqli_query($con,"SELECT * FROM login WHERE `B` = '$lo_codigo'") or die(mysql_error());
while($array_site_loja = mysqli_fetch_assoc($query_nome_loja)){	
	$lo_loja  = $array_site_loja["loja"];
	$lo_grupo = $array_site_loja["nome"];
	$lo_uf    = $array_site_loja["UF"];
	$lo_cidade = $array_site_loja["cidade"];
}

$lo_uf = trim($lo_uf);
$lo_state = trim($lo_state);
$lo_city = strtoupper($lo_city);
$lo_cidade = strtoupper($lo_cidade);

if($lo_uf <> $lo_state) {$variavel_cor = "suspeito";} else {$variavel_cor = "normal";}
	
echo "
<tr class=\"$variavel_cor\">
<td class=\"estilo1\"><a href=\"perfil.php?login=$lo_codigo\">$lo_loja</a></td>
<td class=\"estilo1\">$lo_city</td>
<td class=\"estilo1\">$lo_cidade</td>
<td class=\"estilo1\">$lo_state</td>
<td class=\"estilo1\">$lo_uf</td>
<td class=\"estilo1\">$lo_code3</td>
<td class=\"estilo1\">$lo_grupo</td>
<td class=\"estilo1\">$lo_data</td>
<td class=\"estilo1\"><a href=\"https://www.google.com.br/maps/@".$lo_latitude.",".$lo_longitude.",18z\" >Google Maps</a></td>
</tr>";	
	}	
?>
</table>

</div>

</body>
</html>