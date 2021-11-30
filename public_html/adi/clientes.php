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
	left:203px;
	top:15px;
	width:700px;
	height:500px;
	background-color: #CCCCCC;
}
* {
	margin: 0px;
	padding: 0px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 8pt;
}
</style>
<script language="JavaScript" src="menu.js"></script>
<script language="JavaScript" src="menu_items.js"></script>
<script language="JavaScript" src="menu_tpl.js"></script>

<style type="text/css" media="all">
@import url("menu.css");
#bt_atua {
	position:absolute;
	left:631px;
	top:46px;
	width:130px;
	height:30px;
	background-color: #FFFF00;
}
</style>
</head>

<body>

<script language="JavaScript">
	new menu (MENU_ITEMS, MENU_TPL);
</script>
<div id="p_painel">
<?php
include "../conexao.php";

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

Titulo do Site : <?php echo $titulo ;?> <br />
Coleção : <?php echo $colecao;?><br />
<br />
<br />

<table border="1" width="400px">
  <tr>
    <td>Carteira</td><td>Faturamento</td><td>Situação de Crédito</td><td>Cancelamento</td>
  </tr>
  <tr>
    <td><?php echo $carteira;?></td><td><?php echo $faturamento;?></td><td><?php echo $situa;?></td><td><?php echo $cancelamento;?></td>
  </tr>
</table>

Produtos

<table border="1" width="400px">
  <tr>
    <td>Téxtil</td><td>Calçados</td><td>Equipamentos</td><td>Cle</td>
  </tr>
  <tr>
    <td><?php echo $textil;?></td><td><?php echo $calcados;?></td><td><?php echo $equi;?></td><td><?php echo $cle;?></td>
  </tr>
</table>
<br />
<br />


<table border="2" width="750px" bgcolor="#FFFF00" align="center">
  <tr bgcolor="#FF0000">
    <td colspan="6" align="center"><b>Usuários Atulizados</b></td>
  </tr>
   <tr>
    <td>Cód Cliente</td><td>CNPJ</td><td>Pass</td><td>Comprador</td><td align="center">Status</td><td>Email</td>
  </tr>
<?php
$query_site2 = mysqli_query($con,"SELECT * FROM login WHERE D <> 'adisul123' ORDER BY comprador") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site2 = mysqli_fetch_assoc($query_site2)){	
	$rela_status = $array_site2["status"];
	$rela_cliente = $array_site2["B"];
	$rela_comprador = $array_site2["comprador"];
	$rela_email = $array_site2["email"];
	$rela_login = $array_site2["C"];
	$rela_pass = $array_site2["D"];
	
	echo "
	<tr>
   <td>&nbsp;$rela_cliente</td><td>&nbsp;$rela_login</td><td>&nbsp;$rela_pass</td><td>&nbsp;$rela_comprador</td><td align=\"center\">$rela_status</td><td>$rela_email</td>
    </tr>";
}
?>
  
</table>



</div>
<a href="atua_site.php"><div id="bt_atua"></div></a>
</body>
</html>