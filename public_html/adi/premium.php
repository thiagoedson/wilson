<?php
session_start();
include"conexao.php";
$chamar = $_GET["chamar"];
$chemar = $_GET["chemar"];
$addCliente_tb = $_POST["addCliente_tb"];
$addCliente_tb = $_GET["addCliente_tb"];

$grupoAdd = $_GET["grupoAdd"];
$grupoRem = $_GET["remGrupo"];



	
#--------------------------- Funcões para clientes premiums-----------------------

function addCliente() {
	
	$cd_cl = $_GET["cod_cl"];
	$ssql = mysqli_query($con,"UPDATE  tb_cle SET `typt` = '' WHERE  `cliente` = '$cd_cl'") or die(mysql_error());
	header("location:premium.php?$cd_cl&msg=1");
}

function remCliente() {
	
	$cd_cl = $_GET["cod_cl"];
	$ssql = mysqli_query($con,"UPDATE  `tb_cle` SET `typt` = '1' WHERE  `cliente` = '$cd_cl'") or die(mysql_error());
	header("location:premium.php?$cd_cl&msg=2");
}

function addCliente_tb() {

	$cd_cl = $_POST["cod_adidas"];
    $resultado_npedido = mysqli_query($con, "INSERT INTO `$banco`.`tb_cle` (`id`, `cliente`, `typt`) VALUES (NULL, '$cd_cl', '')") or die(mysql_error());
	header("location:premium.php?cadastrado");
}
#-------------------------------------------------------------------------------------------------------------------------------------------

function addGrupo() {
	
	$cd_cl = $_GET["cod_cl"];
	
	$query_fx_2 = mysqli_query($con,"SELECT * FROM `login` WHERE `nome` = '$cd_cl'") or die(mysql_error());
    while($array_fx_2 = mysqli_fetch_assoc($query_fx_2)){	
	
	$nome_cliente_fx_2         = $array_fx_2["B"];
	$ssql = mysqli_query($con,"UPDATE  tb_cle SET `typt` = '' WHERE  `cliente` = '$nome_cliente_fx_2'") or die(mysql_error());
	
	}
	header("location:premium.php?$cd_cl&msg=456");
}

function remGrupo() {
	
	$cd_cl = $_GET["cod_cl"];
	
	$query_fx_2 = mysqli_query($con, "SELECT * FROM `login` WHERE `nome` = '$cd_cl'") or die(mysql_error());
    while($array_fx_2 = mysqli_fetch_assoc($query_fx_2)){	
	
	$nome_cliente_fx_2         = $array_fx_2["B"];
	$ssql = mysqli_query($con,"UPDATE  tb_cle SET `typt` = '1' WHERE  `cliente` = '$nome_cliente_fx_2'") or die(mysql_error());
	
	}
	header("location:premium.php?$cd_cl&msg=555");
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="images/iso.png" rel="shortcut icon"  type="image/png"/>
<link href="images/iso.png" rel="apple-touch-icon" type="image/png"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="visualize.jQuery.css"/>
<script type="text/javascript" src="visualize.jQuery.js"></script>
<script src="mint.js" type="text/javascript"></script>
<script type="text/javascript" src="jquery.js">    </script>
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="menu.js"></script>
<title>ADISUL- Controle Administrativo</title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<style type="text/css">
@import url("menu.css");
#p_painel {
	position:absolute;
	left:0;
	top:50px;
	width:860px;
	height:auto;
	background-color: #CCCCCC;
	padding: 20px;
}
* {
	margin: 0px;
	padding: 0px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 8pt;
}

#container {
	position:relative;
	margin:auto;
	width:900px;}
body {
	background-color:#000;}


.efeito {
	text-decoration:blink;
	}
#lista_z {
	padding: 10px 0 10px 10px;
	position: absolute;
	left: 0;
	top: 250px;
	padding-top:100px;
	width: 430px;
	height: 564px;
	background-color: #FFFFFF;
	background-image:url(images/comacesso.jpg) ;
	background-position:top center;
	background-repeat:no-repeat;
}
#addi_cliente {
	padding: 10px 0 10px 10px;
	position: absolute;
	left: 475px;
	top: 250px;
	padding-top:100px;
	width: 430px;
	height: 564px;
	background-color: #FFFFFF;
	background-image:url(images/semacesso.jpg) ;
	background-position:top center;
	background-repeat:no-repeat;
}

#add_cliente {
	padding:10px;
	position: absolute;
	left: 0;
	top: 30px;	
	width: 300px;
	height: auto;
	padding-top:80px;
	background-color: #FFFFFF;
	background-image:url(images/cada_cliente.jpg);
	background-position:center top;
	background-repeat:no-repeat;
	

}
.campo_select {
	width:50%;
	display:block; 
	background-color:#9C3;
	float:left; 
	margin-top:200px;
	height:auto;
	}
.campo_select_2 { 
	width:50%;
	display:block; 
	background-color:#F96;
	float:left; 
	margin-top:200px;
	height:auto;
	}
</style>
</head>
<body>

<div id="faixa"></div>
<div id="container">
<?php echo $menu_adi;?>
<div id="add_cliente">
Caso o cliente cadastrado não esteja na lista abaixo adicione seu código da adidas neste campo e clique em adicionar <form action="<?php echo $PHP_SELF;?>?addCliente_tb" method="post"><input type="text" name="cod_adidas" size="6"  /> <input type="submit" value="Adicionar" style="padding:3px;" />
</form>
</div>

</div>
<div class="campo_select">
<?php
$query_fx = mysqli_query($con,"SELECT * FROM `$banco`.`tb_cle` WHERE `typt` = '' ORDER BY `cliente` ASC") or die(mysql_error());
while($array_fx = mysqli_fetch_assoc($query_fx)){	
	$cliente_fx         = $array_fx["cliente"];
	
	#------ Pegando nomes e outras informações-------------
	$query_fx_2 = mysqli_query($con,"SELECT * FROM `$banco`.`login` WHERE `B` = '$cliente_fx'") or die(mysql_error());
    while($array_fx_2 = mysqli_fetch_assoc($query_fx_2)){	
	$nome_cliente_fx_2         = $array_fx_2["loja"];
	$grupo_cliente_fx_2         = $array_fx_2["nome"];
	}
	
	echo "<label class=\"texto_14\">
			<a href='?chemar&cod_cl=$cliente_fx' title=\"Retirar da lista de acesso\">--->
				<span class=\"texto_13\">$cliente_fx</span>
			</a> 
			<span class=\"texto_15\">
				<a href='?remGrupo&cod_cl=$grupo_cliente_fx_2' title=\"Adicionar grupo para acesso a loja\">
				$grupo_cliente_fx_2
				</a>
			</span>  			
			<span class=\"texto_12\">$nome_cliente_fx_2</span> 

		</label>
		"; 

$nome_cliente_fx_2 = "";	
}

?>
</div>
<div  class="campo_select_2">
<?php
$query_fx = mysqli_query($con,"SELECT * FROM `$banco`.`tb_cle` WHERE `typt` = '1' ORDER BY `cliente` ASC") or die(mysql_error());
while($array_fx = mysqli_fetch_assoc($query_fx)){	
	$cliente_fx         = $array_fx["cliente"];
	
	#------ Pegando nomes e outras informações-------------
	$query_fx_2 = mysqli_query($con,"SELECT * FROM `$banco`.`login` WHERE `B` = '$cliente_fx'") or die(mysql_error());
    while($array_fx_2 = mysqli_fetch_assoc($query_fx_2)){	
	$nome_cliente_fx_2         = $array_fx_2["loja"];
	$grupo_cliente_fx_2         = $array_fx_2["nome"];
	}
	
	echo "<label class=\"texto_14\">
			<a href='?chamar&cod_cl=$cliente_fx' title=\"Retirar da lista de acesso\"><---
			<span class=\"texto_13\">$cliente_fx</span></a> 
			<span class=\"texto_15\">
				<a href='?grupoAdd&cod_cl=$grupo_cliente_fx_2' title=\"Adicionar grupo para acesso a loja\">
				$grupo_cliente_fx_2
				</a>
			</span> 			
			<span class=\"texto_12\">$nome_cliente_fx_2</span> 

		</label>
		"; 
	
}

?>
</div>

</body>
</html>