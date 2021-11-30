<?php
session_start();
include "conexao.php";

$type = $_GET["type"];

if($userx == "adisul_ema")          {$xxxend = "http://www.adisul.net/ema";}
elseif($userx == "adisul_adidas")   {$xxxend = "http://www.adisul.net/mau";}
elseif($userx == "adisul_eifer")    {$xxxend = "http://www.adisul.net/eifer";}
elseif($userx == "adisul_betaluc")  {$xxxend = "http://www.adisul.net/betaluc";}
elseif($userx == "adisul_durrer")   {$xxxend = "http://www.adisul.net/durrer";}
elseif($userx == "adisul_paschoal") {$xxxend = "http://www.adisul.net/paschoal";}
elseif($userx == "adisul_jl3")      {$xxxend = "http://www.adisul.net/jl3";}
elseif($userx == "adisul_moa")      {$xxxend = "http://www.adisul.net/moa";}
elseif($userx == "adisul_schuma")   {$xxxend = "http://www.adisul.net/schuma";}
elseif($userx == "adisul_eduardo")  {$xxxend = "http://www.adisul.net/eduardo";}


    if($type == "DISPO")   {$bd_banco = "pedido";         $type2 = "dispo"; $pagina = "xls_pedido";}
elseif($type == "CLE1")    {$bd_banco = "pedido_cle_1";   $type2 = "dispo"; $pagina = "xls_pedido_cle_1";}
elseif($type == "CLE")     {$bd_banco = "pedido_cle";     $type2 = "dispo"; $pagina = "xls_pedido_cle";}
elseif($type == "CLE2012") {$bd_banco = "pedido_cle2012"; $type2 = "dispo"; $pagina = "xls_pedido_cle2012";}
elseif($type == "SS12")    {$bd_banco = "pedido_ss12";    $type2 = "dispo"; $pagina = "xls_pedido_ss12";}
elseif($type == "FW12")    {$bd_banco = "prevendafw12";   $type2 = "dispo"; $pagina = "xls_pedido_fw12";}
elseif($type == "CLE12012"){$bd_banco = "pedido_cle_12012";$type2 = "dispo"; $pagina = "xls_pedido_cle_12012";}


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
<style type="text/css">
#p_painel {
	position:absolute;
	left:0;
	top:50px;
	width:860px;
	height:auto;
	background-color:#FFFFFF;
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
	background-color:#000;
	}
tr:hover {
	background-color:#CFF;
}

tr:active {
	background-color:#CFF;
}

a:visited {
	color:#00F;}
a {
	color:#00F;}
</style>
<link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>

<style type="text/css" media="all">
@import url("menu.css");

</style>
</head>

<body>
<div id="faixa"></div>
<div id="container">
<?php echo $menu_adi;?>
</div>
  <div id="lista_pedidos">
  <center>
  <a href="motor_xls_pedido.php?var=<?php echo $type ;?>" alt="Relatório de pedido" class="bt_xls"><img src="images/gear3.png" alt="XLS" />Exportar Relatório</a>
  	<table width="100%" style="background-color:#FFFFFF; ">
  	<table width="100%" style="background-color:#FFFFFF; ">
      <tr><td>Pedido</td><td>Feito por</td><td>Comprador</td><td>Email para Contato</td><td>para</td><td>Horário</td><td>Data do pedido</td><td>Status</td><td>Total Pedido</td><td>Ações</td></tr>
      <?php
	  $pedido_sql = mysqli_query($con,"SELECT * FROM `$bd_banco` ORDER BY id DESC");
	  while ($pedido_array    = mysqli_fetch_assoc($pedido_sql)){
		$pedido_npedido       = $pedido_array["npedido"];
		$pedido_clientepai    = $pedido_array["cliente"];
		$pedido_clientefilho  = $pedido_array["cliente_filho"];
		$pedido_data          = $pedido_array["data_pedido"];
		$pedido_total         = $pedido_array["total"]; 
		$pedido_hora          = $pedido_array["hora"];
		$pedido_status        = $pedido_array["status"];  
		$cliente_sql = mysqli_query($con,"SELECT * FROM login WHERE `B` = '$pedido_clientepai'");while($cliente_array    = mysqli_fetch_assoc($cliente_sql)){$nome_clientepai = $cliente_array["loja"];}
		$email_sql = mysqli_query($con,"SELECT * FROM login WHERE `B` = '$pedido_clientepai'");while($email_array    = mysqli_fetch_assoc($email_sql)){$email = $email_array["email"];$comprador = $email_array["comprador"];}
		$cliente_sql_2 = mysqli_query($con,"SELECT * FROM login WHERE `B` = '$pedido_clientefilho'");while($cliente_array_2    = mysqli_fetch_assoc($cliente_sql_2)){$nome_clientefilho = $cliente_array_2["loja"];}
		
		#------ Tratamento de dados---------------------------------
		$pedido_total =  number_format($pedido_total, 2, ',', '.');
		
		$pedido_data = date('d/m/Y', strtotime(str_replace("-", "/", $pedido_data ))); 
		if($pedido_status  == "1") {$pedido_status ="<b style=\"color:#F90;\">Aberto</b>";}
		elseif($pedido_status == "2"){$pedido_status = "<b style=\"color:red;\">Pedido Enviado</b> ";}
		elseif($pedido_status == "3"){$pedido_status = "<b style=\"color:blue;\">Pedido Conferido</b> ";}
		elseif($pedido_status == "4"){$pedido_status = "<b style=\"color:#090;\">Finalizado</b> ";}
	  
	  echo "<tr><td><a href=\"produtos.php?npedido=$pedido_npedido&tipo=$type\" style=\"background-image:url(images/npedido.png); width:75px; display:block; height:20px;color:#000;text-align:center;vertical-align:middle;\" title=\"Abrir o pedido\" />$pedido_npedido</a></td><td><a href=\"perfil.php?login=$pedido_clientepai\">$nome_clientepai | $pedido_clientepai</a></td><td>$comprador</td><td><a href=\"mailto:$email?Subject=ADIDAS - Pedido Disponibilidade Nº $pedido_npedido - ADISUL\"><img src=\"images/icone_email.gif\" width=\"20px\" title=\"$email\"/></a></td><td><a href=\"perfil.php?login=$pedido_clientefilho\">$nome_clientefilho | $pedido_clientefilho</a></td><td>$pedido_hora</td><td>$pedido_data</td><td>$pedido_status</td><td>R$ $pedido_total</td><td><a href=\"$xxxend/order/ordens/$pagina.php?npedido=$pedido_npedido&tipo=$type2\"><img src=\"images/ver.png\" title=\"Download Pedido\"></a><a href=\"excluir_pedido.php?npedido=$pedido_npedido&tipo=$type\"><img src=\"images/excluir.png\" title=\"Excluir Pedido\"></a><a href=\"atua_pedido_status.php?npedido=$pedido_npedido&var=4&tipo=$type\"><img src=\"images/finalizar.png\" title=\"Finaliza Pedido\"></a></td></tr>";
	  $pedido_clientefilho = 0;$nome_clientefilho = "";
	  $pedido_clientepai = 0;$nome_clientepai = "";};
      ?>
    </table>
    </center>
  </div>
<?php

$mensagem = "Pagina de Pedidos Disponibilidade";
salvaLog($con,$mensagem);

?>
</body>
</html>