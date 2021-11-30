<?php
include"../../conexao.php";


$npedido_er = $_GET["desc"];
$acao_er = $_GET["acao"];
$id_registro = $_GET["id_registro"];


$resultado_npedido = mysqli_query($con, "INSERT INTO lista_ss14 (`id` ,`npedido` ,`artigo`) VALUES (NULL ,'$npedido_er', '$id_registro')");



?>