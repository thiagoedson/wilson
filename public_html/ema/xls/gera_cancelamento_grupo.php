<?php

session_start();

include"../conexao.php";
$senha = $_SESSION["codigo"];

$query_1 = mysql_query("SELECT `nome`,`status` FROM login WHERE `B` = '$senha'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_1 = mysql_fetch_array($query_1)){	
	
	$grupo = $array_1["nome"];
	$status = $array_1["status"];
};
if($status == "3") {echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../fail_2.html'>"; exit;}
if($status == "2") {echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../fail_2.html'>"; exit;}


//consulta sql
$SQL = "select * FROM `cancelamento` INNER JOIN `login` ON `cancelamento`.`Codigo Cliente` = `login`.`B` WHERE `login`.`nome` = '$grupo'  ORDER BY `Codigo Cliente` , `Data de Entrega`";
$executa = mysql_query($SQL);


header("Content-type: text/html; charset=iso-8859-1rn");



// definimos o tipo de arquivo
header("Content-type: application/msexcel");

// Como será gravado o arquivo
header("Content-Disposition: attachment; filename=cancelamento_grupo_$grupo.xls");

// montando a tabela
echo "<table border=\"1px\">";
  echo "<tr bgcolor=\"#999999\">";
    echo "<td>Nome do Cliente</td>";
    echo "<td>Cod Cliente</td>";
    echo "<td>Colecao</td>";
    echo "<td>N Pedido</td>";
    echo "<td>Artigo</td>";
    echo "<td>Nome do Artigo</td>";
    echo "<td>Data de Entrega</td>";
    echo "<td>Data do Cancelamento</td>";
    echo "<td>Grade</td>";
    echo "<td>Qt Cancelada</td>";    
    echo "<td>Razao</td>";
  echo "</tr>";

while ($rs = mysql_fetch_array($executa)){

$rs["Grade"] = str_replace("L" , "G" , $rs["Grade"] );
$rs["Grade"] = str_replace("S" , "P" , $rs["Grade"] );
$rs["Grade"] = str_replace("XG" , "GG" , $rs["Grade"] );
$rs["Grade"] = str_replace("XP" , "PP" , $rs["Grade"] );

  echo "<tr>";
    echo "<td>" . $rs["Nome do Cliente"]."</td>";
    echo "<td>" . $rs["Codigo Cliente"]."</td>";
    echo "<td>" . $rs["Order Type"]."</td>";
    echo "<td>" . $rs["Numero Pedido"] ."</td>";
    echo "<td>" . $rs["Codigo Artigo"]."</td>";
    echo "<td>" . $rs["Descricao do Artigo"]."</td>";
    echo "<td>" . $rs["Data de Entrega"] . "</td>";
    echo "<td>" . $rs["Data de  Cancelamento"] . "</td>";
    echo "<td>" . $rs["Grade"] . "</td>";
    echo "<td>" . $rs["Qtde  Cancelada"] . "</td>";
    echo "<td>" . $rs["Razao"] . "</td>";   
  echo "</tr>";
 
}
echo "</table>"; 

?>
