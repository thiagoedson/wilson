<?php
session_start();
include"../conexao.php";
$senha = $_SESSION["codigo"];
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

//consulta sql
$SQL = "select * from carteira WHERE `Codigo Cliente` = '$senha'  ORDER BY `Data Entrega  Revisada`";
$executa = mysql_query($SQL);

header("Content-type: text/html; charset=iso-8859-1rn");

// definimos o tipo de arquivo
header("Content-type: application/msexcel");

// Como será gravado o arquivo
header("Content-Disposition: attachment; filename=carteira_loja_$senha.xls");

// montando a tabela
// montando a tabela
echo"
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<style type=\"text/css\">

table {
	font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
	width: 650px;
	border-collapse:collapse;
	border:1px solid #FFCA5E;
}
caption {
	font: 1.8em/1.8em Arial, Helvetica, sans-serif;
	text-align: left;
	text-indent: 10px;
	background: url(bg_caption.jpg) right top;
	height: 45px;
	color: #FFAA00;
}
thead th {
	background: url(bg_th.jpg) no-repeat right;
	height: 47px;
	color: #FFFFFF;
	font-size: 0.8em;
	font-weight: bold;
	padding: 0px 7px;
	margin: 20px 0px 0px;
	text-align: left;
	border-right: 1px solid #FCF1D4;
}


tbody th,td {
	font-size: 0.8em;
	line-height: 1.4em;
	font-family: Arial, Helvetica, sans-serif;
	color:#000;
	padding: 10px 7px;
	border-top: 1px solid #FFCA5E;
	border-right: 1px solid #DDDDDD;
	text-align: left;
}

tfoot th {
	background: url(bg_total.jpg) repeat-x bottom;
	color: #FFFFFF;
	height: 30px;
}
tfoot td {
	background: url(bg_total.jpg) repeat-x bottom;
	color: #FFFFFF;
	height: 30px;
}
</style>
</head>
<body>";

echo "<font size=\"-1\"><table border=\"1px\">";
  echo "<tr>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Cliente</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Código Cliente</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Cidade</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Categoria</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Artigo</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Coleção</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Nome do Artigo</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Quantidade</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">PDV</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Custo SP</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Custo com Desconto</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Total</td>";
	echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Prazo</td>";
	echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Gender Name</td>";
	echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Age Group</td>";
	echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">NCM</td>";
	echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">IPI</td>";
	echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Origem</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Quantidade por tamanho</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Entrega Original</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Entrega Revisada</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">Status</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">N Pedido</td>";
    echo "<td style=\"background-color:#FC0;font-weight:bold;padding:3px;\">OBS</td>";
  echo "</tr>";

while ($rs = mysql_fetch_array($executa)){
 $varivel = $rs["Qtde por Tamanho"];
 $varivel = str_replace("/", ";",  $varivel);
 #------------------------------------------------------------------
 $valor_total = $rs["Valor total a Faturar"];
 $valor_total = str_replace(",", ".",  $valor_total);
 $valor_total =  number_format($valor_total, 2, ',', '.');
 $valor_toral = "R$ ".$valor_total;
 #------------------------------------------------------------------
 $Retail_Price = $rs["Retail Price"];
 $Retail_Price = str_replace(",", ".",  $Retail_Price);
 $Retail_Price =  number_format($Retail_Price, 2, ',', '.');
 $Retail_Price = "R$ ".$Retail_Price;
 #------------------------------------------------------------------
 $Unit_Price = $rs["Unit Price"];
 $Unit_Price = str_replace(",", ".",  $Unit_Price);
 $Unit_Price =  number_format($Unit_Price, 2, ',', '.');
 $Unit_Price = "R$ ".$Unit_Price;
 #------------------------------------------------------------------
 $Unit_Disc = $rs["Unit Price Incl Disc"];
 $Unit_Disc = str_replace(",", ".",  $Unit_Disc);
 $Unit_Disc =  number_format($Unit_Disc, 2, ',', '.');
 $Unit_Disc = "R$ ".$Unit_Disc;
 #------------------------------------------------------------------
$categoria = $rs["Categoria"];

if (strstr($categoria, "Footwear")) {$categoria = "Calcado";}
if (strstr($categoria, "Apparel")) {$categoria = "Textil";}
if (strstr($categoria, "Hardware")) {$categoria = "Equip";}

$rs["Qtde por Tamanho"] = str_replace("L" , "G" , $rs["Qtde por Tamanho"] );
$rs["Qtde por Tamanho"] = str_replace("S" , "P" , $rs["Qtde por Tamanho"] );
$rs["Qtde por Tamanho"] = str_replace("XG" , "GG" , $rs["Qtde por Tamanho"] );
$rs["Qtde por Tamanho"] = str_replace("XP" , "PP" , $rs["Qtde por Tamanho"] );

  echo "<tr>";
    echo "<td>" . $rs["Cliente"]."</td>";
    echo "<td>" . $rs["Codigo Cliente"]."</td>";
    echo "<td>" . $rs["Cidade"]."</td>";
    echo "<td>" . $categoria ."</td>";
    echo "<td>" . $rs["Codigo Artigo"]."</td>";
    echo "<td>" . $rs["Order Type"]."</td>";
    echo "<td>" . $rs["Descricao Artigo"] . "</td>";
    echo "<td>" . $rs["Qtde Total a Faturar"] . "</td>";
    echo "<td>" . $Retail_Price . "</td>";
    echo "<td>" . $Unit_Price . "</td>";
    echo "<td>" . $Unit_Disc . "</td>";
    echo "<td>" . $valor_toral . "</td>";
    echo "<td>" . $rs["Prz"] . "</td>";
    echo "<td>" . $rs["Gender Name"] . "</td>";
    echo "<td>" . $rs["Age Group"] . "</td>";
    echo "<td>" . $rs["Fiscal Classification"] . "</td>";
    echo "<td>" . $rs["IPI"] . "</td>";
    echo "<td>" . $rs["Country of Origin"] . "</td>";
    echo "<td>" . $varivel . "</td>";
    echo "<td>" . $rs["Data Entrega Original"] . "</td>";
    echo "<td>" . $rs["Data Entrega  Revisada"] . "</td>";
    echo "<td>" . $rs["Status do pedido"] . "</td>";
    echo "<td>" . $rs["Numero do Pedido"] . "</td>";
    echo "<td>" . $rs["Observacao do Pedido"] . "</td>";
  echo "</tr>";
 
}
echo "</table></font></body></html>"; 


#------------------------------------ Dados de quem está pegando o relatório de carteira-----------------

$query_select = mysql_query("SELECT `carteira` FROM `site`");
while ($array_select = mysql_fetch_array($query_select)){ 

$carteira_site = $array_select["carteira"];}
$date_new = date('Y-m-d');
$time_new = mktime(date("H")+21, date("i"), date("s"),  0);
$time_new = gmdate("H:i:s", $time_new);
$tipo_car = "CARTEIRA DA LOJA $senha";

$inserir_n = mysql_query("INSERT INTO `rel_carteira` (`id` ,`codigo_cliente` ,`tipo`, `data`, `hora`, `data_rel`) VALUES (NULL ,'$senha', '$tipo_car', '$date_new', '$time_new', '$carteira_site')") or die(mysql_error());


#------------------E-mail de notificação para o representante---------------------------------------------

#----------Email Represetante------------------------------------------------------------------------------------------------------------------------------------
$corpo_npedido = mysql_query("SELECT * FROM `login` WHERE `B` = '$senha'"); 
	while($array_emp = mysql_fetch_array($corpo_npedido)){		
	  $emp_loja       = $array_emp["loja"];			  
	  $e_comprador    = $array_emp["comprador"];
	  $e_senha        = $array_emp["D"];
	  $e_email        = $array_emp["email"];
	  $e_represetante = $array_emp["represe"];	  
	  $e_email = str_replace(";", ",", $e_email);
	  
	    
     }
	 
	 $represetante_sql = mysql_query("SELECT * FROM `adisu724_adidas`.`usuarios` WHERE `id` = '$e_represetante'"); 
	while($array_repre = mysql_fetch_array($represetante_sql)){		
	  $emailrepre   = $array_repre["email"];
	  $barrarepre   = $array_repre["endereco"];	
	  $repre_titulo = $array_repre["titulo"];
	  $repre_region = $array_repre["region"];
		}
#----------Email 1 ------------------------------------------------------------------------------------------------------------------------------------------
     $date_new = date('d/m/Y', strtotime(str_replace("-", "/", $date_new )));
$carteira_site = date('d/m/Y', strtotime(str_replace("-", "/", $carteira_site )));

	$assunto = "ADISUL - NOTIFICAÇÃO REL CARTEIRA $emp_loja";	
    $html = "
    <html>
    <body>	    
    <font size=\"-1\">
	<img src=\"http://adisul.net/img/logo.png\" title=\"ADISUL\" /><br />
	<br />
	<br />

    Caro usuário este e-mail é uma notificação que o usuário $senha \"$emp_loja\" <br />
	fez o download do relatório de carteira da loja \"$emp_loja\" no dia $date_new<br />
 	às $time_new , o relatório referente a data $carteira_site. 	
    
    <br />
    <br />
    <br />

	Dúvidas e sugestôes  por favor entrar em contato pelo e-mail adisul@adisul.com.<br />
	
	
	<img src=\"http://adisul.net/img/email/email_carteira.jpg\" title=\"ADISUL\" /><br />
	<br />

	<font size=\"-5\"> Representante $repre_titulo<br />
	  Região $repre_region - $emailrepre
     </font> 
    <br/>
    <br/>
    <br/>
</font>
   <br/>
   $sql_html
   
   </body>
   </html>"; 

   $html = utf8_decode($html);
   $assunto = utf8_decode($assunto);
   $headers  = 'MIME-Version: 1.0' . "\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $headers .= 'From: adisul@adisul.com' . "\r\n" .
               'Reply-To: adisul@adisul.com , '.$emailrepre.' ,' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
               

   mail($emailrepre, $assunto, $html, $headers);

#   $p_data_2 = date('d/m/Y', strtotime(str_replace("-", "/", $p_data_2 )));

?>