<?php
include"../conexao.php";
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
$SQL = "SELECT DISTINCT artigo, data, Descricao FROM `lista_artigo_pedido` WHERE npedido = '$npedido' ORDER BY data, artigo ";
$executa = mysql_query($SQL);
header("Content-type: text/xhtml; charset=utf-8");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
// definimos o tipo de arquivo
header('Content-type: application/vnd.ms-word');
// Como será gravado o arquivo
header('Content-Disposition: attachment; filename="sales_orden_adisul.doc"');
// montando a tabela
echo "<h1 style=\"font-style:verdana;\"><img src=\"http://adisul.com/img/header.png\" title=\"ADISUL\" /></h1><br/><hr/>";
echo "Pedido elaborado por $emp_loja | $emxls_cliente para  $emp_loja2 | $emxls_cliente_filho ";
echo "<table>";
  echo "<tr>";
    echo "<td>-</td>";
	echo "<td  align=\"center\">Artigo</td>";
	echo "<td  align=\"center\">Descricao</td>";
    echo "<td  align=\"center\">Data</td>";
    echo "<td  align=\"center\">Quantidade</td>";    
    echo "<td  align=\"center\">Valor</td>";
  echo "</tr>";  
  while (
  
  	   $rs = mysql_fetch_array($executa)){	   
	   $valor_total = $rs["total"];	   
	   $valor_total = $valor_total * $sul;	   
	   $valor_total =  number_format($valor_total, 2, ',', '.');
	   $valor_total = "R$ ".$valor_total;
	   $data    = $rs["data"];
	   $data    = date('d/m/Y', strtotime(str_replace("-", "/", $data )));	  	   
	   $artigo = $rs["artigo"]; 	   
	   $descri = "SELECT * FROM `lista_artigo_pedido` WHERE npedido = '$npedido' AND artigo = '$artigo' ORDER BY data, artigo ";	   
	   $executaa = mysql_query($descri);	   
	   while ($rsw = mysql_fetch_array($executaa)){	   
	   $descricao = $rsw["descricao"];		   
	   $query_total_pe = mysql_query("SELECT SUM(total) as soma FROM  lista_artigo_pedido  WHERE  `npedido` = '$npedido' AND `artigo` = '$artigo'") or die(mysql_error());
	   while($linha_array_pe = mysql_fetch_array($query_total_pe)){$linha_pe = $linha_array_pe["soma"];}	   
	   $linha_pe = $linha_pe * 0.95;	   
	   $linha_pe        =  number_format($linha_pe, 2, ',', '.');		   
	   $linha_pe = "R$  ".$linha_pe;	   
	   $query_total_qt = mysql_query("SELECT SUM(quantidade) as soma FROM  lista_artigo_pedido  WHERE  `npedido` = '$npedido' AND `artigo` = '$artigo'") or die(mysql_error());
	   while($linha_array_qt = mysql_fetch_array($query_total_qt)){$linha_qt = $linha_array_qt["soma"];}
		}	
		
  echo "<tr>";
    echo "<td><img src=\"http://adisul.com/thumb/".$rs["artigo"]."_F.jpg\"></td>";
    echo "<td  align=\"center\">" .$rs["artigo"]."</td>";
    echo "<td  align=\"center\">" .$data."</td>";
	echo "<td  align=\"center\">" .$descricao."</td>";
    echo "<td  align=\"center\">" .$linha_qt."</td>";
    echo "<td  align=\"center\">" .$linha_pe. "</td>";
  echo "</tr>"; 
}
echo "</table>"; 

?>
