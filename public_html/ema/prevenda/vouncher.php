<?php 

$var = $_GET["tipo"];


if($var == "dispo") {


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pedido Concluido</title>
<style type="text/css">

*	{
	padding:0;
	margin:0;
	font-family:Verdana, Geneva, sans-serif;
	font-size:10pt;
}

#conta {
	position:relative;
	margin:auto;
	width:620px;
	}

body {
	background-image: url(img/vouncher.jpg);
	background-repeat: repeat-x;
	background-position: top;
}
#msg {
	position:absolute;
	left:0;
	top:270px;
	width:600px;
	height:120px;
	text-align: center;
	padding: 10px;
}
#top_menu {
	position:absolute;
	left:0;
	top:20px;
	width:620px;
	height:100px;
	background-image: url(img/finalizado.png);
}
#bt_1 {
	position:absolute;
	left:100px;
	top:450px;
	width:122px;
	height:120px;
	background-image: url(img/vl_loja.jpg);
}

#bt_2 {
	position:absolute;
	left:400px;
	top:450px;
	width:122px;
	height:120px;
	background-image:url(img/vl_inicio.jpg)
}
</style>
</head>

<body>

<div id="conta">
<div id="top_menu"></div>
<div id="msg">
Seu pedido foi <b>finalizado</b> , uma cópia foi enviada para seu email cadastrado no adisul.com,
para verificar se o seu pedido vai ser entregue fique atento ao Relatório de Carteira ou Faturamento.
</div>

<a href="../principal.php"><div id="bt_2"></div></a>

<a href="index.php"><div id="bt_1"></div></a>


</div>
</body>
</html>

<?php }

else { 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pedido Concluido</title>
<style type="text/css">

*	{
	padding:0;
	margin:0;
	font-family:Verdana, Geneva, sans-serif;
	font-size:10pt;
}

#conta {
	position:relative;
	margin:auto;
	width:620px;
	}

body {
	background-image: url(img/vouncher.jpg);
	background-repeat: repeat-x;
	background-position: top;
}
#msg {
	position:absolute;
	left:0;
	top:270px;
	width:600px;
	height:120px;
	text-align: center;
	padding: 10px;
}
#top_menu {
	position:absolute;
	left:0;
	top:20px;
	width:620px;
	height:100px;
	background-image: url(img/finalizado.png);
}
#bt_1 {
	position:absolute;
	left:100px;
	top:450px;
	width:122px;
	height:120px;
	background-image: url(img/vl_loja.jpg);
}

#bt_2 {
	position:absolute;
	left:400px;
	top:450px;
	width:122px;
	height:120px;
	background-image:url(img/vl_inicio.jpg)
}
</style>
</head>

<body>

<div id="conta">
<div id="top_menu"></div>
<div id="msg">
Seu pedido foi <b>finalizado</b> , uma cópia foi enviada para seu email cadastrado no adisul.com,
para verificar se o seu pedido vai ser entregue fique atento ao Relatório de Carteira ou no Menu Minha loja - Meus Pedidos.
</div>

<a href="../principal.php"><div id="bt_2"></div></a>

<a href="dispo_cle.php"><div id="bt_1"></div></a>


</div>
</body>
</html>

<?php }

 ?>