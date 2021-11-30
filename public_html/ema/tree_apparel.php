<?php
session_start();
header('Content-type: text/html; charset=utf-8');
include "dire.php";
$senha = $_SESSION["codigo"];
$divisao = "apparel";
$filtro = $_GET["filtro"];

$asc = "DESC";

if($filtro == "") {$filtro = "venda";}
elseif($filtro == "Descricao") {$asc = "ASC";}

$verifica = mysql_query("SELECT * FROM `$banco_representante`.`tree` WHERE `grupo` = '$grupo'");
while ($array_var = mysql_fetch_array($verifica)) {

	$tree_grupo = $array_var["grupo"];
}
if($tree_grupo <> $grupo) { echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=thoor.php?var=4'>"; }
elseif($tree_grupo == "") { echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=thoor.php?var=3'>"; }
else {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>adisul.com</title>
<link href="img/Adidas.ico" rel="shortcut icon" type="image/x-icon" />
<link type="text/css" href="menu.css" rel="stylesheet" />
<link type="text/css" href="coin-slider-styles.css" rel="stylesheet" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="menu.js"></script>
<script type="text/javascript" src="coin-slider.min.js"></script>
<script type="text/javascript" src="coin-slider.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<style type="text/css" media="all">
@import url("estilo.css");
</style>
</head>
<body><?php echo $menu_principal ;?>


  <div id="tree">  
  
  <div id="menu_tree">
  <a href="tree_footwear.php?filtro=venda" class="new_tree">Calçado</a>
  <a href="tree_apparel.php?filtro=venda" class="new_tree" style="background-color:#009;">Têxtil</a>
  <a href="tree_hardware.php?filtro=venda" class="new_tree">Equipamento</a>
  <a href="tree_meia.php?filtro=venda" class="new_tree">Meia</a>
  <a href="tree_other.php?filtro=venda" class="new_tree">Outros</a> </div>
<?php
function verifica($tabelaaaa) { 
if(mysql_query("SELECT * FROM `$banco_representante`.`$tabelaaaa`")) { 
echo "<p class=\"msg_3\"><img src=\"img/msg_3.jpg\"><br /><br />

Estamos atualizando o banco de dados , dentro de instantes estaremos de volta</p>"; 
exit;
} else { 
$msg_4 = "<center>Somente com os dados atualizados podemos garantir melhor precisão deste relatório, procure seu representante para quaisquer dúvidas.<br />
<br />

</center><br />
<br />
";
echo $msg_4; 

} 
} 

verifica("tree"); 

?>
<div id="grafi">
<?php 
$tr_mysql = mysql_query("SELECT SUM(`estoque`) as soma FROM `$banco_representante`.`tree` WHERE `grupo` = '$grupo' AND `Divisao` = '$divisao'");
        
      while($array_tr = mysql_fetch_array($tr_mysql)){	
	  $tr_total       = $array_tr["soma"];  // Quantidade de registros pra paginação
	  }
$tl_mysql = mysql_query("SELECT SUM(`venda`) as soma FROM `$banco_representante`.`tree` WHERE `grupo` = '$grupo' AND `Divisao` = '$divisao'");
        
      while($array_tl = mysql_fetch_array($tl_mysql)){	
	  $tr_venda  = $array_tl["soma"];  // Quantidade de registros pra paginação
	  }

?>
Total de produtos em estoque :<?php echo $tr_total;?><br />
Total de vendas :<?php echo $tr_venda ;?><br />


</div>
<center>
<form action="<?php echo $PHP_SELF; ?>" method="get">
Escolha o Filtro: <select name="filtro">
		    
                    <option <?php if($filtro  == "venda")         {echo "selected=\"selected\" ";}?> value="venda">Vendas</option>
                    <option <?php if($filtro  == "estoque")       {echo "selected=\"selected\" ";}?> value="estoque">Estoque</option>
                    <option <?php if($filtro  == "artigo")        {echo "selected=\"selected\" ";}?> value="Descricao">Nome</option>
                  </select>
                  <input type="submit" value="Aplicar Filtro" style="padding:3px;" /> 
</form>
</center>
  <table class="tabela">
    <tr class="realceLinha">
      <td class="coluna11">Produto</td><td class="coluna7">Artigo</td><td class="coluna6">Descrição</td><td class="coluna5">Estoque<br /> mês <br />anterior</td><td class="coluna4">Vendas <br /> mês <br />anterior</td><td class="coluna3">Quantidde/<br /> Carteira</td><td class="coluna2">Próximo<br />recebimento</td><td class="coluna1">Data <br /> último <br />Faturamento</td><td class="coluna9">Repor<br />Agora</td><td class="coluna10">Promocional<br />Disponível</td>
    </tr>
    
    <?php
	

	//######### INICIO Paginação
        $numreg = 40; // Quantos registros por página vai ser mostrado
        if (!isset($pg)) {
                $pg = 0;
        }
      #  $inicial = $pg * $numreg;
		$inicial = @$_GET['pg'] * $numreg;
        
//######### FIM dados Paginação
        
        // Faz o Select pegando o registro inicial até a quantidade de registros para página
        $sql = mysql_query("SELECT * FROM `$banco_representante`.`tree` WHERE `grupo` = '$grupo' AND `Divisao` = '$divisao' ORDER BY `$filtro` $asc LIMIT $inicial, $numreg");

        // Serve para contar quantos registros você tem na seua tabela para fazer a paginação
        $sql_conta = mysql_query("SELECT * FROM `$banco_representante`.`tree` WHERE `grupo` = '$grupo' AND `Divisao` = '$divisao'");
        
        $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
        
        include("paginacao.php"); // Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >>
        
        echo "<br><br>"; // Vai servir só para dar uma linha de espaço entre a paginação e o conteúdo
        
        while ($array_tree = mysql_fetch_array($sql)) {
                /* Ai o resto é com voces em montar como deve parecer o conteúdo */
      	$i = 1;
if (($i % 2) == 1){ $fundo="white"; }else{ $fundo="#F3F3F3"; }
	  $artigo       = $array_tree["artigo"];
	  $cliente      = $array_tree["cliente"];
	  $vendas       = $array_tree["venda"];
	  $estoque      = $array_tree["estoque"];
	#------ 2º Estágio ------ do relatório---------------------------------------------------------------
	$query_tree_1 = mysql_query("SELECT SUM(`Qtde Total a Faturar`) as soma FROM `$banco_representante`.`carteira` INNER JOIN `$banco_representante`.`login` ON `carteira`.`Codigo Cliente` = `login`.`B` WHERE `login`.`nome` = '$grupo' AND `Codigo Artigo` = '$artigo'");
								
    while($array_tree_1 = mysql_fetch_array($query_tree_1)){	
	  $qt_carteira       = $array_tree_1["soma"];  
	 
	};
	#------ 3 ºDescricao ------ do relatório---------------------------------------------------------------
	$query_tree_4 = mysql_query("SELECT * FROM `adisu724_adidas`.`artigos_sas` WHERE `ArticleNo` = '$artigo'");
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
	$query_tree_5 = mysql_query("SELECT `Artigo`  FROM `adisu724_adidas`.`dispo_ss123` WHERE `Artigo` = '$artigo'");
	
    $qt_loja = mysql_num_rows($query_tree_5); // Quantidade de registros pra paginação
	
	if($qt_loja <> "") $qt_loja = "<a href=\"shop/ss12/shop.php?artigo=".$artigo."\" title=\"Produto Disponível para Pronta-entrega\" target=\"_blank\"><img src=\"img/buy.png\" title=\"Comprar a pronta entrega\" target=\"_blank\" /></a>";
	else {$qt_loja = "";}
	#------ 6º Estágio ------ do relatório---------------------------------------------------------------
	$query_tree_6 = mysql_query("SELECT `Artigo`  FROM `adisu724_adidas`.`dispo_cle120122` WHERE `Artigo` = '$artigo'");
	
    $qt_lojaa = mysql_num_rows($query_tree_6); // Quantidade de registros pra paginação
	
	if($qt_lojaa <> "") $qt_lojaa = "<a href=\"shop/promo/shop.php?artigo=".$artigo."\" title=\"Produto Disponível para Pronta-entrega\" target=\"_blank\"><img src=\"img/buy_cle.png\" title=\"Comprar produto em promoção\" /></a>";
	else {$qt_lojaa = "";}
	
	#------ 7º Estágio ------ do relatório---------------------------------------------------------------  
	#------ 11º Estágio ------ do relatório---------------------------------------------------------------
	$query_tree_11 = mysql_query("SELECT *  FROM `adisu724_adidas`.`tabela` WHERE `Artigo` = '$artigo'");
	
    $qt_tabela = mysql_num_rows($query_tree_11); // Quantidade de registros pra paginação
	
	if($qt_tabela <> "") $qt_tabela = "<b style=\"color:#F00;\">Em linha</b>";
	else {$qt_tabela = "";}
	
	#---------------------------------------------------------------------------------------------------------
	
	 if($qt_carteira == "") {$qt_carteira = "-";}
	 if($data_carteira == "") {$data_carteira = "-";}
     if($qt_faturada == "") {$qt_faturada = "anterior à 2011";}
	 if($descricao == "") {$descricao = "?";}
	 
	 $descricao = utf8_decode($descricao);
	 $artigo = strtoupper($artigo);
	 
	//Definindo Variável


	 
	echo "<tr  class=\"realceLinha\"><td class=\"coluna11\"><img src=\"http://www.adisul.com/thumb/".$artigo."_F.jpg\" width=\"60px\" height=\"50px\" /></td><td class=\"coluna7\">".$artigo."
	<br />
	$qt_tabela</td><td class=\"coluna6\">".$descricao."</td><td class=\"coluna5\">".$estoque."</td><td class=\"coluna4\">".$vendas."</td><td class=\"coluna3\">".$qt_carteira."</td><td class=\"coluna2\">".$data_carteira."</td><td class=\"coluna1\">".$qt_faturada."</td><td class=\"coluna9\">".$qt_loja."</td><td class=\"coluna10\">".$qt_lojaa."</td></tr>";
	
// aqui voce incrementa mais 1 na variavel
$i++;
$descricao = "?";
$data_carteira = "";
$qt_faturada = "";
}
?>

    </table>
  </div>

</div>
</body>
</html>
<?php
;}
?>