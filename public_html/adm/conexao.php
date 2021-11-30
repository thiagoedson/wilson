<?php
$var = $_SESSION['adm'];


$host = "localhost"; //computador onde o servidor de banco de dados esta instalado
$user = "rbkne024_ema"; //seu usuario para acessar o banco
$pass = "mhvt26mnk"; //senha do usuario para acessar o banco
$banco = "rbkne024_ema"; //banco que deseja acessar
$con = mysqli_connect($host, $user, $pass) or die (mysql_error());
mysqli_select_db($con,$banco);

$host_reebok  = "localhost"; //computador onde o servidor de banco de dados esta instalado
$user_reebok  = "rbkne024_reebok"; //seu usuario para acessar o banco
$pass_reebok  = "mhvt26mnk"; //senha do usuario para acessar o banco
$banco_reebok = "rbkne024_reebok"; //banco que deseja acessar
$con_reebok   = mysqli_connect($host_reebok, $user_reebok, $pass_reebok) or die (mysql_error());
mysqli_select_db($con_reebok,$banco_reebok);




?>