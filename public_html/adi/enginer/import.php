<?php
session_start();
include"../conexao.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Atualização de Relatórios</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script src="jquery.js" type="text/javascript"></script>     
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">
<div id="form">
  
<?php

include"import.php";  
//Transferir o arquivo
if (isset($_POST['submit'])) {
  	 
    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {

       # readfile($_FILES['filename']['tmp_name']);
    }
  	$i=0;
	$deleterecords = "TRUNCATE TABLE `faturamento`"; //Esvaziar a tabela
	mysql_query($deleterecords) or die(mysql_error());
    //Importar o arquivo transferido para o banco de dados
    $handle = fopen($_FILES['filename']['tmp_name'], "r");


    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
		if($i>5) {
        $import="INSERT INTO `faturamento`(`Divisao`,
									   `Nome do Grupo`,
									   `Codigo Cliente`,
									   `Nome do cliente`,
									   `Endereco`,
									   `Cidade`,
									   `UF`,
									   `Segmentacao Artigo`,
									   `Segmentacao Cliente`,
									   `Docto No`,
									   `Colecao`,
									   `Codigo Artigo`,
									   `Descricao do Artigo`,
									   `Qtde Faturada`,
									   `Total Faturado`,
									   `Unit Price Discount`,
									   `Data Emissao NF`,
									   `Numero Pedido`,
									   `Observacao do Pedido`,
									   `Qtde por Tamanho`,
									   `Order Type`,
									   `Call Orders - adi Portal No`)values('$data[0]',
									   										'$data[1]',
																			'$data[2]',
																			'$data[3]',
																			'$data[4]',
																			'$data[5]',
																			'$data[6]',
																			'$data[7]',
																			'$data[8]',
																			'$data[9]',
																			'$data[10]',
																			'$data[11]',
																			'$data[12]',
																			'$data[13]',
																			'$data[14]',
																			'$data[15]',
																			'$data[16]',
																			'$data[17]',
																			'$data[18]',
																			'$data[19]',
																			'$data[20]',
																			'$data[21]')";
  
        mysql_query($import) or die(mysql_error());
		}
        $i++;
    }
  
    fclose($handle);
  
    print "	<img src=\"img/cloud64.png\"><br>

			<b>Atualização concluída</b><br>
			<br>
			Atualizar novo relatório ? <br>
			<br>
			<br>

			<a href=\"./\" title=\"Atualziar novo relatório ?\" class=\"cliqueaqui\">Clique aqui</a>";
  
//Visualizar formulário de transferência
} else {
  
?>
    <br>
	<img src="img/cloud32.png">
	<br>
	Atualizar  banco de dados.<br />
    Para atualizar a planilha deve estar no formato de CSV,"separado por <b>;</b> ".  
    <form enctype="multipart/form-data" action="<?php echo $PHP_SELF;?>" method="post">  
    <br /><br />  
    <input size='50' type='file' name='filename' class='import'><br /><br />  
    <input type='submit' name='submit' value='Atualizar' style="padding:5px;">
    </form>
<?php
  
}
  
?>
  
</div>
</div>
</body>
</html>

