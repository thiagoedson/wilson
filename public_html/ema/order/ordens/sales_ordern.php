<?php

include"conexao.php";
$npedido = $_GET["npedido"];

$query_1 = mysql_query("SELECT * FROM pedido WHERE npedido = '$npedido'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_xls = mysql_fetch_array($query_1)){	
	
	 $emxls_cliente              = $array_xls["cliente"];
	 $emxls_cliente_filho        = $array_xls["cliente_filho"];
	 $emxls_data                 = $array_xls["data_pedido"];
	
};

$corpo_npedido = mysql_query("SELECT * FROM clientes WHERE `Codigo Cliente` = '$emxls_cliente'"); 
	while($array_emp = mysql_fetch_array($corpo_npedido)){		
	  $emp_loja   = $array_emp["Cliente"];	
		}
$corpo_npedido2 = mysql_query("SELECT * FROM clientes WHERE `Codigo Cliente` = '$emxls_cliente_filho'"); 
	while($array_emp2 = mysql_fetch_array($corpo_npedido2)){		
	  $emp_loja2   = $array_emp2["Cliente"];	
		}


//consulta sql
$SQL = "SELECT DISTINCT artigo, data FROM `lista_artigo_pedido` WHERE npedido = '$npedido' ORDER BY data, artigo ";
$executa = mysql_query($SQL);


header("Content-type: text/html; charset=iso-8859-1rn");



// definimos o tipo de arquivo
header("Content-type: application/msexcel");

// Como será gravado o arquivo
#header("Content-Disposition: attachment; ilename=adisul_pedido_$npedido_$emxls_cliente.xls");

// montando a tabela

echo "Pedido elaborado por $emp_loja | $emxls_cliente para  $emp_loja2 | $emxls_cliente_filho ";

echo "<table>";
  echo "<tr>";
    echo "<td>IMG</td>";
	echo "<td>Artigo</td>";
    echo "<td>Data</td>";
    echo "<td>Quantidade</td>";
    echo "<td>Grade</td>";
    echo "<td>Valor</td>";
  echo "</tr>";

while ($rs = mysql_fetch_array($executa)){
 

  echo "<tr>";
    echo "<td><img src=\"../../thumb/". $rs["artigo"]."_F.jpg\" ></td>";
    echo "<td>" . $rs["artigo"]."</td>";
    echo "<td>" . $rs["data"]."</td>";
    echo "<td>" . $rs["quantidade"]."</td>";
    echo "<td>" . $rs["tamanho"]."</td>";
    echo "<td>" . $rs["valor"]."</td>";
  echo "</tr>";
 
}
echo "</table>"; 

?>
