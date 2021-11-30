<?php

include"conexao.php";
$npedido = $_GET["npedido"];
$var_pedido = $_GET["var"];

if($var_pedido == "3") {

$atua_total_pedido = mysql_query("UPDATE prevendafw12 SET `status` = '$var_pedido'  WHERE  `npedido` = '$npedido'"); 
}
$query_1 = mysql_query("SELECT * FROM prevendafw12 WHERE npedido = '$npedido'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_xls = mysql_fetch_array($query_1)){	
	
	 $emxls_cliente              = $array_xls["cliente"];
	 $emxls_cliente_filho        = $array_xls["cliente_filho"];
	 $emxls_data                 = $array_xls["data_pedido"];
	
};

$corpo_npedido = mysql_query("SELECT loja FROM login WHERE `B` = '$emxls_cliente'"); 
	while($array_emp = mysql_fetch_array($corpo_npedido)){		
	  $emp_loja   = $array_emp["loja"];	
		}
$corpo_npedido2 = mysql_query("SELECT loja FROM login WHERE `B` = '$emxls_cliente_filho'"); 
	while($array_emp2 = mysql_fetch_array($corpo_npedido2)){		
	  $emp_loja2   = $array_emp2["loja"];	
		}


//consulta sql
$SQL = "SELECT * FROM `lista_artigo_pedido_fw12` WHERE npedido = '$npedido' ORDER BY data, artigo ";
$executa = mysql_query($SQL);


header("Content-type: text/html; charset=iso-8859-1rn");



// definimos o tipo de arquivo
header("Content-type: application/msexcel");

// Como será gravado o arquivo
header("Content-Disposition: attachment; filename=adisul_pedido_$emxls_cliente_$npedido.xls");

// montando a tabela
echo "<h1>PEDIDO PREVENDA FW12<br />
N pedido <b style=\"color:#F00\"> $npedido</b></h1>";
echo "Pedido elaborado por $emp_loja | $emxls_cliente para  $emp_loja2 | $emxls_cliente_filho ";

echo "<table>";
  echo "<tr>";
    echo "<td>Artigo</td>";
    echo "<td>Data</td>";
    echo "<td>Quantidade</td>";
    echo "<td>Grade</td>";
    echo "<td>Valor Uni/SP</td>";
    echo "<td>Total/SP</td>";
  echo "</tr>";

while ($rs = mysql_fetch_array($executa)){
	$total = $rs["total"]; $total = str_replace(".", ",", $total);
	$valor = $rs["valor"]; $valor = str_replace(".", ",", $valor);
 


  echo "<tr>";
    echo "<td>" . $rs["artigo"]."</td>";
    echo "<td>" . $rs["data"]."</td>";
    echo "<td>" . $rs["quantidade"]."</td>";
    echo "<td>" . $rs["tamanho"]."</td>";
    echo "<td>R$  $valor</td>";
    echo "<td>R$  $total </td>";
  echo "</tr>";
 
}
echo "</table>"; 

?>
