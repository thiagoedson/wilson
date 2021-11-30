<?php
$host = "localhost"; //computador onde o servidor de banco de dados esta instalado
$user = "adisu724_mau"; //seu usuario para acessar o banco
$pass = "mhvt26mnk"; //senha do usuario para acessar o banco
$banco = "adisu724_mau"; //banco que deseja acessar
$con = mysql_connect($host, $user, $pass) or die (mysql_error());
mysql_select_db($banco);

?>