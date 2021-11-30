<?php
session_start();
include"../conexao.php";
$senha = $_SESSION["codigo"];


//consulta sql
$SQL = "select * from carteira WHERE `Codigo Cliente` = '$senha' AND `Data Entrega  Revisada` BETWEEN '2011-01-01' AND '2011-12-30' ORDER BY `Data Entrega  Revisada`";
$executa = mysql_query($SQL);


header("Content-type: text/html; charset=iso-8859-1rn");



// definimos o tipo de arquivo
header("Content-type: application/msexcel");

// Como será gravado o arquivo
header("Content-Disposition: attachment; filename=carteira_loja_$senha.xls");

// montando a tabela
echo "<table border =\"1px\">";
  echo "<tr>";
    echo "<td>Artigo</td>";
    echo "<td>Colecao</td>";
    echo "<td>Nome do Artigo</td>";
    echo "<td>Qt</td>";
    echo "<td>Total</td>";
    echo "<td>Quantidade por tamanho</td>";
    echo "<td>Entrega Revisada</td>";
    echo "<td>Status</td>";
    echo "<td>N Pedido</td>";
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
 

  echo "<tr>";
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
  echo "</tr>";
 
}
echo "</table>"; 

?>
