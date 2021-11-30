<?php
session_start();
$welcome = "Bem Vindo Mauricio";
$represe = "1";
$host = "localhost"; //computador onde o servidor de banco de dados esta instalado
$user = "zk10n546_mau"; //seu usuario para acessar o banco
$pass = "mhvt26mnk"; //senha do usuario para acessar o banco
$banco = "zk10n546_mau"; //banco que deseja acessar
$con = mysql_connect($host, $user, $pass) or die (mysql_error());
mysqli_select_db($con,$banco);

#include"conexao.php";
header("Content-type: text/html; charset=utf-8");



// definimos o tipo de arquivo
header("Content-type: application/msexcel");

// Como será gravado o arquivo
header("Content-Disposition: attachment; filename=sales_order_pedido.xls");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="images/iso.png" rel="shortcut icon"  type="image/png"/>
<link href="images/iso.png" rel="apple-touch-icon" type="image/png"/>
<style type="text/css">
.font {
	font-size: 10pt;

}

#pedidos_excluidos {
	position: absolute;
	left: 0;
	top: 150px;
	width: 100%;
	height: 286px;
	background-color: #FFFFFF;
}

.laranja {
	color:#F90;
	font-weight:100;}
.vermelho {
	color:#F00;
	font-weight:100;}
.azul {
	color:#00F;
	font-weight:100;}
.verde_e {
	color:#090;
	font-weight:100;}
	
.sem {
	color:#63C;
	font-weight:100;}
.suspeito {	
	background-color:#F00;
	color:#FFF;
}
.normal {	
	background-color:#FFF;
	color:#000;
}
.normal:hover {	
	background-color:#9F3;
	
}
.suspeito:hover {	
	background-color:#9F3;
	
}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php

$var_pedido = $_GET["var"];
$data_rela = date('d/m/Y');
$data_rela_s = date('d-m-Y');

$hora_rel = date("H:i:s",  strtotime(" + 0 hour"));


if($var_pedido == "FW15") { $data_inicio = "2014-07-01"; $data_fim = "2014-12-30"; $data_inicio_ca = "2015-07-01";  $data_fim_ca = "2015-12-30"; $order_type = "FW";}


#------------------Consulta o tipo de bando de pedidos---------------------------------------------------------
$query_pedidos = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`loja_table` WHERE `tipo` = '$var_pedido' ");        
		while($array_pedido = mysqli_fetch_assoc($query_pedidos)){			
			$bd_tabela = $array_pedido["banco_artigo"];
			$tl        = $array_pedido["descricao"];
			
}
//consulta sql
$executa = mysqli_query($con,"SELECT * FROM `$banco`.`login` WHERE `status` != '3' ORDER BY `nome`, `loja`");
// montando a tabela
echo "<h1>$tl | $bd_tabela</h1>
<h5>Relatorio elaborado no dia $data_rela - $hora_rel </h5>
www.adisul.net  |  email staff@adisul.net";

echo "<table class=\"font\">";
  echo "<tr>";
    echo "<td>Código adidas</td>";
    echo "<td>Razão Social</td>";
    echo "<td>Grupo</td>";
	echo "<td>Total pedidos realizados no site em $var_pedido</td>";
    echo "<td>Total faturado entre $data_inicio à $data_fim</td>";
    echo "<td>Total em carteira entre $data_inicio_ca à $data_fim_ca</td>";
	echo "<td>E-mail</td>";
	echo "<td>Telefone</td>";

  echo "</tr>";

while ($array_xf_login = mysqli_fetch_assoc($executa)){
	
	
	$xf_login = $array_xf_login["B"];
	
	
#---------------------Total do pedido no site ------------------------------------------------------------------------------------------------------------------------	
	$query_total_pe = mysqli_query($con,"SELECT SUM(total) as soma FROM  `$bd_tabela`  WHERE  `loja` = '$xf_login'") or die(mysql_error());
	while($linha_array_pe = mysqli_fetch_assoc($query_total_pe)){$linha_pe = $linha_array_pe["soma"];$linha_pe_e += $linha_array_pe["soma"];}
	
	$total = $linha_pe; 

	$total = number_format($total, 2, ',', '.');
#---------------------------------------------------------------------------------------------------------------------------------------------------------------------	
#---------------------Total em faturamento ---------------------------------------------------------------------------------------------------------------------------	
	$query_total_fa = mysqli_query($con,"SELECT SUM(`Total Faturado`) as soma FROM `$banco`.`faturamento` WHERE  `Codigo Cliente` = '$xf_login' AND `Data Emissao NF` BETWEEN '$data_inicio' AND '$data_fim'") or die(mysql_error());
	while($linha_array_fa = mysqli_fetch_assoc($query_total_fa)){$linha_fa = $linha_array_fa["soma"];$linha_fa_a += $linha_array_fa["soma"];}
	
	$total_fa = $linha_fa; 

	$total_fa = number_format($total_fa, 2, ',', '.');
#---------------------------------------------------------------------------------------------------------------------------------------------------------------------	

#---------------------Total em carteira------ ------------------------------------------------------------------------------------------------------------------------	
	$query_total_ca = mysqli_query($con,"SELECT SUM(`Valor total a Faturar`) as soma FROM `$banco`.`carteira` WHERE  `Codigo Cliente` = '$xf_login' AND `Order Type` = '$order_type' AND `Data Entrega  Revisada` BETWEEN '$data_inicio_ca' AND '$data_fim_ca'") or die(mysql_error());
	while($linha_array_ca = mysqli_fetch_assoc($query_total_ca)){$linha_ca = $linha_array_ca["soma"];$linha_ca_a += $linha_array_ca["soma"];}
	
	$total_ca = $linha_ca; 

	$total_ca = number_format($total_ca, 2, ',', '.');
#---------------------------------------------------------------------------------------------------------------------------------------------------------------------	
	
	$cliente = $xf_login;

	
	
	$sql_cliente = mysqli_query($con,"SELECT * FROM `$banco`.`login` WHERE `B` = '$cliente'");
    while ($array_s = mysqli_fetch_assoc($sql_cliente))
	{
	$cliente_loja         = $array_s["loja"];
	$cliente_email        = $array_s["email"];
	$cliente_telefone     = $array_s["telefone"];	
	$cliente_loja_grupo_b = $array_s["nome"]; 
	}


	$pedido_status = $rs["status"];
	
		if($pedido_status  == "1")   {$pedido_status = "<b class=\"laranja\" >Aberto</b>";}
		elseif($pedido_status == "2"){$pedido_status = "<b class=\"vermelho\">Pedido Enviado</b> ";}
		elseif($pedido_status == "3"){$pedido_status = "<b class=\"azul\"    >Pedido Conferido</b> ";}
		elseif($pedido_status == "4"){$pedido_status = "<b class=\"verde_e\" >Finalizado</b> ";}
		elseif($pedido_status == "6"){$pedido_status = "<b class=\"sem\"     >Sem estoque</b> ";}
		elseif($pedido_status == "7"){$pedido_status = "<b class=\"sem\"     >Atendido Parcial</b> ";}
		elseif($pedido_status == "5"){$pedido_status = "<b class=\"vermelho\">Excluido</b> ";}
	


  echo "<tr>";
    echo "<td>    $xf_login </td>";
    echo "<td>" . $cliente_loja."</td>";
    echo "<td>" . $cliente_loja_grupo_b."</td>";
	echo "<td>R$  $total </td>";
	echo "<td>R$  $total_fa </td>";
	echo "<td>R$  $total_ca </td>";
	echo "<td>$cliente_email </td>";
	echo "<td>$cliente_telefone </td>";
  echo "</tr>";
 
}


$linha_pe_e = number_format($linha_pe_e, 2, ',', '.');
$linha_fa_a = number_format($linha_fa_a, 2, ',', '.');
$linha_ca_a = number_format($linha_ca_a, 2, ',', '.');
  echo "<tr>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
	echo "<td>Total em pedidos de $var_pedido R$  $linha_pe_e </td>";
	echo "<td>Total em faturamento $var_pedido R$  $linha_fa_a</td>";
	echo "<td>Total em carteira de $var_pedido R$  $linha_ca_a</td>";
	echo "<td></td>";
	echo "<td></td>";
  echo "</tr>";


echo "</table>"; 

