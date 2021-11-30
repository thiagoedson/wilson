<?php
session_start();
include"conexao.php";


$cliente_sql = mysqli_query($con,"SELECT * FROM clientes");
while($array = mysqli_fetch_assoc($cliente_sql)){	
	$nome_cliente = $array["Cliente"];
	$cod_cliente = $array["Codigo Cliente"];
	
	
	$query = mysqli_query($con,"UPDATE login SET `loja` = '$nome_cliente'  WHERE  `B` = '$cod_cliente'"); 


if($nome_cliente == "" ) {



$html = "<center><h3>Cliente $cod_cliente não consta no relatório de Crédito, seu nome foi apagado no site</h3>
		<h4><a href=\"home.php\">Voltar</a></h4></center>";

$html = utf8_decode($html);
echo $html;}



else {
	
echo "<center><h3>Cliente $nome_cliente atualizado com Sucesso</h3>
		<h4><a href=\"home.php\">Voltar</a></h4></center>";
}
$nome_cliente = "";	
$cod_cliente = "";
}

$mensagem = "Atualizou Clientes VS Relatório de Crédito";
salvaLog($con,$mensagem);

?>