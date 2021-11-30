<?php
include"../conexao.php";



$id = $_GET["id"];

//Pega a data atual
$data = date("d/m/Y");

//Busca na tabela o numero de vezes que a página ja foi visitada
$busca = "SELECT * FROM `adisu724_adidas`.`contador`";
$exe = mysql_query($busca);
 
$resultado = (mysql_fetch_array($exe));
$numero = $resultado['visitantes'];
 
//Pega o numero de visistas que consta na tabela, adiciona mais um e atualiza
$visitantes = $numero + 1;
$altera = "UPDATE `adisu724_adidas`.`contador` SET visitantes = '$visitantes' WHERE id = '$id'";
$exe1 = mysql_query($altera);


if($id == "101") {header("location:http://www.adisul.net/");}
elseif($id == "102") {header("location:http://www.adisul.net/");}


?>