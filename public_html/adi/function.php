<?php

$chamar = $_GET["chamar"];
$chemar = $_GET["chemar"];
$addCliente_tb = $_POST["addCliente_tb"];
$addCliente_tb = $_GET["addCliente_tb"];

$grupoAdd = $_GET["grupoAdd"];
$grupoRem = $_GET["remGrupo"];



	
#--------------------------- Funcões para clientes premiums-----------------------

function addCliente() {
	
	$cd_cl = $_GET["cod_cl"];
	$ssql = mysqli_query($con,"UPDATE  tb_ss14 SET `typt` = '' WHERE  `cliente` = '$cd_cl'") or die(mysql_error());
	header("location:premium_ss14.php?$cd_cl&msg=1");
}

function remCliente() {
	
	$cd_cl = $_GET["cod_cl"];
	$ssql = mysqli_query($con,"UPDATE  `tb_ss14` SET `typt` = '1' WHERE  `cliente` = '$cd_cl'") or die(mysql_error());
	header("location:premium_ss14.php?$cd_cl&msg=2");
}

function addCliente_tb() {
	require"conexao.php";
	$cd_cl = $_POST["cod_adidas"];
	var_dump($con);
    $resultado_npedido = mysqli_query($con, "INSERT INTO `tb_ss14` (`id`, `cliente`, `typt`) VALUES (NULL, '$cd_cl', '')") or die(mysql_error());
	header("location:premium_ss14.php?cadastrado");
}
#-------------------------------------------------------------------------------------------------------------------------------------------

function addGrupo() {
	
	$cd_cl = $_GET["cod_cl"];
	
	$query_fx_2 = mysqli_query($con,"SELECT * FROM `login` WHERE `nome` = '$cd_cl'") or die(mysql_error());
    while($array_fx_2 = mysqli_fetch_assoc($query_fx_2)){	
	
	$nome_cliente_fx_2         = $array_fx_2["B"];
	$ssql = mysqli_query($con,"UPDATE  tb_ss14 SET `typt` = '' WHERE  `cliente` = '$nome_cliente_fx_2'") or die(mysql_error());
	
	}
	header("location:premium_ss14.php?$cd_cl&msg=456");
}

function remGrupo() {
	
	$cd_cl = $_GET["cod_cl"];
	
	$query_fx_2 = mysqli_query($con,"SELECT * FROM `login` WHERE `nome` = '$cd_cl'") or die(mysql_error());
    while($array_fx_2 = mysqli_fetch_assoc($query_fx_2)){	
	
	$nome_cliente_fx_2         = $array_fx_2["B"];
	$ssql = mysqli_query($con,"UPDATE  tb_ss14 SET `typt` = '1' WHERE  `cliente` = '$nome_cliente_fx_2'") or die(mysql_error());
	
	}
	header("location:premium_ss14.php?$cd_cl&msg=555");
}









#-------------------------------------------------------------------------------------------------------------------------------------------
if(isset($chamar)){
addCliente();
}

if(isset($chemar)){
remCliente();
}

if(isset($addCliente_tb)){
addCliente_tb();
}

#--------------------------------------------------
if(isset($grupoAdd)){
addGrupo();
}

if(isset($grupoRem)){
remGrupo();
}


?>