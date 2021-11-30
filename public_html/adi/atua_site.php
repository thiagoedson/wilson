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
<link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
<style type="text/css">
#p_painel {
	position:absolute;
	left:203px;
	top:15px;
	width:700px;
	height:500px;
	background-color: #CCCCCC;
}

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
<div id="container">
<?php echo $menu_adi; ?>
<div id="update">
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
<form action="atua_site_sql.php" method="post">
Titulo do Site : <input type="text" name="titulo" value="<?php echo $titulo ;?>" size="35" /> <br />

<br />
<br />

<table border="1" width="500px">
  <tr>
    <td>Carteira</td><td>Faturamento</td><td>Situação de Crédito</td><td>Cancelamento</td>
  </tr>
  <tr>
    <td><input type="text" value="<?php echo $carteira;?>" name="carteira" size="10"/></td><td><input type="text" value="<?php echo $faturamento;?>" name="faturamento" size="10" /></td><td><input type="text" value="<?php echo $situa;?>" name="situa" size="10"  /></td><td><input type="text" value="<?php echo $cancelamento;?>" name="cancelamento" size="10" /></td>
  </tr>
</table>

</table>
<br />
<br />

<center><input type="submit" value="Atualizar" style="padding:8px;" /></center>
</form>
</div>
</div>
</body>
</html>