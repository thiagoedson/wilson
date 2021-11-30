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
$SQL = "SELECT * FROM `faturamento` INNER JOIN `login` ON `faturamento`.`Codigo Cliente` = `login`.`B` WHERE `login`.`nome` = '$grupo' ORDER BY `Data Emissao NF` DESC ";
$executa = mysql_query($SQL);


header("Content-type: text/html; charset=iso-8859-1rn");



// definimos o tipo de arquivo
header("Content-type: application/msexcel");

// Como será gravado o arquivo
header("Content-Disposition: attachment; filename=faturamento_grupo_$grupo.xls");

// montando a tabela
echo "<table border=\"1px\">";
  echo "<tr bgcolor=\"#999999\">";
    echo "<td>Cliente</td>";
    echo "<td>Cod Cliente</td>";
    echo "<td>Cidade</td>";
    echo "<td>Artigo</td>";
    echo "<td>Colecao</td>";
    echo "<td>Nome do Artigo</td>";
    echo "<td>Qt</td>";
    echo "<td>Total</td>";
    echo "<td>Quantidade por tamanho</td>";
    echo "<td>Data Emissao NF</td>";
    echo "<td>N Pedido</td>";
  echo "</tr>";

while ($rs = mysql_fetch_array($executa)){
 $varivel = $rs["Qtde por Tamanho"];
 $varivel = str_replace("/", ";",  $varivel);

 $valor_total = $rs["Valor total a Faturar"];
 $valor_total = str_replace(",", ".",  $valor_total);
 $valor_total =  number_format($valor_total, 2, ',', '.');
 $valor_toral = "R$ ".$valor_total;
$rs["Qtde por Tamanho"] = str_replace("L" , "G" , $rs["Qtde por Tamanho"] );
$rs["Qtde por Tamanho"] = str_replace("S" , "P" , $rs["Qtde por Tamanho"] );
$rs["Qtde por Tamanho"] = str_replace("XG" , "GG" , $rs["Qtde por Tamanho"] );
$rs["Qtde por Tamanho"] = str_replace("XP" , "PP" , $rs["Qtde por Tamanho"] );

  echo "<tr>";
    echo "<td>" . $rs["Nome do Cliente"]."</td>";
    echo "<td>" . $rs["Codigo Cliente"]."</td>";
    echo "<td>" . $rs["Cidade"]."</td>";
    echo "<td>" . $rs["Codigo Artigo"]."</td>";
    echo "<td>" . $rs["Order Type"]."</td>";
    echo "<td>" . $rs["Descricao do Artigo"] . "</td>";
    echo "<td>" . $rs["Qtde Total a Faturar"] . "</td>";
    echo "<td>" . $valor_toral . "</td>";
    echo "<td>" . $varivel . "</td>";
    echo "<td>" . $rs["Data Emissao NF"] . "</td>";
    echo "<td>" . $rs["Numero Pedido"] . "</td>";
  echo "</tr>";
 
}
echo "</table>"; 

#------------------------------------ Dados de quem está pegando o relatório de carteira-----------------

$query_select = mysql_query("SELECT `carteira` FROM `site`");
while ($array_select = mysql_fetch_array($query_select)){ 

$carteira_site = $array_select["carteira"];}
$date_new = date('Y-m-d');
$time_new = mktime(date("H")+21, date("i"), date("s"),  0);
$time_new = gmdate("H:i:s", $time_new);
$tipo_car = "CARTEIRA DO GRUPO";

$inserir_n = mysql_query("INSERT INTO `rel_carteira` (`id` ,`codigo_cliente` ,`tipo`, `data`, `hora`, `data_rel`) VALUES (NULL ,'$senha', '$tipo_car', '$date_new', '$time_new', '$carteira_site')") or die(mysql_error());


#------------------E-mail de notificação para o representante---------------------------------------------

#----------Email Represetante------------------------------------------------------------------------------------------------------------------------------------
$corpo_npedido = mysql_query("SELECT * FROM `login` WHERE `B` = '$senha'"); 
	while($array_emp = mysql_fetch_array($corpo_npedido)){		
	  $emp_loja       = $array_emp["loja"];			  
	  $e_comprador    = $array_emp["comprador"];
	  $e_senha        = $array_emp["D"];
	  $e_email        = $array_emp["email"];
	  $e_grupo        = $array_emp["nome"];
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

	$assunto = "ADISUL - NOTIFICAÇÃO REL CARTEIRA $e_grupo";	
    $html = "
    <html>
    <body>	    
    <font size=\"-1\">
	<img src=\"http://adisul.net/img/logo.png\" title=\"ADISUL\" /><br />
	<br />
	<br />

    Caro usuário este e-mail é uma notificação que o usuário $senha \"$emp_loja\" <br />
	fez o download do relatório de carteira do grupo \"$e_grupo\" no dia $date_new<br />
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

