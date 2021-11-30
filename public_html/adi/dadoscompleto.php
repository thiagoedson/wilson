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
<div id="faixa"></div>
<div id="container">
<?php echo $menu_adi;?>
</div>
<div id="campo_novo" style="width:100%;left:0;">
<table  class="resultado_search" style="width:100%;">
  <tr class="tr_resultado_search">
    <td colspan="12" align="center"><b>Lista Completa</b>  -  <a href="dadoscompleto_xls.php" title="Download em Excel">Download em Excel</a></td>
  </tr>
   <tr style="background-color:#FC0;">
    <td>Código Adidas</td>
    <td>Cliente</td>
    <td>Telefone</td>
    <td>Grupo na Adidas</td>
    <td>Grupo do Site</td>
    <td>Usuario</td>
    <td>Senha do Site</td>
    <td>Status Crédito</td>
    <td>Status no site</td>
    <td>Segmentação</td>
    <td>Código Segmentação</td>
    <td>Código de referência</td>
  </tr>
<?php
$query_site2 = mysqli_query($con,"SELECT * FROM `$banco`.`login` WHERE `status` !='3' ORDER BY nome") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site2      = mysqli_fetch_assoc($query_site2)){	
	$rela_status    = $array_site2["status"];
	$rela_cliente   = $array_site2["B"];
	$rela_comprador = $array_site2["comprador"];
	$rela_email     = $array_site2["email"];
	$rela_login     = $array_site2["C"];
	$rela_pass      = $array_site2["D"];
	$rela_telefone  = $array_site2["telefone"];
	$rela_celular   = $array_site2["celular"];
	$over_cliente   = $array_site2["nome"];
	$segme_cliente  = $array_site2["segmento_2"];
	$over_cliente   = $array_site2["nome"];
	$nome_clientex  = $array_site2["loja"];
	$nome_refere    = $array_site2["cod_referencia"];
	
	$segmenta = $segme_cliente;
	
	
	if($rela_status == "1")     { $rela_status = "<font color=\"#000033\">Acesso Completo</font>";}
	elseif($rela_status == "2") { $rela_status = "<font color=\"#336600\">Acesso Limitado";}
	elseif($rela_status == "3") { $rela_status = "<font color=\"#FF0000\">Acesso Suspenso";}
	                        else {$rela_status = "<font color=\"#FF0000\">Status Alterado infome este erro";}
	
	if($segmenta == "C03") {$v_segmento = "Especializada";}
	        elseif($segmenta == "C01") {$v_segmento = "Multi-Especialista de Imagem";}
			elseif($segmenta == "C02") {$v_segmento = "Multi-Especialista Comercial";}
			elseif($segmenta == "C04") {$v_segmento = "Generalista de Imagem";}
			elseif($segmenta == "C05") {$v_segmento = "Generalista Comercial";}
			elseif($segmenta == "C06") {$v_segmento = "Directional de Imagem";}
			elseif($segmenta == "C07") {$v_segmento = "Lifestyle de Imagem";}
			elseif($segmenta == "C08") {$v_segmento = "Lifestyle Comercial";}
			elseif($segmenta == "C09") {$v_segmento = "Fashion";}
			elseif($segmenta == "C10") {$v_segmento = "Loja Conceito";}
			$v_segmento = strtoupper($v_segmento);
			
			
			
			$query_site4 = mysqli_query($con,"SELECT * FROM `$banco`.`clientes` WHERE `Codigo Cliente` = '$rela_cliente'") or die(mysql_error());
                        #-----------------------------------------------------------------------------------------------
            while($array_site4      = mysqli_fetch_assoc($query_site4))
					{	
	                $nome_cliente    = $array_site4["Cliente"]; 
					$nome_grupo      = $array_site4["Descricao do Grupo"];
					$nome_status     = $array_site4["Status do Credito"];
					}
	 
	
	echo "
	<tr>
      <td>$rela_cliente</td>
	  <td><a href=\"perfil.php?login=$rela_cliente\">$nome_clientex</a></td>
	  <td>$rela_telefone</td>
	  <td>$nome_grupo</td>
	  <td><a href=\"pesquisa_grupo.php?search=$over_cliente \">$over_cliente</a></td>
	  <td>$rela_login</td>
	  <td class=\"pass_sen\">$rela_pass</td>
	  <td>$nome_status</td>
	  <td>$rela_status</td>
	  <td>$v_segmento</td>
	  <td>$segme_cliente</td>
	  <td>$nome_refere</td>
    </tr>";
    
    $nome_status = "";
    $v_segmento = "";
    $segmenta = "";
    $nome_grupo = "";
	$rela_cliente = "";
}
?>
  
</table>



</div>
<?php
$mensagem = "Pagina Dados Completos";
salvaLog($con,$mensagem);

?>
</body>
</html>