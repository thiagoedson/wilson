<?php
$host = "localhost"; //computador onde o servidor de banco de dados esta instalado
$user = "adisul_adidas"; //seu usuario para acessar o banco
$pass = "mhvt26mnk"; //senha do usuario para acessar o banco
$banco = "adisul_adidas"; //banco que deseja acessar
$con = mysql_connect($host, $user, $pass) or die (mysql_error());
mysqli_select_db($con,$banco);



$query_1 = mysqli_query($con,"SELECT * FROM clientes WHERE `Descricao do Grupo` = 'SEM GRUPO'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_1 = mysqli_fetch_assoc($query_1)){	
	
	$cod_adidas = $array_1["Codigo Cliente"];
	
	 $ssql = mysqli_query($con,"UPDATE  login SET `status` = '2' WHERE B = '$cod_adidas'; ") or die(mysql_error());

	
};


?>