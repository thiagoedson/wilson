<?php
session_start();
include"conexao.php";
include"dire.php";

#-------- Nome do Arquivo--------------------------------------

$divisao = $_GET["divisao"];
$senha = $_SESSION["codigo"];
$filtro = $_GET["filtro"];
$arquivo = "sellout" . gmdate("D-d-M YH:i:s") . ".xls";

#--------------------------------------------------------------
 
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

if($divisao == "footwear") {
	
	$texto = "<h1>ADISUL</h1>
			<p>Sellout - Data do relatório ".date('d/m/Y')."</p>
		  <h6>Grupo <b style=\"color:#F00\">$grupo</b></h6>
		  <p>Este relatório é uma cópia retirada do site adisul.com, os dados aqui apresentados estão relacionados aos relatórios contidos<br>
no site na data acima.</p><hr/>";

	}	
elseif($var_pedido == "hardware") {	
	$texto = "<h1>ADISUL</h1>
			<p>Sellout - Data do relatório ".date('d/m/Y')."</p>
		  <h6>Grupo <b style=\"color:#F00\">$grupo</b></h6>
		  <p>Este relatório é uma cópia retirada do site adisul.com, os dados aqui apresentados estão relacionados aos relatórios contidos<br>
no site na data acima.</p><hr/>";

	
	}
elseif($var_pedido == "Apparel") {	
	$texto = "<h1>ADISUL</h1>
			<p>Sellout - Data do relatório ".date('d/m/Y')."</p>
		  <h6>Grupo <b style=\"color:#F00\">$grupo</b></h6>
		  <p>Este relatório é uma cópia retirada do site adisul.com, os dados aqui apresentados estão relacionados aos relatórios contidos<br>
no site na data acima.</p><hr/>";

	
	}
	
	echo $texto;
	
echo "<table>";
  echo "<tr>";   
    echo "<td>Divisao</td>";
    echo "<td>Produto</td>";
    echo "<td>Descrição</td>";
    echo "<td>Estoque do mês anterior</td>";   
    echo "<td>Vendas do mês anterior</td>";
    echo "<td>Quantidade Carteira</td>";
	echo "<td>Próximo Recebimento</td>";
	echo "<td>Data do Último Faturamento</td>";
	echo "<td>Disponibilidade Pronta Entrega</td>";
	echo "<td>Promocional Pronta Entrega</td>";
  echo "</tr>";

$query_1 = mysql_query("SELECT * FROM `$banco`.`tree` WHERE  `grupo` = '$grupo' AND `Divisao` = '$divisao' ORDER BY $filtro DESC") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_xls = mysql_fetch_array($query_1)){	
	
	  $artigo       = $array_xls["artigo"];
	  $divisao      = $array_xls["Divisao"];
	  $cliente      = $array_xls["cliente"];
	  $vendas       = $array_xls["venda"];
	  $estoque      = $array_xls["estoque"];
	#------ 2º Estágio ------ do relatório---------------------------------------------------------------
	$query_tree_1 = mysql_query("SELECT SUM(`Qtde Total a Faturar`) as soma FROM `$banco_representante`.`carteira` INNER JOIN `$banco_representante`.`login` ON `carteira`.`Codigo Cliente` = `login`.`B` WHERE `login`.`nome` = '$grupo' AND `Codigo Artigo` = '$artigo'");
								
    while($array_tree_1 = mysql_fetch_array($query_tree_1)){	
	  $qt_carteira       = $array_tree_1["soma"];  
	 
	};
	#------ 3 ºDescricao ------ do relatório---------------------------------------------------------------
	$query_tree_4 = mysql_query("SELECT * FROM `$banco_representante`.`artigos_sas` WHERE `ArticleNo` = '$artigo'");
    while($array_tree_4 = mysql_fetch_array($query_tree_4)){	
	  $descricao       = $array_tree_4["Text48"];  	 
	};
	
	 if( $descricao == "") { $descricao = "?";}
	
	#------ 4º Estágio ------ do relatório---------------------------------------------------------------
	$query_tree_2 = mysql_query("SELECT * FROM `$banco_representante`.`faturamento` INNER JOIN `$banco_representante`.`login` ON `faturamento`.`Codigo Cliente` = `login`.`B` WHERE `login`.`nome` = '$grupo' AND `Codigo Artigo` = '$artigo' ORDER BY `Data Emissao NF` ASC LIMIT 0,1");
	
	
    while($array_tree_2 = mysql_fetch_array($query_tree_2)){	
	  $qt_faturada       = $array_tree_2["Data Emissao NF"];  
	  
	  if($qt_faturada == "") {$qt_faturada = "";} else { 
	  
	  $qt_faturada = date('d/m/Y', strtotime(str_replace("-", "/", $qt_faturada )));}
	 
	};
	#------ 8º Estágio ------ do relatório---------------------------------------------------------------
	$query_tree_7 = mysql_query("SELECT `Data Entrega  Revisada` FROM `$banco_representante`.`carteira` INNER JOIN `$banco_representante`.`login` ON `carteira`.`Codigo Cliente` = `login`.`B` WHERE `login`.`nome` = '$grupo' AND `Codigo Artigo` = '$artigo' ORDER BY `Data Entrega  Revisada` ASC LIMIT 1");
	
	
    while($array_tree_7 = mysql_fetch_array($query_tree_7)){	
	  $data_carteira       = $array_tree_7["Data Entrega  Revisada"];  
	  
	  if($data_carteira == "") {$data_carteira = "";} else { 
	  
	  $data_carteira = date('d/m/Y', strtotime(str_replace("-", "/", $data_carteira )));}
	 
	};
	#------ 5º Estágio ------ do relatório---------------------------------------------------------------
	$query_tree_5 = mysql_query("SELECT `Artigo`  FROM `$banco_representante`.`dispo_ss12` WHERE `Artigo` = '$artigo'");
	
    $qt_loja = mysql_num_rows($query_tree_5); // Quantidade de registros pra paginação
	
	if($qt_loja <> "") $qt_loja = "Produto disponível a Pronta-Entrega";
	else {$qt_loja = "";}
	#------ 6º Estágio ------ do relatório---------------------------------------------------------------
	$query_tree_6 = mysql_query("SELECT `Artigo`  FROM `$banco_representante`.`dispo_cle12012` WHERE `Artigo` = '$artigo'");   
	
	if($qt_lojaa <> "") $qt_lojaa = "Produto disponível a Pronta Entrega(CLE 1)";
	else {$qt_lojaa = "";}
	
	#------ 7º Estágio ------ do relatório---------------------------------------------------------------  
	
	 if($qt_carteira == "") {$qt_carteira = "-";}
	 if($data_carteira == "") {$data_carteira = "-";}
     if($qt_faturada == "") {$qt_faturada = "anterior à 2011";}
	 if($descricao == "") {$descricao = "?";}
	 
	 $descricao = utf8_decode($descricao);
	 $artigo = strtoupper($artigo);
	 
	//Definindo Variável


	 
	echo "<tr>";
	  echo"<td>".$divisao."</td>";
	  echo"<td>".$artigo."</td>";
	  echo"<td>".$descricao."</td>";
	  echo"<td>".$estoque."</td>";
	  echo"<td>".$vendas."</td>";
	  echo"<td>".$qt_carteira."</td>";
	  echo"<td>".$data_carteira."</td>";
	  echo"<td>".$qt_faturada."</td>";
	  echo"<td>".$qt_loja."</td>";
	  echo"<td>".$qt_lojaa."</td>";
	echo"</tr>";
	
// aqui voce incrementa mais 1 na variavel
$i++;
$descricao = "?";
$data_carteira = "";
$qt_faturada = "";
}

echo "</table>";
?>

    

