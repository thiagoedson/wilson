<?php
session_start();
include"dire.php";

$documento = $_POST["documento"];
$condisao  = $_POST["condisao"];
$senha = $_SESSION["codigo"];

if($condisao == "nao") {
	
	$status = "3";
	

$ssql = mysql_query("UPDATE `$banco_representante`.`login` SET `status` = '$status' WHERE `B` = '$senha' ") or die(mysql_error());

	header("location:erro.php?type=3");
	
	}
	
	elseif($condisao == "sim") {
		$senha = $_SESSION["codigo"];
		$ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$so = PHP_OS;
		$navegador = $_SERVER['HTTP_USER_AGENT'];
		$status_politica = "";
		$documento = $_POST["documento"];
        $condisao  = $_POST["condisao"];


$query_politica = mysql_query("INSERT INTO `$banco_representante`.`politica` (`id`, `cliente`, `aceito`, `ip`, `so`, `bronswer`, `documento`, `status`) VALUES (NULL , '$senha', '$condisao', '$ip', '$so', '$navegador', '$documento', '$status_politica')");

	header("location:principal.php");
	}



?>