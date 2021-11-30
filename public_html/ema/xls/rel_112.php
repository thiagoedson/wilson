<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
</head>

<body>
<?php

session_start();
include"../conexao.php";
$senha = $_GET["codigo"];
$tabela = "pedido";

$query_1 = mysql_query("SELECT `nome` FROM login WHERE `B` = '$senha'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_1 = mysql_fetch_array($query_1)){	
	
	$grupo = $array_1["nome"];
	
};


//consulta sql
$SQL = "SELECT * FROM `$tabela` INNER JOIN `login` ON `$tabela`.`cliente` = `login`.`B` WHERE `login`.`nome` = '$grupo' ORDER BY `cliente` , `data_pedido`";
$executa = mysql_query($SQL);


header("Content-type: text/html; charset=iso-8859-1rn");



// definimos o tipo de arquivo
header("Content-type: application/msexcel");

// Como será gravado o arquivo
header("Content-Disposition: attachment; filename=carteira_grupo_$grupo.xls");

// montando a tabela
echo "<table border=\"1px\">";
  echo "<tr bgcolor=\"#999999\">";
    echo "<td>Id</td>";
    echo "<td>N Pedido</td>";
    echo "<td>Cod Cliente</td>";
    echo "<td>Cod Cliente Desti</td>";
    echo "<td>Total</td>";
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

 $categoria = $rs["cliente_filho"];



  echo "<tr>";
    echo "<td>" . $rs["id"]."</td>";
    echo "<td>" . $rs["npedido"]."</td>";
    echo "<td>" . $rs["cliente"]."</td>";
    echo "<td>" . $categoria ."</td>";
    echo "<td>" . $rs["total"]."</td>";
    echo "<td>" . $rs["Order Type"]."</td>";
    echo "<td>" . $rs["Descricao Artigo"] . "</td>";
    echo "<td>" . $rs["Qtde Total a Faturar"] . "</td>";
    echo "<td>" . $rs["Data Entrega  Revisada"] . "</td>";
    echo "<td>" . $rs["Status do pedido"] . "</td>";
    echo "<td>" . $rs["Numero do Pedido"] . "</td>";
  echo "</tr>";
 
}
echo "</table>"; 

?>

</body>
</html>