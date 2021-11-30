<?php
session_start();
include"conexao.php";

$npedido = $_GET["npedido"];
$var_pedido = $_GET["var"];
$sul = 1;
$data_pedido = date('d-m-Y');



 
header("Content-type: text/xhtml; charset=utf-8");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
// definimos o tipo de arquivo
header('Content-type: application/xsl-excel');
// Como será gravado o arquivo
header('Content-Disposition: attachment; filename="sales_orden_adisul.xls"');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

if($var_pedido == "FW12") {
	$banco_db = "prevendafw12";
	$banco_db_2 = "lista_artigo_pedido_fw12";
	$texto = "<h2>PEDIDO PREVENDA FW12<br />
		  N pedido <b style=\"color:#F00\"> $npedido</b></h2>Pedido elaborado por:<br />
		  $emp_loja | $emxls_cliente <br />
		  Para:<br />
		  $emp_loja2 | $emxls_cliente_filho <br />
		  No dia $emxls_data às $emxls_hora no total de  R$ $emxls_total 
		  <h5>Este é apenas uma cópia do seu pedido , para demais confirmações verifique sua carteira ou entre em contato com seu representante. Valores brutos sem descontos regionais e nem descontos de pré-venda.<h5>Mais informações no site www.adisul.com</h5> <br /><hr/>";

	}	
elseif($var_pedido == "DISPO2012") {
	$banco_db = "pedido_ss12";
	$banco_db_2 = "lista_artigo_pedido_ss12";
	$texto = "<h2>PEDIDO PRONTA ENTREGA<br />
		  N pedido <b style=\"color:#F00\"> $npedido</b></h2>Pedido elaborado por:<br />
		  $emp_loja | $emxls_cliente <br />
		  Para:<br />
		  $emp_loja2 | $emxls_cliente_filho <br />
		  No dia $emxls_data às $emxls_hora no total de  R$ $emxls_total 
		  <h5>Este é apenas uma cópia do seu pedido , para demais confirmações verifique sua carteira ou entre em contato com seu representante. Valores brutos sem descontos regionais e nem descontos de pré-venda.<h5>Mais informações no site www.adisul.com</h5> <br /><hr/>";

	
	}
elseif($var_pedido == "CLE2012") {
	$banco_db = "pedido_cle2012";
	$banco_db_2 = "lista_artigo_pedido_cle2012";
	$texto = "<h2>PEDIDO PROMOCIONAL (CLE)<br />
		  N pedido <b style=\"color:#F00\"> $npedido</b></h2>Pedido elaborado por:<br />
		  $emp_loja | $emxls_cliente <br />
		  Para:<br />
		  $emp_loja2 | $emxls_cliente_filho <br />
		  No dia $emxls_data às $emxls_hora no total de  R$ $emxls_total 
		  <h5>Este é apenas uma cópia do seu pedido , para demais confirmações verifique sua carteira ou entre em contato com seu representante. Valores brutos sem descontos regionais e nem descontos de pré-venda.<h5>Mais informações no site www.adisul.com</h5> <br /><hr/>";

	
	}
	
elseif($var_pedido == "CLE12012") {
	$banco_db = "pedido_cle_12012";
	$banco_db_2 = "lista_artigo_pedido_cle_12012";
	$texto = "<h2>PEDIDO PROMOCIONAL (CLE1)<br />
		  N pedido <b style=\"color:#F00\"> $npedido</b></h2>Pedido elaborado por:<br />
		  $emp_loja | $emxls_cliente <br />
		  Para:<br />
		  $emp_loja2 | $emxls_cliente_filho <br />
		  No dia $emxls_data às $emxls_hora no total de  R$ $emxls_total 
		  <h5>Este é apenas uma cópia do seu pedido , para demais confirmações verifique sua carteira ou entre em contato com seu representante. Valores brutos sem descontos regionais e nem descontos de pré-venda.<h5>Mais informações no site www.adisul.com</h5> <br /><hr/>";

	
	}

$query_1 = mysql_query("SELECT * FROM `$banco`.`$banco_db` WHERE `npedido` = '$npedido'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_xls = mysql_fetch_array($query_1)){	
	
	 $emxls_cliente              = $array_xls["cliente"];
	 $emxls_cliente_filho        = $array_xls["cliente_filho"];
	 $emxls_data                 = $array_xls["data_pedido"];
     $emxls_hora                 = $array_xls["hora"];
     $emxls_total                = $array_xls["total"];	 
	 $emxls_total          =  number_format($emxls_total, 2, ',', '.');
	 $emxls_data    = date('d/m/Y', strtotime(str_replace("-", "/", $emxls_data )));
	
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
$SQL = "SELECT DISTINCT `artigo`, `Descricao`, `valor`, `segmento`, `data` FROM `$banco`.`$banco_db_2` WHERE `npedido` = '$npedido' ORDER BY `data`";
$executa = mysql_query($SQL);



// Como será gravado o arquivo

#-----------------------------------------------------------------------------------------------------------------------------------------------------------
if($var_pedido == "FW12") {
	
	$texto = "<h2>PEDIDO PREVENDA FW12<br />
		  N pedido <b style=\"color:#F00\"> $npedido</b></h2>Pedido elaborado por:<br />
		  $emp_loja | $emxls_cliente <br />
		  Para:<br />
		  $emp_loja2 | $emxls_cliente_filho <br />
		  No dia $emxls_data às $emxls_hora no total de  R$ $emxls_total 
		  <h5>Este é apenas uma cópia do seu pedido , para demais confirmações verifique sua carteira ou entre em contato com seu representante. Valores brutos sem descontos regionais e nem descontos de pré-venda.<h5>Mais informações no site www.adisul.com</h5> <br /><hr/>";

	}	
elseif($var_pedido == "DISPO2012") {
	
	$texto = "<h2>PEDIDO PRONTA ENTREGA<br />
		  N pedido <b style=\"color:#F00\"> $npedido</b></h2>Pedido elaborado por:<br />
		  $emp_loja | $emxls_cliente <br />
		  Para:<br />
		  $emp_loja2 | $emxls_cliente_filho <br />
		  No dia $emxls_data às $emxls_hora no total de  R$ $emxls_total 
		  <h5>Este é apenas uma cópia do seu pedido , para demais confirmações verifique sua carteira ou entre em contato com seu representante. Valores brutos sem descontos regionais e nem descontos de pré-venda.<h5>Mais informações no site www.adisul.com</h5> <br /><hr/>";

	
	}
elseif($var_pedido == "CLE2012") {
	
	$texto = "<h2>PEDIDO PROMOCIONAL (CLE)<br />
		  N pedido <b style=\"color:#F00\"> $npedido</b></h2>Pedido elaborado por:<br />
		  $emp_loja | $emxls_cliente <br />
		  Para:<br />
		  $emp_loja2 | $emxls_cliente_filho <br />
		  No dia $emxls_data às $emxls_hora no total de  R$ $emxls_total 
		  <h5>Este é apenas uma cópia do seu pedido , para demais confirmações verifique sua carteira ou entre em contato com seu representante. Valores brutos sem descontos regionais e nem descontos de pré-venda.<h5>Mais informações no site www.adisul.com</h5> <br /><hr/>";

	
	}
	
elseif($var_pedido == "CLE12012") {
	
	$texto = "<h2>PEDIDO PROMOCIONAL (CLE1)<br />
		  N pedido <b style=\"color:#F00\"> $npedido</b></h2>Pedido elaborado por:<br />
		  $emp_loja | $emxls_cliente <br />
		  Para:<br />
		  $emp_loja2 | $emxls_cliente_filho <br />
		  No dia $emxls_data às $emxls_hora no total de  R$ $emxls_total 
		  <h5>Este é apenas uma cópia do seu pedido , para demais confirmações verifique sua carteira ou entre em contato com seu representante. Valores brutos sem descontos regionais e nem descontos de pré-venda.<h5>Mais informações no site www.adisul.com</h5> <br /><hr/>";

	
	}
	


echo $texto;


$imgfile = "/thumb/".$rs["artigo"]."_F.jpg";

#---$handle = fopen($filename, "r");

#----$imgbinary = fread(fopen($imgfile, "r"), filesize($imgfile));

echo "<table align=\"center\" border=\"1\" style=\"text-align=middle;\">";
  echo "<tr style=\"display:block;\">";
    echo "<td width=\"100px\" height=\"80px\" style=\"display:block;width=\"100px;display:block;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-----------------&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
    echo "<td>Artigo</td>";
    echo "<td>Data</td>";
    echo "<td>Quantidade/Total</td>";
    echo "<td>Qt/Tm</td>";   
    echo "<td>Valor Uni/SP</td>";
    echo "<td>Total/SP</td>";
  echo "</tr>";

while ($rs = mysql_fetch_array($executa)){
	
	$sqlpedido_data   = $rs["data"];
	$p_pedido         = $npedido;
	$sqlpedido_artigo = $rs["artigo"];
	
	
#------conta a quantidade de produtos------------------------
$query_total = mysql_query("SELECT SUM(quantidade) as soma FROM  `$banco`.`$banco_db_2`  WHERE `artigo` = '$sqlpedido_artigo' AND `npedido` = '$p_pedido' AND `data` = '$sqlpedido_data'") or die(mysql_error());
while($linha_array = mysql_fetch_array($query_total)){$linha = $linha_array["soma"];}


#------------------------------------------------------------
#----------------------Soma Pedido---------------------------

$query_total_pe = mysql_query("SELECT SUM(total) as soma FROM  `$banco`.`$banco_db_2`  WHERE  `npedido` = '$p_pedido'") or die(mysql_error());
while($linha_array_pe = mysql_fetch_array($query_total_pe)){$linha_pe = $linha_array_pe["soma"];}

#------------------------------------------------------------
#----------------------Recolhendo Informações-----------------

$query_total_info = mysql_query("SELECT * FROM  `$banco`.`$banco_db_2`  WHERE  `npedido` = '$p_pedido' AND `artigo` = '$sqlpedido_artigo'") or die(mysql_error());
while($linha_array_info = mysql_fetch_array($query_total_info)){$info_valor_unite = $linha_array_info["valor"];$info_descricao_unite = $linha_array_info["descricao"];$info_segmento_unite = $linha_array_info["segmento"];$sqlpedido_total = $linha_array_info["valor"];}

#------------------------------------------------------------
$query_tam_sql = mysql_query("SELECT `tamanho`,`quantidade` FROM `$banco`.`$banco_db_2` WHERE `npedido` = '$p_pedido' AND `artigo` = '$sqlpedido_artigo'")or die(mysql_error());
	 while($linha_query = mysql_fetch_array($query_tam_sql))
   {
	$tamanho_query    = $linha_query["tamanho"];
	$quantidade_query = $linha_query["quantidade"]; 
	
	$tudo .= "<b>[$tamanho_query/$quantidade_query]</b> ";
	};
#-----------Tratanto valores e fazendo conta -------------------

	
	$sqlpedido_data    = date('d/m/Y', strtotime(str_replace("-", "/", $sqlpedido_data )));
	$info_valor_unitex = str_replace(",", ".", $info_valor_unite);	
	$total_item        = $sqlpedido_total * $linha;
	$total_item        = $total_item * $sul;
	$linha_pe          = $linha_pe * $sul;	
	$total_pedido      = $linha_pe;	
	$total_item        =  number_format($total_item, 2, ',', '.');	
	$info_valor_unite  = str_replace(",", ".", $info_valor_unite);	
	$info_valor_unite  = $info_valor_unite * $sul;	
	$info_valor_unite  =  number_format($info_valor_unite, 2, ',', '.');
	$linha_pe          =  number_format($linha_pe, 2, ',', '.');
	$img = $rs["artigo"];
	
	
	$total = $rs["total"]; $total = str_replace(".", ",", $total);
	$valor = $rs["valor"]; $valor = str_replace(".", ",", $valor);
 


$newFileName = "<img src=\"http://www.adisul.com/thumb/".$img."_F.jpg\" alt=\"http://www.adisul.com/thumb/".$img."_F.jpg\" title=\"http://www.adisul.com/thumb/".$img."_F.jpg\" width=\"90px\" height=\"80px\"/>";



  echo "<tr style=\"display:block;height=\"80px\"\">";
    echo "<td width=\"100px\" height=\"80px\" style=\"display:block;width=\"100px;display:block;\">".$newFileName." <br /><br /><br /><br /><br /><br /><br /></td>";
    echo "<td>" . $rs["artigo"]."</td>";
    echo "<td>" . $sqlpedido_data."</td>";
    echo "<td>" . $linha."</td>";
    echo "<td>" . $tudo."</td>";
    echo "<td>R$  $valor</td>";
    echo "<td>R$  $total_item  </td>";
  echo "</tr>";
 
$tudo = "";}
echo "</table>"; 

?>