<?php

session_start();
include"../conexao.php";
$senha = $_SESSION["codigo"];
$date_atual = date("Y-m-d");
$date_6mes  = date('Y-m-d',strtotime("-6 MONTH"));

//consulta sql
$SQL = "select * from cancelamento WHERE `Codigo Cliente` = '$senha' AND `Data de  Cancelamento` BETWEEN '$date_6mes' AND '$date_atual' ORDER BY `Data de Entrega`";
$executa = mysql_query($SQL);


header("Content-type: text/html; charset=utf-8");



// definimos o tipo de arquivo
header("Content-type: application/msexcel");

// Como será gravado o arquivo
header("Content-Disposition: attachment; filename=cancelamento_loja_$senha.xls");



// montando a tabela
echo "<table border\"1px\">";
  echo "<tr>";
    echo "<td>Artigo</td>";
    echo "<td>Nome do Artigo</td>";
    echo "<td>Qt</td>";
    echo "<td>Grade</td>";
    echo "<td>Data do Cancelamento</td>";
    echo "<td>Entrega Revisada</td>";
    echo "<td>Motivo</td>";
   
  echo "</tr>";

while ($rs = mysql_fetch_array($executa)){
  echo "<tr>";
    echo "<td>" . $rs["Codigo Artigo"]."</td>";
    echo "<td>" . $rs["Descricao do Artigo"]."</td>";
    echo "<td>" . $rs["Qtde  Cancelada"] . "</td>";
    echo "<td>" . $rs["Grade"] . "</td>";
    echo "<td>" . $rs["Data de  Cancelamento"] . "</td>";
    echo "<td>" . $rs["Data de Entrega"] . "</td>";
    echo "<td>" . $rs["Razao"] . "</td>";
    
  echo "</tr>";
 
}
echo "</table>"; 

?>
