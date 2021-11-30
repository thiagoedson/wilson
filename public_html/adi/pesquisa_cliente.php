<?php
session_start();
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
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="menu.js"></script>
<style type="text/css" media="all">
@import url("menu.css");

#p_painel {
	position:absolute;
	left:0;
	top:78px;
	width:860px;
	height:auto;
	background-color: #CCCCCC;
	padding: 0px;
}

#container {
	position:relative;
	margin:auto;
	width:900px;}
</style>
</head>
<body>
<div id="faixa"></div>
<div id="container">
<?php echo $menu_adi;?>
<div id="pesquisa">
<form action="<?php echo $PHP_SELF; ?>" method="post">
Busca por nome , Código Adidas OU CNPJ:<input type="text" name="search" /><input type="submit" value="BUSCAR" style="padding:3px;" />
</form>
</div>

</div>
<div id="campo_novo">
<table class="resultado_search">
   <tr class="tr_resultado_search">
    <td>Cód Cliente/Login</td><td>CNPJ</td><td>Cliente</td><td>Grupo do Site</td><td>Status</td><td>Email</td>
  </tr> 
<?php
$search = $_POST["search"];
if($search <> "") {
$sql = mysqli_select_db($con,"$banco");
$query_site2 = mysqli_query($con,"SELECT * FROM `login` WHERE `login`.`loja` LIKE '%".$search."%' OR `login`.`B` = '".$search."' OR `login`.`C` = '".$search."' OR `login`.`nome` = '".$search."'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site2 = mysqli_fetch_assoc($query_site2)){	
	$rela_cliente      = $array_site2["loja"];
	$rela_codigo       = $array_site2["B"];	
	$rela_cnpj         = $array_site2["C"];
	$rela_status       = $array_site2["status"];	                     
	$rela_email        = $array_site2["email"];
	$rela_grupo_site   = $array_site2["nome"];
	$rela_grupo_status = $array_site2["status"];	
	
	if($rela_status == "1") { $rela_status = "<font color=\"#000033\">Acesso Completo</font>";}
	elseif($rela_status == "2") { $rela_status = "<font color=\"#336600\">Acesso Limitado";}
	elseif($rela_status == "3") { $rela_status = "<font color=\"#FF0000\">Acesso Suspenso";}
	else {$rela_status = "<font color=\"#FF0000\">Status Alterado infome este erro";}
			
	echo "
	<tr class=\"hoverrer\">
     <td><a href=\"perfil.php?login=$rela_codigo\">$rela_codigo</a></td>
     <td>$rela_cnpj</td>
     <td><a href=\"perfil.php?login=$rela_codigo\">$rela_cliente</a></td>
     <td><a href=\"pesquisa_grupo.php?search=$rela_grupo_site \">$rela_grupo_site</a></td>
     <td>&nbsp;$rela_status</td>
     <td><a href=\"mailto:$rela_email?Subject=ADIDAS - ASSUNTO - ADISUL\"><img src=\"images/mail.gif\" /></a></td>
    </tr>";
	
}
$mensagem = "Pesquisa cliente : $search";
salvaLog($con,$mensagem);
}
?>  
</table>
</div>
</body>
</html>