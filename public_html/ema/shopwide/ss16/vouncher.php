<?php
session_start();
include"../../conexao.php";
include"sql_pedido/p_pedido.php";

$var_vounche = $_GET["tipo"];

if($var_vounche <> "dispo") {header("location:../../principal.php");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>adisul.net</title>
<style type="text/css" media="all">
@import url("estilo_shop.css");
</style>
</head>

<body>
<div id="conta">
<?php 
include"top.php";
?>


<div id="vounche">
<div id="caixa_vouncher">
<p class="concluido">Pedido concluido !</p><br />
Você vai receber um e-mail na sua caixa de entrada notificando que seu pedido foi enviado. Caso não apareça o e-mail , verifique <a href="../../info2.php" title="Meus dados"><em>aqui</em></a> no site qual e-mail está cadastrado no site, se mesmo assim não receber este e-mail, verifique sua caixa de spam e adicione o adisul@adisul.net e staff@adisul.net na sua lista de contatos confiavéis.
<br />

<br />
Lembrando que a qualquer momento você pode retornar a loja e fazer um novo pedido. Qualquer dúvida entre contato com seu representante.<br />
</div>
<div id="logo_fw13" style="display:none;">
Observação:<br />

<form action="#" method="post">
	<textarea cols="50" rows="5"></textarea>
    <input type="submit" value="Enviar" style="background-color:#F90;color:#000;padding:10px;border-width:thin;border-style:solid;" />

</form>
</div>

<br />
<br />

<a href="../../principal.php" title="Voltar a página inicial do site" class="link_vouncher"><img src="img/logo_home.png" /></a>
<a href="../../pedidos.php" title="Meus pedidos do site" class="link_vouncher"><img src="img/logo_contat.png" /></a>
<a href="../../info2.php" title="Meus dados" class="link_vouncher"><img src="img/logo_perfi.png" /></a>
<a href="dispo.php" title="Voltar a loja" class="link_vouncher"><img src="img/logo_shop.png" /></a>


</div>
</div>
<footer id="versao"><?php echo $versao;?></footer>
</body>
</html>