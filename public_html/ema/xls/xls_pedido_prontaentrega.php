<?php
include"../conexao.php";
$npedido = $_GET["npedido"];
$p_pedido = $_GET["npedido"];
$var_pedido = $_GET["var"];
$sul = 1;
$query_1 = mysql_query("SELECT * FROM pedido_prontaentrega WHERE npedido = '$npedido'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_xls = mysql_fetch_array($query_1)){	
	
	 $emxls_cliente              = $array_xls["cliente"];
	 $senha 					 = $array_xls["cliente"];
	 $emxls_data_1               = $array_xls["data_1"];
	 $emxls_data_2				 = $array_xls["data_2"];
	 $emxls_hora_1			     = $array_xls["hora_1"];
	 $emxls_hora_2               = $array_xls["hora_2"];
	 $emxls_total				 = $array_xls["total"];
	 $emxls_obs 				 = $array_xls["obs"];
	
	$emxls_total          =  number_format($emxls_total, 2, ',', '.');
	$emxls_data_1    = date('d/m/Y', strtotime(str_replace("-", "/", $emxls_data_1 )));
	$emxls_data_2    = date('d/m/Y', strtotime(str_replace("-", "/", $emxls_data_2 )));
};

$dados_login = mysql_query("SELECT  * FROM `login` WHERE  `B` = '$emxls_cliente'"); 
while($array_login = mysql_fetch_array($dados_login)){	
	
	 $nome_cliente              = $array_login["loja"];
}
//consulta sql

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public", false);
header("Content-Description: PHP Generated Data" );
header("Content-type: application/msword" );
header("Content-Disposition: attachment; filename=\"$npedido-$emxls_cliente-adisul_pedido_prontaentrega_$nome_cliente.doc\";");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

$texto_cond = $_GET["style"];

if($texto_cond == "3") {$texto_cond = "CÓPIA DO PEDIDO EM ABERTO PRONTA-ENTREGA";}
                  else {$texto_cond = "PEDIDO PRONTA-ENTREGA";}


// montando a tabela
echo "<font size=\"-1\">";
echo "<h2>$texto_cond<br />
Nº pedido <b style=\"color:#F00\"> $npedido</b></h2>";
echo "Pedido elaborado por $nome_cliente/$emxls_cliente.<br />
Pedido iniciado no dia $emxls_data_1 às $emxls_hora_1.<br />
Enviado e atualizado no dia $emxls_data_2 às $emxls_hora_2.<br />
Total do pedido R$ $emxls_total.<br />
<br />
<b style=\"color:#F00\">Atenção está cópia de pedido está sujeita há disponibilidade em estoque.</b>
<br />
OBS:
$emxls_obs
<br />
<br />

<style type=\"text/css\">
.tamanho {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 8pt;
	border-style:solid;
	border-width:thick;
}

table tr td {
	font-size: 8pt;
	border-style:solid;
	border-width:thin;
	}
</style>
 ";

echo "<table>";
  echo "<tr>";
    echo "<td>Código Adidas</td>";
    echo "<td>Código do Cliente</td>";
    echo "<td>Imagem</td>";
	echo "<td></td>";
    echo "<td>Artigo</td>";
    echo "<td>Descricao</td>";
	echo "<td>Categoria</td>";
    echo "<td>Quantidade</td>";
    echo "<td>Grade</td>";
    echo "<td>Data</td>";
    echo "<td>Valor Unitário</td>";
    echo "<td>Total</td>";
  echo "</tr>";


$tora = 0;

$query_car = mysql_query("SELECT DISTINCT `loja` FROM  `lista_artigo_pedido_prontaentrega`  WHERE `npedido` = '$npedido'");

while($car_array_2 = mysql_fetch_array($query_car)){		
    $car_loja      = $car_array_2["loja"];
	
$car_loja_lista = mysql_query("SELECT `loja`,`cod_referencia` FROM `$banco`.`login` WHERE `B` = '$car_loja'") or die(mysql_error());
while($array_xx = mysql_fetch_array($car_loja_lista)){
		
	$car_nome_loja       = $array_xx["loja"];
	$car_refere			 = $array_xx["cod_referencia"];
	
$somar_total_pedido_1 = mysql_query("SELECT SUM(total) as soma FROM  `lista_artigo_pedido_prontaentrega`  WHERE  `npedido` = '$p_pedido' AND `loja` = '$car_loja'") or die(mysql_error());
while($linha_array_eee = mysql_fetch_array($somar_total_pedido_1)){$linha_eee = $linha_array_eee["soma"];}

$linha_eee          =  number_format($linha_eee, 2, ',', '.');
}
	
	echo "<tr>
				<td colspan=\"12\">$car_loja - <b>$car_nome_loja</b> | <b style=\"color:#F00\">$car_refere</b> | Total desta loja* R$ $linha_eee</h3></td></tr>";
	
$query_pedido_aberto = mysql_query("SELECT DISTINCT `artigo`, `data` FROM  `lista_artigo_pedido_prontaentrega`  WHERE `npedido` = '$npedido' AND `loja` = '$car_loja' ORDER BY `loja`,`data`") or die(mysql_error());	
	$lin = mysql_num_rows($query_pedido_aberto);
    if($lin==0) // verifica se retornou algum registro
    {
		$atua_total_pedido_zero = mysql_query("UPDATE `pedido_prontaentrega` SET `total` = '$zero'  WHERE  `npedido` = '$p_pedido'"); 
    echo "<center class=\"car_vazio\">Carrinho Vazio</center>";     }	
    while($array_pedido_aberto = mysql_fetch_array($query_pedido_aberto)){		
    $sqlpedido_artigo      = $array_pedido_aberto["artigo"];
    $sqlpedido_data        = $array_pedido_aberto["data"];
	$sqlpedido_datax       = $array_pedido_aberto["data"];
#------conta a quantidade de produtos------------------------
$query_total = mysql_query("SELECT SUM(quantidade) as soma FROM  `lista_artigo_pedido_prontaentrega`  WHERE `artigo` = '$sqlpedido_artigo' AND `npedido` = '$p_pedido' AND `data` = '$sqlpedido_data' AND `loja` = '$car_loja'") or die(mysql_error());
while($linha_array = mysql_fetch_array($query_total)){$linha = $linha_array["soma"];}
#------------------------------------------------------------
#----------------------Soma Pedido---------------------------
$query_total_pe = mysql_query("SELECT SUM(total) as soma FROM  `lista_artigo_pedido_prontaentrega`  WHERE  `npedido` = '$p_pedido' AND `loja` = '$car_loja'") or die(mysql_error());
while($linha_array_pe = mysql_fetch_array($query_total_pe)){$linha_pe = $linha_array_pe["soma"];}
#------------------------------------------------------------
#----------------------Recolhendo Informações-----------------
$query_total_info = mysql_query("SELECT * FROM  `lista_artigo_pedido_prontaentrega`  WHERE  `npedido` = '$p_pedido' AND `artigo` = '$sqlpedido_artigo' AND `loja` = '$car_loja' AND `data` = '$sqlpedido_datax'") or die(mysql_error());
while($linha_array_info = mysql_fetch_array($query_total_info)){
	$info_valor_unite = $linha_array_info["valor"];
	$info_descricao_unite = $linha_array_info["descricao"];
	$info_segmento_unite = $linha_array_info["segmento"];
	$info_categoria_unite = $linha_array_info["categoria"];
	$sqlpedido_total = $linha_array_info["valor"];}
#------------------------------------------------------------
#-----------Tratanto valores e fazendo conta -------------------  	
	$sqlpedido_data    = date('d/m/Y', strtotime(str_replace("-", "/", $sqlpedido_data )));
	$info_valor_unitex = number_format($info_valor_unite, 2, ',', '.');
	$total_item        = $sqlpedido_total * $linha;	
	$total_item        = $total_item * $sul;
	$linha_pe          = $linha_pe * $sul;	
	$total_pedido      = $linha_pe;	
	$total_item        =  number_format($total_item, 2, ',', '.');	
	$info_valor_unite  =  str_replace(",", ".", $info_valor_unite);	
	$info_valor_unite  = $info_valor_unite * $sul;	
	$info_valor_unite  =  number_format($info_valor_unite, 2, ',', '.');
	$linha_pe          =  number_format($linha_pe, 2, ',', '.');	
	$query_tam_sql = mysql_query("SELECT `tamanho`,`quantidade` FROM `lista_artigo_pedido_prontaentrega` WHERE `npedido` = '$p_pedido' AND `artigo` = '$sqlpedido_artigo' AND `loja` = '$car_loja' AND `data` = '$sqlpedido_datax'")or die(mysql_error());
	 while($linha_query = mysql_fetch_array($query_tam_sql))
   {
	$tamanho_query    = $linha_query["tamanho"];
	$quantidade_query = $linha_query["quantidade"]; 
	
	$tudo .= "<b class=\"tm\">$tamanho_query/<span  class=\"qt\">$quantidade_query,</b> ";
	};
#------------------------------------------------------------------	
	echo "<tr> 
	       <td>$car_loja</td>
		   <td>$car_refere</td>
		   <td><img src=\"http://www.adisul.net/demandimage/thumb/".$sqlpedido_artigo."_F.jpg\" width=\"60px\" /></td>
		   <td></td>
	       <td>$sqlpedido_artigo</td>
		   <td>$info_descricao_unite</td>
		   <td>$info_categoria_unite</td>
		   <td>$linha</td>
		   <td>$tudo</td>   	 
	       <td>$sqlpedido_data</td> 	       
	       <td>R$ $info_valor_unite</td> 
		   <td>R$ $total_item</td> 
	</tr>";	
	$tudo = "";}

}
?>

</table>





</div>

</font>
