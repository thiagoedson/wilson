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
	width:100%;
	height:auto;
	background-color: #CCCCCC;
	padding: 0px;
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
	position: absolute;
	left: 0;
	top: 45px;
	width: 380px;
	height: 24px;
	background-color: #FFFFFF;
	text-align: center;
	vertical-align: middle;
	padding-top: 5px;
	padding: 10px;
	
}
</style>
</head>
<body>
<div id="faixa"></div>
<div id="container">
<?php echo $menu_adi;?>

<div id="pesquisa">
<form action="<?php echo $PHP_SELF; ?>" method="get">
Busca por nome do grupo:<input type="text" name="search" /><input type="submit" value="BUSCAR" style="padding:3px;" />
</form>
</div>
</div>

<div id="campo_novo">
<?php
$search = $_GET["search"];
if($search <> "") {
?>
<table  class="resultado_search">
   <tr  class="tr_resultado_search">
    <td>Cód Cliente</td>    
    <td>CNPJ</td>
    <td>Código Referência</td>
    <td>Cliente</td>
    <td>Grupo do Site</td>
    <td>Email</td>
    <td>Status Site</td>
    <td>Senha</td>
    <td>Telefone</td>
  </tr> 
<?php

$sql = mysqli_select_db($con, "$banco");


$query_site3 = mysqli_query($con,"SELECT * FROM login WHERE `nome` LIKE '%".$search."%' ORDER BY nome") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site3 = mysqli_fetch_assoc($query_site3)){	
                                                        $rela_email = $array_site3["email"];
							$rela_status_site = $array_site3["status"];
							$rela_senha       = $array_site3["D"];
							$rela_telefone    = $array_site3["telefone"];
							$rela_cnpj        = $array_site3["C"];
							$rela_cod_adidas  = $array_site3["B"];
							$rela_cod_grupo   = $array_site3["nome"];
							$rela_cliente     = $array_site3["loja"];
							$rela_refere     = $array_site3["cod_referencia"];
							$rela_codigo      = $array_site3["B"];							
							    if($rela_status_site == "1") { $rela_status_site = "<font color=\"#000033\">Acesso Completo</font>";}
							elseif($rela_status_site == "2") { $rela_status_site = "<font color=\"#336600\">Acesso Limitado";}
							elseif($rela_status_site == "3") { $rela_status_site = "<font color=\"#FF0000\">Acesso Suspenso";}
							 else {$rela_status_site = "<font color=\"#FF0000\">Status Alterado infome este erro";}

	
	echo "
	<tr class=\"hoverrer\">
	  <td><a href=\"perfil.php?login=$rela_codigo\">$rela_codigo</a></td>
	  <td>$rela_cnpj</td>
	  <td>$rela_refere   </td>
	  <td>&nbsp;$rela_cliente</td>
	  <td>&nbsp;$rela_cod_grupo</td>
	  <td><a href=\"mailto:$rela_email?Subject=ADIDAS - ASSUNTO - ADISUL\"><img src=\"images/mail.gif\" /></a></td>
	  <td>$rela_status_site</td><td >$rela_senha</td>
	  <td>$rela_telefone</td>
    </tr>";
}
$mensagem = "Pesquisa Grupo : $search";
salvaLog($con,$mensagem);
}
?>  
</table>
</div>
</body>
</html>