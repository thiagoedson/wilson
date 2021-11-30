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
	top:50px;
	width:100%;
	height:auto;
	background-color: #CCCCCC;
	
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
</style>
</head>

<body>
<div id="container">
<?php echo $menu_adi;?>
</div>
<div id="campo_novo">
<?php


$query_site = mysqli_query($con,"SELECT * FROM site") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site = mysqli_fetch_assoc($query_site)){	
	$colecao = $array_site["colecao"];
	$data_atua = $array_site["data_atua"];
	$titulo = $array_site["titulo"];
	$carteira = $array_site["carteira"];
	$faturamento = $array_site["faturamento"];
	$situa = $array_site["situa"];
	$cancelamento = $array_site["cancelamento"];
	$textil = $array_site["textil"];
	$calcados = $array_site["calcados"];
	$equi = $array_site["equi"];
	$cle = $array_site["cle"];
}
$cle = date('d/m/Y', strtotime(str_replace("-", "/", $cle )));
$equi = date('d/m/Y', strtotime(str_replace("-", "/", $equi )));
$calcados = date('d/m/Y', strtotime(str_replace("-", "/", $calcados )));
$textil = date('d/m/Y', strtotime(str_replace("-", "/", $textil )));

$data_atua = date('d/m/Y', strtotime(str_replace("-", "/", $data_atua )));
$carteira = date('d/m/Y', strtotime(str_replace("-", "/", $carteira )));
$faturamento = date('d/m/Y', strtotime(str_replace("-", "/", $faturamento )));
$situa = date('d/m/Y', strtotime(str_replace("-", "/", $situa )));
$cancelamento = date('d/m/Y', strtotime(str_replace("-", "/", $cancelamento )));

?>

<table  width="100%" bgcolor="#FFFF00" align="center">
  <tr bgcolor="#FF0000">
    <td colspan="8" align="center"><b>Clientes Sem e-mail</b></td>
  </tr>
   <tr>
    <td>Cód Cliente</td><td>CNPJ</td><td>Pass</td><td align="center">Status</td><td>Email</td><td>Grupo do Site</td>
  </tr>
<?php
$query_site2 = mysqli_query($con,"SELECT * FROM login WHERE email = '' ORDER BY nome") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site2      = mysqli_fetch_assoc($query_site2)){	
	$rela_status    = $array_site2["status"];
	$rela_cliente   = $array_site2["B"];
	$rela_comprador = $array_site2["comprador"];
	$rela_email     = $array_site2["email"];
	$rela_login     = $array_site2["C"];
	$rela_pass      = $array_site2["D"];
	$over_cliente   = $array_site2["nome"];
	$over_nome      = $array_site2["loja"];
if($rela_status == "1") { $rela_status = "<font color=\"#000033\">Acesso Completo</font>";}
	elseif($rela_status == "2") { $rela_status = "<font color=\"#336600\">Acesso Limitado";}
	elseif($rela_status == "3") { $rela_status = "<font color=\"#FF0000\">Acesso Suspenso";}
	else {$rela_status = "<font color=\"#FF0000\">Status Alterado infome este erro";}
	 
	
	echo "
	<tr>
    <td><a href=\"perfil.php?login=$rela_cliente\">$over_nome</a></td><td>$rela_login</td><td>$rela_pass</td><td align=\"center\">$rela_status</td><td>$rela_email</td><td><a href=\"pesquisa_grupo.php?search=$over_cliente\">$over_cliente</a></td>
    </tr>";
}
?>
  
</table>
<?php
$mensagem = "Pagina clientes sem email";
salvaLog($con,$mensagem);

?>


</div>

</body>
</html>