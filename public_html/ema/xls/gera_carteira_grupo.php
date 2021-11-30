<?php
session_start();
include"../conexao.php";
$senha = $_SESSION["codigo"];

$query_1 = mysql_query("SELECT `nome` FROM login WHERE `B` = '$senha'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_1 = mysql_fetch_array($query_1)){	
	
	$grupo = $array_1["nome"];
	
};


//consulta sql
$SQL = "select * FROM `carteira` INNER JOIN `login` ON `carteira`.`Codigo Cliente` = `login`.`B` WHERE `login`.`nome` = '$grupo' AND `Data Entrega  Revisada` BETWEEN '2011-01-01' AND '2011-12-30' ORDER BY `Codigo Cliente` , `Data Entrega  Revisada`, `Descricao Artigo` ";
$executa = mysql_query($SQL);


header("Content-type: text/html; charset=iso-8859-1rn");



// definimos o tipo de arquivo
header("Content-type: application/msexcel");

// Como será gravado o arquivo
header("Content-Disposition: attachment; filename=carteira_grupo_$grupo.xls");

// montando a tabela
echo "<table border=\"1px\">";
  echo "<tr bgcolor=\"#999999\">";
    echo "<td>Cliente</td>";
    echo "<td>Cod Cliente</td>";
    echo "<td>Cidade</td>";
    echo "<td>Categoria</td>";
    echo "<td>Artigo</td>";
    echo "<td>Colecao</td>";
    echo "<td>Nome do Artigo</td>";
    echo "<td>Qt</td>";
    echo "<td>Total</td>";
    echo "<td>Quantidade por tamanho</td>";
    echo "<td>Entrega Revisada</td>";
    echo "<td>Status</td>";
    echo "<td>N Pedido</td>";
    echo "<td>OBS</td>";
  echo "</tr>";

while ($rs = mysql_fetch_array($executa)){
 $varivel = $rs["Qtde por Tamanho"];
 $varivel = str_replace("/", ";",  $varivel);

 $valor_total = $rs["Valor total a Faturar"];
 $valor_total = str_replace(",", ".",  $valor_total);
 $valor_total =  number_format($valor_total, 2, ',', '.');
 $valor_toral = "R$ ".$valor_total;

$categoria = $rs["Categoria"];

if (strstr($categoria, "Footwear")) {$categoria = "Calcado";}
if (strstr($categoria, "Apparel")) {$categoria = "Textil";}
if (strstr($categoria, "Hardware")) {$categoria = "Equip";}

$rs["Qtde por Tamanho"] = str_replace("L" , "G" , $rs["Qtde por Tamanho"] );
$rs["Qtde por Tamanho"] = str_replace("S" , "P" , $rs["Qtde por Tamanho"] );
$rs["Qtde por Tamanho"] = str_replace("XG" , "GG" , $rs["Qtde por Tamanho"] );
$rs["Qtde por Tamanho"] = str_replace("XP" , "PP" , $rs["Qtde por Tamanho"] );

  echo "<tr>";
    echo "<td>" . $rs["Cliente"]."</td>";
    echo "<td>" . $rs["Codigo Cliente"]."</td>";
    echo "<td>" . $rs["Cidade"]."</td>";
    echo "<td>" . $categoria ."</td>";
    echo "<td>" . $rs["Codigo Artigo"]."</td>";
    echo "<td>" . $rs["Order Type"]."</td>";
    echo "<td>" . $rs["Descricao Artigo"] . "</td>";
    echo "<td>" . $rs["Qtde Total a Faturar"] . "</td>";
    echo "<td>" . $valor_toral . "</td>";
    echo "<td>" . $varivel . "</td>";
    echo "<td>" . $rs["Data Entrega  Revisada"] . "</td>";
    echo "<td>" . $rs["Status do pedido"] . "</td>";
    echo "<td>" . $rs["Numero do Pedido"] . "</td>";
    echo "<td>" . $rs["Observacao do Pedido"] . "</td>";
  echo "</tr>";
 
}
echo "</table>"; 

?>
