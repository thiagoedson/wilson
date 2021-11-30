<?php 
session_start();
include "dire.php";
$senha = $_SESSION["codigo"];


$query = mysql_query("SELECT * FROM info WHERE `Codigo Cliente` = '$senha'");
while($array = mysql_fetch_array($query)){	
	  $nome_cliente   = $array["Cliente"];
	  $limite_credito = $array["Limite de Credito"];
	  $grupo          = $array["Descricao do Grupo"];
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
	  $duplica_mes    = $array["Dupl Vencidas/ Vencer em: 06.2011"];
	  
};

#-----------------Condições-------------------------------------------
if ($situa == "Ativo") {$class1 = "ativo";}

if ($grupo == "SEM GRUPO") {
	$red = "#FFF000";
	$text_msg = "<a href=\"carteira.php\" target=\"iframe\">Minha Carteira</a>";}
	else {$text_msg ="<a href=\"carteira_grupo.php\" target=\"_blank\">Ver carteira do grupo</a>";}

$nega = "lost";	

if(strstr($cre_dispo, '-')) {
	$nega = "nega";}
#----------------Tratamento-------------------------------------------	
	
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
<title>Info -</title>
<style type="text/css">
body {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 8pt;
}
.list {
	color:#000;
	font-size: 8pt;}
.lost {
	color:#666;
	font-size: 8pt;}	
.ativo {
	color:#0C0;
	font-size: 8pt;}
.inativo {
	color:#F00;
	font-size: 8pt;}

li {
	text-decoration: none;
	list-style-type: none;
	
}

a{ text-decoration:none;
   color:#00F;
	}
a:hover {
	color:#F00;
	text-decoration:underline;}
.nega {
	
	color:#F00;}
</style>
</head>

<body>

<table>
  <tr >
    <td align="center" colspan="4" bo>Meus Dados</td>
  </tr>
  <tr>
    <td class="list">CNPJ:</td><td class="lost"><?php echo $cnpj;?></td><td class="list">Codigo Cliente:</td><td  class="lost"><?php echo $codigo_cliente;?></td>
  </tr>
  <tr>
    <td class="list">Cliente:</td><td  class="lost"><?php echo $nome_cliente;?></td><td class="list">Grupo:</td><td  class="lost"><?php echo $grupo;?></td>
  </tr>
  <tr>
    <td class="list">Segmentação:</td><td  class="lost" colspan="3"><?php echo $segmentacao;?></td>
  </tr>
  <tr>
    <td class="list">Endereço:</td><td  class="lost"><?php echo $ende;?></td><td class="list">Cidade:</td><td  class="lost"><?php echo $cidade;?></td>
  </tr>
  <tr>
    <td class="list">Estado:</td><td  class="lost" colspan="3"><?php echo $uf;?></td>
  </tr>
</table>
<hr />
<table>
  <tr>
    <td align="center" colspan="4">Dados Financeiros</td>
  </tr>
   <tr>
    <td class="list">Limite de crédito:</td><td  class="lost"><?php echo $limite_cre;?></td><td class="list">Limite Disponivel:</td><td  class="<?php echo $nega;?>"><?php echo $cre_dispo;?></td>
  </tr>
  <tr>
    <td class="list">Total em Aberto:</td><td  class="lost"><?php echo $total_aberto;?></td><td class="list">Status de Credito:</td><td  class="lost"><?php echo $status_credito;?></td>
  </tr>
  <tr>
    <td class="list">Situação:</td><td  class="<?php echo $class1;?>"><?php echo $situa;?></td><td class="list">Tipo de Bloqueio:</td><td  class="lost"><?php echo $tipo_bloqueio;?></td>
  </tr>
  </table>
 
  <table>
    <tr>
      <td class="list">Duplicatas a Vencidas/Vencer Referente ao mês <?php $p_mes = date("m"); echo $p_mes ?>:</td><td class="lost"><?php echo $duplica_mes; ?>   </td>
    </tr>
    <tr>
      <td class="list">Pedidos em Carteira posteriores ao mês <?php $p_mes = date("m"); echo $p_mes ?>:</td><td class="lost"><?php echo $post_carteira ;?></td>
    </tr>
     <tr>
      <td class="list">Está em processo de faturamento:</td><td class="lost"><?php echo $proce_fatura ;?></td>
    </tr>
  
  </table>
   <hr />
   
Pertecem ao mesmo Grupo <label class="inativo"><?php echo $grupo ;?></label> - <?php echo $text_msg ;?>
<ul>

<?php
if ($grupo <> "SEM GRUPO") {
$query = mysql_query("SELECT D FROM clientes WHERE `B` = '$grupo'");
while($array = mysql_fetch_array($query)){	
	  $grupo_cliente   = $array["D"];
	  
echo "<li>$grupo_cliente</li>";
}}
?>   
</ul>

</body>
</html>