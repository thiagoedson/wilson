<?php
// Incluir aquivo de conexão
include("../../conexao.php");
include"sql_pedido/p_pedido.php";
 
// Recebe o valor enviado
$valor = $_GET['valor'];
$npedido = $_GET['npedido'];
if($npedido == "") {$npedido = "0";}

#-------Verificar se não está repetido na lista ---------------------

$mysqli_query_seg = mysqli_query($con, "SELECT * FROM lista_ss16 WHERE `npedido` = '$npedido' AND `artigo` = '$valor'");
$lin_filtro = mysqli_num_rows($mysqli_query_seg);
    if($lin_filtro == 0 ) {

// Procura titulos no banco relacionados ao valor

$data = date('Y-m-d H:i:s');
$mysql = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`$tabela` WHERE `Artigo` = '$valor'");
	while($array_mysql = mysqli_fetch_array($mysql)){		
	  $divisao         = $array_mysql["Divisao"];
	  $categoria       = $array_mysql["Categoria"];	
	  $price           = $array_mysql["vitrine"];	
	  $data_lancamento = $array_mysql["Data de Lancamento"];
	  $descricao = $array_mysql["Descricao"];	
	}

$sql = mysqli_query($con, "INSERT INTO lista_ss16 (`id` ,`npedido` ,`artigo`, `descricao`, `data`, `divisao`, `categoria`,`data_lancamento`,`price`) VALUES (NULL ,'$npedido', '$valor', '$descricao', '$data', '$divisao', '$categoria', '$data_lancamento', '$price')");
 
	}
 
// Acentuação
header("Content-Type: text/html; charset=ISO-8859-1",true);
?>
