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

.email_large {
	display:block;}
</style>
</head>

<body>
<div id="faixa"></div>
<div id="container">
<?php echo $menu_adi;?>
<div id="p_painel" style="width:auto;">



<?php $query_site2 = mysqli_query($con,"SELECT DISTINCT email FROM login WHERE email <> '' AND `status` != '3' ORDER BY comprador") or die(mysql_error());while($array_site2 = mysqli_fetch_assoc($query_site2)){$rela_email = $array_site2["email"];		
echo "$rela_email ; <br />";
}?>
<br />

Clique com o botão direito do mouse e depois em "Copiar endereço de e-mail", após isso basta colar em seu programa padrão de e-mail.



</div>
</div>
</body>
<?php
$mensagem = "Pagina clientes com email";
salvaLog($con,$mensagem);

?>
</html>