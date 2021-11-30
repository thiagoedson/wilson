<?php
header("Content-type: text/html; charset=iso-8859-1rn");
include"../../conexao.php";
$npedido = $_GET["npedido"];
$var_pedido = $_GET["var"];

if($var_pedido == "3") {

$atua_total_pedido = mysql_query("UPDATE pedido_festa SET `status` = '$var_pedido'  WHERE  `npedido` = '$npedido'"); 
}
$query_1 = mysql_query("SELECT * FROM pedido_festa WHERE npedido = '$npedido'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_xls = mysql_fetch_array($query_1)){	
	
	 $emxls_cliente              = $array_xls["cliente"];
	 $emxls_data_1               = $array_xls["data_1"];
	 $emxls_data_2				 = $array_xls["data_2"];
	 $emxls_hora_1			     = $array_xls["hora_1"];
	 $emxls_hora_2               = $array_xls["hora_2"];
	 $emxls_total				 = $array_xls["total"];
	
	$emxls_total          =  number_format($emxls_total, 2, ',', '.');
	$emxls_data_1    = date('d/m/Y', strtotime(str_replace("-", "/", $emxls_data_1 )));
	$emxls_data_2    = date('d/m/Y', strtotime(str_replace("-", "/", $emxls_data_2 )));
};

$dados_login = mysql_query("SELECT  * FROM `login` WHERE  `B` = '$emxls_cliente'"); 
while($array_login = mysql_fetch_array($dados_login)){	
	
	 $nome_cliente              = $array_login["loja"];
}
//consulta sql
$SQL = "SELECT * FROM `lista_artigo_pedido_festa` WHERE `npedido` = '$npedido' ORDER BY `loja`, `data`, `artigo`, `tamanho`";
$executa = mysql_query($SQL);


header("Content-type: text/html; charset=iso-8859-1rn");



// definimos o tipo de arquivo
header("Content-type: application/msexcel");

// Como será gravado o arquivo
header("Content-Disposition: attachment; filename = $npedido-adisul_pedido_prevensa_festa_$nome_cliente.xls");

// montando a tabela
echo "
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<h1>PEDIDO #POWERPLAY festa<br />
N pedido <b style=\"color:#F00\"> $npedido</b></h1>";
echo "Pedido elaborado por $nome_cliente/$emxls_cliente.<br />
Pedido iniciado no dia $emxls_data_1 às $emxls_hora_1.<br />
Enviado e atualizado no dia $emxls_data_2 às $emxls_hora_2.<br />
Total do pedido R$ $emxls_total.
<table>
	<tr>
		<td colspan=\"4\">adisul.net</td>
	</tr>
</table> ";

echo "<table align=\"center\">";
  echo "<tr>";
    echo "<td>Loja</td>";
    echo "<td bgcolor=\"#66FF66\">Artigo</td>";
    echo "<td bgcolor=\"#66FF66\">Data</td>";
    echo "<td bgcolor=\"#66FF66\">Quantidade</td>";
    echo "<td bgcolor=\"#66FF66\">Grade</td>";
    echo "<td>Descricao</td>";
    echo "<td>Categoria</td>";
	echo "<td>Divisao</td>";
	echo "<td>Valor Uni</td>";
    echo "<td>Total</td>";
	echo "<td>----</td>";
  echo "</tr>";

while ($rs = mysql_fetch_array($executa)){
	$total = $rs["total"]; $total = str_replace(".", ",", $total);
	$valor = $rs["valor"]; $valor = str_replace(".", ",", $valor);
	$artigo_sb = $rs["artigo"];
 
	#----------------------------------------------------------------------verificar boost e springblade--------------------------------------------------
	$query_boost = mysql_query("SELECT * FROM `zk10n546_adidas`.`cota_adidas` WHERE `artigo` = '$artigo_sb'")or die(mysql_error());
	while ($boost_spring = mysql_fetch_array($query_boost)){		
		$titulo_sb = $boost_spring["legenda"];		
		}
		#-------------Condição 1 --------------------------------------------
		    if($titulo_sb == "BOOST")       {$cor_celula ="#FFFF00";}
		elseif($titulo_sb == "SPRINGBLADE") {$cor_celula ="#FF0000";}
		                               else {$cor_celula="";}
		#-------------Condição 2 --------------------------------------------
			if($titulo_sb == "") {$titulo_sb = "";}
		
		
  echo "<tr bgcolor=\"".$cor_celula."\">";
  	echo "<td>" . $rs["loja"]."</td>";
    echo "<td bgcolor=\"#66FF66\">" . $rs["artigo"]."</td>";
    echo "<td bgcolor=\"#66FF66\">" . $rs["data"]."</td>";
    echo "<td bgcolor=\"#66FF66\">" . $rs["quantidade"]."</td>";
    echo "<td bgcolor=\"#66FF66\">" . $rs["tamanho"]."</td>";	
	echo "<td>" . $rs["descricao"]."</td>";
	echo "<td>" . $rs["categoria"]."</td>";
	echo "<td>" . $rs["divisao"]."</td>";
    echo "<td>R$  $valor</td>";
    echo "<td>R$  $total </td>";
	echo "<td bgcolor=\"".$cor_celula."\">" . $titulo_sb ."</td>";
  echo "</tr>";
 $titulo_sb = "";
}
echo "</table>

"; 

?>