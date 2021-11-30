<?php

include"conexao.php";

$lol = "GRUPOSOLO";
$wow = "";



	
	$v_p_verifica =  mysql_query("UPDATE  `$banco`.`login` SET `nome` = '$lol' WHERE nome = '$wow'; ") or die(mysql_error());



?>
<h1>CLIENTES ATUALIZADOS </h1>