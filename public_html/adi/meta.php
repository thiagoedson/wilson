<?php
session_cache_limiter( 'nocache' );
session_start();
include"conexao.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADISUL- Controle Administrativo</title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<style type="text/css">
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
	
}

#container {
	position:relative;
	margin:auto;
	width:900px;}
body {
	background-color:#000;}
</style>
<link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>

<style type="text/css" media="all">
@import url("menu.css");

vc {
	text-align:center}

</style>
</head>

<body>
<div id="container">
<?php echo $menu_adi;?>

<div id="p_painel"><br />
<br />

<h1 style="font-size:22pt;"><img src="images/Gear.png" />Relatório de Carteira - Pré Venda FW12</h1>
<br />

<h2>Os valores informados nesta página são coletados do relátio de Carteira Descriminando "Order Type"  FW e as <br />
datas expotas aqui. Os valores são sujeitos a alterações se as mesmas forem alteradas no banco.</h2>
<br />


<table  width="100%" align="right">

  <tr>
    <td align="center">Representante</td><td>Divisão</td><td  align="right">Julho</td><td>Agosto</td><td>Setembro</td><td>Outubro</td><td>Novembro</td><td>Dezembro</td>
  </tr>
  <tr>
    <td>Calçado (Importado)</td><td>1.Imp Footwear</td>
    <td><?php
	#--- Meta de 1.Imp Footwear  Julho
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND (!`SportCode` = 'NOT SPORTS SPECIFIC'  AND !`SportCode` = 'ORIGINALS') AND `Data Entrega  Revisada` BETWEEN '2012-07-01' AND '2012-07-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
    <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '1.Imp Footwear' AND `Data Entrega  Revisada` BETWEEN '2012-08-01' AND '2012-08-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Setembro
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '1.Imp Footwear' AND `Data Entrega  Revisada` BETWEEN '2012-09-01' AND '2012-09-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Outubro
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '1.Imp Footwear' AND `Data Entrega  Revisada` BETWEEN '2012-10-01' AND '2012-10-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Novembro
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '1.Imp Footwear' AND `Data Entrega  Revisada` BETWEEN '2012-11-01' AND '2012-11-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Dezembro
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '1.Imp Footwear' AND `Data Entrega  Revisada` BETWEEN '2012-12-01' AND '2012-12-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
  </tr>
    <tr>
    <td>Têxtil (Importado)</td><td>3.Imp Apparel</td>
    <td><?php
	#--- Meta de 1.Imp Footwear  Julho
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '3.Imp Apparel' AND `Data Entrega  Revisada` BETWEEN '2012-07-01' AND '2012-07-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
    <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '3.Imp Apparel' AND `Data Entrega  Revisada` BETWEEN '2012-08-01' AND '2012-08-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Setembro
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '3.Imp Apparel' AND `Data Entrega  Revisada` BETWEEN '2012-09-01' AND '2012-09-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '3.Imp Apparel' AND `Data Entrega  Revisada` BETWEEN '2012-10-01' AND '2012-10-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '3.Imp Apparel' AND `Data Entrega  Revisada` BETWEEN '2012-11-01' AND '2012-11-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '3.Imp Apparel' AND `Data Entrega  Revisada` BETWEEN '2012-12-01' AND '2012-12-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
  </tr>
     <tr>
    <td>Equipamento (Importado)</td><td>5.Imp Hardware</td>
    <td><?php
	#--- Meta de 1.Imp Footwear  Julho
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '5.Imp Hardware' AND `Data Entrega  Revisada` BETWEEN '2012-07-01' AND '2012-07-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
    <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '5.Imp Hardware' AND `Data Entrega  Revisada` BETWEEN '2012-08-01' AND '2012-08-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Setembro
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '5.Imp Hardware' AND `Data Entrega  Revisada` BETWEEN '2012-09-01' AND '2012-09-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '5.Imp Hardware' AND `Data Entrega  Revisada` BETWEEN '2012-10-01' AND '2012-10-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '5.Imp Hardware' AND `Data Entrega  Revisada` BETWEEN '2012-11-01' AND '2012-11-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '5.Imp Hardware' AND `Data Entrega  Revisada` BETWEEN '2012-12-01' AND '2012-12-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
  </tr>
       <tr>
    <td>Calçado (Nacional)</td><td>2.Loc Footwear</td>
    <td><?php
	#--- Meta de 1.Imp Footwear  Julho
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '2.Loc Footwear' AND `Data Entrega  Revisada` BETWEEN '2012-07-01' AND '2012-07-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
    <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '2.Loc Footwear' AND `Data Entrega  Revisada` BETWEEN '2012-08-01' AND '2012-08-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Setembro
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '2.Loc Footwear' AND `Data Entrega  Revisada` BETWEEN '2012-09-01' AND '2012-09-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '2.Loc Footwear' AND `Data Entrega  Revisada` BETWEEN '2012-10-01' AND '2012-10-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '2.Loc Footwear' AND `Data Entrega  Revisada` BETWEEN '2012-11-01' AND '2012-11-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '2.Loc Footwear' AND `Data Entrega  Revisada` BETWEEN '2012-12-01' AND '2012-12-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
           <tr>
    <td>Têxtil (Nacional)</td><td>4.Loc Apparel</td>
    <td><?php
	#--- Meta de 1.Imp Footwear  Julho
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '4.Loc Apparel' AND `Data Entrega  Revisada` BETWEEN '2012-07-01' AND '2012-07-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
    <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '4.Loc Apparel' AND `Data Entrega  Revisada` BETWEEN '2012-08-01' AND '2012-08-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Setembro
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '4.Loc Apparel' AND `Data Entrega  Revisada` BETWEEN '2012-09-01' AND '2012-09-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '4.Loc Apparel' AND `Data Entrega  Revisada` BETWEEN '2012-10-01' AND '2012-10-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '4.Loc Apparel' AND `Data Entrega  Revisada` BETWEEN '2012-11-01' AND '2012-11-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '4.Loc Apparel' AND `Data Entrega  Revisada` BETWEEN '2012-12-01' AND '2012-12-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
  </tr>
  
            <tr>
    <td>Equipamento (Nacional)</td><td>6.Loc Hardware</td>
    <td><?php
	#--- Meta de 1.Imp Footwear  Julho
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '6.Loc Hardware' AND `Data Entrega  Revisada` BETWEEN '2012-07-01' AND '2012-07-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
    <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '6.Loc Hardware' AND `Data Entrega  Revisada` BETWEEN '2012-08-01' AND '2012-08-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Setembro
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '6.Loc Hardware' AND `Data Entrega  Revisada` BETWEEN '2012-09-01' AND '2012-09-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '6.Loc Hardware' AND `Data Entrega  Revisada` BETWEEN '2012-10-01' AND '2012-10-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '6.Loc Hardware' AND `Data Entrega  Revisada` BETWEEN '2012-11-01' AND '2012-11-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW' AND `Categoria` = '6.Loc Hardware' AND `Data Entrega  Revisada` BETWEEN '2012-12-01' AND '2012-12-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
  </tr>
  
    
         <tr style="background:#FFF;font-weight:bold;">
    <td><B>Total</B> </td><td></td>
    <td><?php
	#--- Meta de 1.Imp Footwear  Julho
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW'  AND `Data Entrega  Revisada` BETWEEN '2012-07-01' AND '2012-07-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
    <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW'  AND `Data Entrega  Revisada` BETWEEN '2012-08-01' AND '2012-08-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Setembro
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW'  AND `Data Entrega  Revisada` BETWEEN '2012-09-01' AND '2012-09-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW'  AND `Data Entrega  Revisada` BETWEEN '2012-10-01' AND '2012-10-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW'  AND `Data Entrega  Revisada` BETWEEN '2012-11-01' AND '2012-11-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
     <td><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW'  AND `Data Entrega  Revisada` BETWEEN '2012-12-01' AND '2012-12-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?>
	</td>
  </tr>

</table>
<br />


<span style="background-color:#FFF; font-size:14pt; text-align:center;">
<br />
<center>
Total da carteira de <b>01/07/2012</b> à <b>31/12/2012</b> Order Type FW12 <b><?php
	#--- Meta de 1.Imp Footwear  Agosto
	$sql_m = mysqli_query($con,"SELECT SUM(REPLACE(`Valor total a Faturar`,'.','')) as total FROM `$banco`.`carteira` WHERE `Order Type` = 'FW'  AND `Data Entrega  Revisada` BETWEEN '2012-07-01' AND '2012-12-31'");
	while($array_m = mysqli_fetch_assoc($sql_m)){$imp_julho = $array_m["total"];}
	$imp_julho        =  number_format($imp_julho, 2, ',', '.');		
	echo $imp_julho;	
    ?></b>
  <br />


Data do  Relatório de Carteira 
<?php
$query_site = mysqli_query($con,"SELECT * FROM site") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site = mysqli_fetch_assoc($query_site)){	
	$colecao = $array_site["colecao"];
	$data_atua = $array_site["data_atua"];
	$titulo = $array_site["titulo"];
	$carteira = $array_site["carteira"];
	$faturamento = $array_site["faturamento"];
	$situa = $array_site["situa"];
	$cancelamento = $array_site["cancelamento"];

	$carteira = date('d/m/Y', strtotime(str_replace("-", "/", $carteira )));
	echo $carteira;
	
}

?>
</center>
</span>
</div>
</div>

<?php
$mensagem = "Nova visita no site";
salvaLog($con,$mensagem);
?>
</body>
</html>