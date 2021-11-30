<?php 
session_start();
include "dire.php";
$senha = $_SESSION["codigo"];


$query = mysqli_query($con, "SELECT * FROM clientes WHERE `Codigo Cliente` = '$senha'");
while($array = mysqli_fetch_array($query)){	
	  $nome_cliente   = $array["Cliente"];
	  $grupo          = $array["Descricao do Grupo"];
	  $codgrupo       = $array["Nome do Grupo"];
	  $segmentacao    = $array["Customer Article Group Description"];
	  $codigo_cliente = $array["Codigo Cliente"];
	  $cnpj           = $array["CNPJ"];
	  $ende           = $array["Endereco"];
	  $cidade         = $array["Cidade"];
	  $uf             = $array["UF"];
	  $limite_cre     = $array["Limite de Credito"];
	  $cre_dispo      = $array["Credito Disponivel"];
	  $total_aberto   = $array["Total em Aberto"];
	  $status_credito = $array["Status do Credito"];
	  $situa          = $array["Stiuacao"];
	  $tipo_bloqueio  = $array["Tipo de Bloqueio"];
	  $duplica_mes    = $array["Dupl Vencidas/ Vencer"];
	  $post_carteira  = $array["Dupl a Vencer posteriores"];
	  $ante_carteira  = $array["Dupl Vencidas anteriores"];
	  
};

#-----------------Condições-------------------------------------------
if ($situa == "Ativo") {$class1 = "ativo";}

if ($grupo == "SEM GRUPO") {
	$red = "#FFF000";
	$text_msg = "<a href=\"carteira_new.php\">Minha Carteira</a>";}
	elseif ($senha == "25783")
	{
	$red = "#FFF000";
	$text_msg = "<a href=\"carteira_new.php\">Minha Carteira</a>";}
	else {$text_msg ="<a href=\"carteira_grupo.php\" target=\"_blank\">Ver carteira do grupo</a>";}

$nega = "lost";	

if(strstr($cre_dispo, '-')) {
	$nega = "nega";}
#----------------Tratamento-------------------------------------------	

if($status_credito <> "") {

$duplica_mes = str_replace(",", ".", $duplica_mes);
$duplica_mes =  number_format($duplica_mes, 2, ',', '.');

$cre_dispo = str_replace(",", ".", $cre_dispo);
$cre_dispo =  number_format($cre_dispo, 2, ',', '.');

$limite_cre = str_replace(",", ".", $limite_cre);
$limite_cre =  number_format($limite_cre, 2, ',', '.');

$total_aberto = str_replace(",", ".", $total_aberto);
$total_aberto =  number_format($total_aberto, 2, ',', '.');
}



$duplica_mes = "R$ ".$duplica_mes;	
$limite_cre = "R$ ".$limite_cre;
$cre_dispo = "R$ ".$cre_dispo;
$total_aberto = "R$ ".$total_aberto;
$post_carteira = "R$ ".$post_carteira;
$proce_fatura = "R$ ".$proce_fatura;




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>adisul.net</title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="menu.js"></script>
<style type="text/css" media="all">
@import url("estilo.css");
</style>
</head>
<body >
<?php 
include"../adisul_prt1.php";
	   echo $menu_principal; 
?>


<div id="rela">
<label class="item">Situação de Crédito Referente <?php echo $situa_site; ?></label>
<br />
<br />

<table class="tables_1">
  <tr>
    <td colspan="2" class="subtitulo">Dados da Loja</td>
  </tr>
  <tr>
    <td class="primeira">Razão Social</td><td class="segunda"><?php echo $nome_cliente;?></td>
  </tr>
  <tr>
    <td class="primeira">Código Adidas</td><td class="segunda"><?php echo $senha;?></td>
  </tr>
  <tr>
    <td class="primeira">CNPJ</td><td class="segunda"><?php echo $cnpj;?></td>
  </tr>
  <tr>
    <td class="primeira">Grupo</td><td class="segunda"><?php echo $grupo;?></td>
  </tr>
  <tr>
    <td class="primeira">Segmentação</td><td class="segunda"><?php echo $segmentacao;?></td>
  </tr>
  <tr>
    <td class="primeira">Endereço</td><td class="segunda"><?php echo $ende;?></td>
  </tr>
  <tr>
    <td class="primeira">Cidade</td><td class="segunda"><?php echo $cidade;?></td>
  </tr>
  <tr>
    <td class="primeira">Estado</td><td class="segunda"><?php echo $uf;?></td>
  </tr>
</table>

<br />

<table class="tables_1">
  <tr>
    <td colspan="2" class="subtitulo">Dados Financeiros</td>
  </tr>
  <tr>
    <td class="primeira">Limite de crédito</td><td class="segunda"><?php echo $limite_cre;?></td>
  </tr>
  <tr>
    <td class="primeira">Limite Disponivel</td><td class="segunda"><?php echo $cre_dispo;?></td>
  </tr>
  <tr>
    <td class="primeira">Total em aberto</td><td class="segunda"><?php echo $total_aberto;?></td>
  </tr>
  <tr>
    <td class="primeira">Status de Crédito</td><td class="segunda"><?php echo $status_credito;?></td>
  </tr>
  <tr>
    <td class="primeira">Situação</td><td class="segunda"><?php echo $situa;?></td>
  </tr>
  <tr>
    <td class="primeira">Tipo de bloqueio</td><td class="segunda"><?php echo $tipo_bloqueio;?></td>
  </tr>
</table>  
<br />
 <center>
   <img src="../img/logo.png"  alt="adisul.net" />
 </center>
</div>

</body>
</html>