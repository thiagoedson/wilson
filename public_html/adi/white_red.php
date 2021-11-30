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
	padding-top:20px;
	
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
<table  class="resultado_search">
   <tr  class="tr_resultado_search">
    <td colspan="7" align="center"><b>ACESSO SUSPENSO</b></td>
  </tr>
   <tr>
    <td>Cód Cliente</td><td>Grupo do Site</td><td>CNPJ</td><td>Senha</td><td>Comprador</td><td align="center">Status</td><td>Email</td>
  </tr>
<?php
$query_site2 = mysqli_query($con,"SELECT * FROM login WHERE status = '3' ORDER BY nome") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site2 = mysqli_fetch_assoc($query_site2)){	
	$rela_status = $array_site2["status"];
	$rela_cliente = $array_site2["B"];
	$rela_comprador = $array_site2["comprador"];
	$rela_email = $array_site2["email"];
	$rela_login = $array_site2["C"];
	$rela_grupo = $array_site2["nome"];
	$rela_pass = $array_site2["D"];
	$rela_nome = $array_site2["loja"];
	if($rela_status == "1") { $rela_status = "<font color=\"#000033\">Acesso Completo</font>";}
	elseif($rela_status == "2") { $rela_status = "<font color=\"#336600\">Acesso Limitado";}
	elseif($rela_status == "3") { $rela_status = "<font color=\"#FF0000\">Acesso Suspenso";}
	else {$rela_status = "<font color=\"#FF0000\">Status Alterado infome este erro";}
	
	echo "
	<tr>
   <td><a href=\"perfil.php?login=$rela_cliente\">$rela_nome</a></td><td><a href=\"pesquisa_grupo.php?search=$rela_grupo \">$rela_grupo</a></td><td>$rela_login</td><td>&nbsp;$rela_pass</td><td>&nbsp;$rela_comprador</td><td align=\"center\">$rela_status</td><td><a href=\"mailto:$rela_email?Subject=ADIDAS - ASSUNTO - ADISUL\">$rela_email</a></td>
    </tr>";
}
?>
  
</table>

<?php
$mensagem = "Pagina Master List";
salvaLog($con,$mensagem);

?>

</div>
</body>
</html>