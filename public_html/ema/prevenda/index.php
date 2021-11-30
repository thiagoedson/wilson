<?php
session_start();
include"../conexao.php";
include"sql_prevenda/pedreativo.php";
$search    = $_GET["search"];
$tipo      = $_GET["divisao"];
$categoria = $_GET["categoria"];
$gender    = $_GET["gender"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../jquery.js"></script>
<script>
function click() {
if (event.button==2||event.button==3) {
oncontextmenu='return false';
}
}
document.onmousedown=click
document.oncontextmenu = new Function("return false;")
</script>
<script type="text/javascript">
$(document).ready(function() {	
	$('a[name=modal]').click(function(e) {
		e.preventDefault();		
		var id = $(this).attr('href');	
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);	
		$(id).fadeIn(2000); 	});	
	$('.window .close').click(function (e) {
		e.preventDefault();		
		$('#mask').hide();
		$('.window').hide();	});
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();	});		

});
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fall Winter 2012 - Pré Venda</title>
<style type="text/css">
@import url("estilo.css");

</style>
</head>
<body>
<div id="conta">

<div id="painel_04"><?php echo $p_menu; ?>
<br />

<span class="segmenta" style="border-bottom:none;border-radius:10px 10px 0 0 ">Segmentação</span> 
<span class="segmenta" style="font-style:italic; border-top:none; border-radius:0 0 10px 10px"><?php echo $segmentacao;?></span>
</div>
<div id="top_banner"></div>
<a href="../principal.php" title="Voltar a página inicial do site"><div id="sair">Voltar ao Inicio</div></a>
<?php
if($p_status == "1") 
{
?>
<div id="info_cliente">
<?php

$query_info = mysql_query("SELECT * FROM login WHERE `B` = '$p_clientefilho'");
while($array_info = mysql_fetch_array($query_info)) {
	$cod_cliente_filho = $array_info["B"];
	$seg_cliente_filho = $array_info["segmento_2"];}

echo "Pedido Nº $p_pedido , inicado para loja <b>$nome_cliente_filho</b> às $p_hora</b>";
?>
</div>
<?php }?>


<div id="busca">
		<form action="<?php echo $PHP_SELF; ?>" method="GET">
        	Divisão:<select name="divisao" style="color:#000;">
<?php $busca_query_1 = mysql_query("SELECT DISTINCT Divisao FROM `adisul_adidas`.`fw12`"); while($array_bu_1 = mysql_fetch_array($busca_query_1)){
						$divisao    = $array_bu_1["Divisao"]; 
				       $divisaox    = $array_bu_1["Divisao"];
					if($divisao == "Apparel") {$divisao = "Têxtil";} 
				elseif($divisao == "Hardware") {$divisao = "Equipamento";} 
				 else {$divisao = "Calçado";}

					echo "<option value=\"$divisaox\" style=\"color:#000;\">$divisao</option>";}?>
        			</select>
            Categoria:<select name="categoria" style="color:#000;">
<?php $busca_query_2 = mysql_query("SELECT DISTINCT Categoria FROM `adisul_adidas`.`fw12`"); while($array_bu_2 = mysql_fetch_array($busca_query_2)){$categoria    = $array_bu_2["Categoria"]; echo "<option value=\"$categoria\" style=\"color:#000;\">$categoria</option>";}?>
        			</select>
                    Gênero:<select name="gender" style="color:#000;">
<?php $busca_query_3 = mysql_query("SELECT DISTINCT Gender FROM `adisul_adidas`.`fw12`"); while($array_bu_3 = mysql_fetch_array($busca_query_3)){$gender    = $array_bu_3["Gender"]; $genderx    = $array_bu_3["Gender"];
					
					if($gender == "M") {$gender = "Masculino";} elseif($gender == "W") {$gender = "Feminino";} else {$gender = "Unisex";}
					
					 echo "<option value=\"$genderx\" style=\"color:#000;\">$gender</option>";}?>
        			</select>
                    <input type="submit" value="Buscar" style="padding:3px;color:#000;" />
        </form>
        <br />
        <form action="<?php echo $PHP_SELF; ?>" method="GET">
        Pesquisa de produtos : <input type="text" name="search" /> | <input type="submit" value="Buscar" / style="padding:3px;"><br /><br />
        </form>

</div>    
<div id="result" style="color:#F90">
<?php
if($tipo <> "") 
{
	
$gender    = $_GET["gender"];
$categoria = $_GET["categoria"];
$tipo      = $_GET["divisao"];
					   
if($segmentacao == "GENERALISTA ESPORTIVO COMERCIAL") {					   
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE Divisao = '$tipo' AND Categoria = '$categoria' AND `Gender` = '$gender' AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Neo FTW/HW' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'traffic'
) ORDER BY Descricao ASC") or die(mysql_error());
}	

elseif($segmentacao == "MULTI-ESPECIALISTA DE IMAGEM")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE Divisao = '$tipo' AND Categoria = '$categoria' AND `Gender` = '$gender' AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'off-Pitch'

) ORDER BY Descricao ASC") or die(mysql_error());
}	

elseif($segmentacao == "MULTI-ESPECIALISTA COMERCIAL")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE Divisao = '$tipo' AND Categoria = '$categoria' AND `Gender` = '$gender' AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Neo FTW/HW' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'traffic' 

) ORDER BY Descricao ASC") or die(mysql_error());
}

elseif($segmentacao == "ESPECIALIZADA")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE Divisao = '$tipo' AND Categoria = '$categoria' AND `Gender` = '$gender' AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'off-Pitch'
) ORDER BY Descricao ASC") or die(mysql_error());
}

elseif($segmentacao == "GENERALISTA ESPORTIVO DE IMAGEM")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE Divisao = '$tipo' AND Categoria = '$categoria' AND `Gender` = '$gender' AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'off-Pitch'
) ORDER BY Descricao ASC") or die(mysql_error());
}

elseif($segmentacao == "DIRECTIONAL DE IMAGEM")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE Divisao = '$tipo' AND Categoria = '$categoria' AND `Gender` = '$gender' AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'Sport' or
Segmentacao = 'Top' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'off-Pitch'
) ORDER BY Descricao ASC") or die(mysql_error());
}

elseif($segmentacao == "LIFESTYLE DE IMAGEM")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE Divisao = '$tipo' AND Categoria = '$categoria' AND `Gender` = '$gender' AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'off-Pitch'
Segmentacao = 'Enhanced' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'FASHION' or
 
) ORDER BY Descricao ASC") or die(mysql_error());
}

elseif($segmentacao == "LIFESTYLE COMERCIAL")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE Divisao = '$tipo' AND Categoria = '$categoria' AND `Gender` = '$gender' AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Neo FTW/HW' or
Segmentacao = 'traffic' 
) ORDER BY Descricao ASC") or die(mysql_error());
}

elseif($segmentacao == "FASHION")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE Divisao = '$tipo' AND Categoria = '$categoria' AND `Gender` = '$gender' AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'FASHION' or
Segmentacao = 'Top' AND `Usage` = 'Fashion' or
Segmentacao = 'traffic' 
) ORDER BY Descricao ASC") or die(mysql_error());
}

elseif($segmentacao == "LOJAS CONCEITO")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE Divisao = '$tipo' AND Categoria = '$categoria' AND `Gender` = '$gender' AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'FASHION' or
Segmentacao = 'Top' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'Fashion' or
Segmentacao = 'traffic' 
) ORDER BY Descricao ASC") or die(mysql_error());
}

else {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE Divisao = '$tipo' AND Categoria = '$categoria' AND `Gender` = '$gender' AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'off-Pitch' or
Segmentacao = 'traffic' 
) ORDER BY Descricao ASC") or die(mysql_error());
}

$lin = mysql_num_rows($query);
    if($lin==0) // verifica se retornou algum registro
    {
   echo '<center><span  class="msgalert" > Nada encontrado ou fora de sua segmentação</span></center>';
     }

	while($array_pe_01 = mysql_fetch_array($query)){
		
		$artigo     = $array_pe_01["Artigo"];
		$segmento   = $array_pe_01["Segmentacao"];
		$descricao  = $array_pe_01["Descricao"];
		$vitrine    = $array_pe_01["vitrine"];
		$data_la    = $array_pe_01["Data de Lancamento"];
		$usage      = $array_pe_01["Usage"];
		
		
	$segmento = strtoupper($segmento);	
	$vitrine = str_replace(",", ".", $vitrine);
	$vitrine =  number_format($vitrine, 2, ',', '.');
	$data_la = date('d/m/Y', strtotime(str_replace("-", "/", $data_la )));
#----------------------------------------------------------------------------------
$query_cont = mysql_query("SELECT Artigo FROM `adisul_adidas`.`fw12` WHERE Artigo = '$artigo'");
$cont_artigo = mysql_num_rows($query_cont);
#--------------------------------------Formula----------------------
	
		
	if($segmento == "CORE")           {$cor = "style=\"color:#090;border-color:#090;font-size:6pt;\"";} 
	elseif($segmento == "TOP")        {$cor = "style=\"color:#F00;border-color:#F00;font-size:6pt;\"";} 
	elseif($segmento == "ENHANCED")   {$cor = "style=\"color:#F90;border-color:#F90;font-size:6pt;\"";}
	elseif($segmento == "TRAFFIC")    {$cor = "style=\"color:#09F;border-color:#09F;font-size:6pt;\"";} 
	else							  {$cor = "style=\"color:#F90;border-color:#F90;font-size:6pt;\"";}
	
	
	
$img = "<img src=\"http://adisul.com/thumb/".$artigo."_F.jpg\" width=\"120px\" height=\"100px\" />";
$resultado_index = "<a href=\"shop.php?artigo=$artigo\"  title=\"$descricao\"><label >$descricao <br />
$img<br />
Vitrine R$ $vitrine <br /><b $cor >$segmento</b><font class=\"informa\"> | $usage |  $cont_artigo</font><br />

<font class=\"informa\">Lançamento $data_la</font><font class=\"lang\" >$artigo</font>
</label></a>";

echo $resultado_index;	

$segmento = "";
}}

if($search <> "") 
{
	
				   
if($segmentacao == "GENERALISTA ESPORTIVO COMERCIAL") {					   
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."') AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Neo FTW/HW' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'traffic'
) ORDER BY Descricao ASC") or die(mysql_error());
}	

elseif($segmentacao == "MULTI-ESPECIALISTA DE IMAGEM")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."') AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'off-Pitch'

) ORDER BY Descricao ASC") or die(mysql_error());
}	

elseif($segmentacao == "MULTI-ESPECIALISTA COMERCIAL")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."') AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Neo FTW/HW' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'traffic' 

) ORDER BY Descricao ASC") or die(mysql_error());
}

elseif($segmentacao == "ESPECIALIZADA")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."') AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'off-Pitch'
) ORDER BY Descricao ASC") or die(mysql_error());
}

elseif($segmentacao == "GENERALISTA ESPORTIVO DE IMAGEM")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."') AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'off-Pitch'
) ORDER BY Descricao ASC") or die(mysql_error());
}

elseif($segmentacao == "DIRECTIONAL DE IMAGEM")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."') AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'Sport' or
Segmentacao = 'Top' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'off-Pitch'
) ORDER BY Descricao ASC") or die(mysql_error());
}

elseif($segmentacao == "LIFESTYLE DE IMAGEM")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."') AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'off-Pitch'
Segmentacao = 'Enhanced' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'FASHION' or
 
) ORDER BY Descricao ASC") or die(mysql_error());
}

elseif($segmentacao == "LIFESTYLE COMERCIAL")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."') AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Neo FTW/HW' or
Segmentacao = 'traffic' 
) ORDER BY Descricao ASC") or die(mysql_error());
}

elseif($segmentacao == "FASHION")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."') AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'FASHION' or
Segmentacao = 'Top' AND `Usage` = 'Fashion' or
Segmentacao = 'traffic' 
) ORDER BY Descricao ASC") or die(mysql_error());
}

elseif($segmentacao == "LOJAS CONCEITO")  {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."') AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'Sport' or
Segmentacao = 'Enhanced' AND `Usage` = 'FASHION' or
Segmentacao = 'Top' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'Fashion' or
Segmentacao = 'traffic' 
) ORDER BY Descricao ASC") or die(mysql_error());
}

else {
$query = mysql_query("SELECT DISTINCT `Artigo`, `Descricao`, `vitrine`, `Segmentacao`, `Usage`, `Data de Lancamento` FROM  `adisul_adidas`.`fw12` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."') AND (
Segmentacao = 'Core' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Core' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Enhanced' AND `Usage` = 'off-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'on-Pitch' or
Segmentacao = 'Top' AND `Usage` = 'off-Pitch' or
Segmentacao = 'traffic' 
) ORDER BY Descricao ASC") or die(mysql_error());
}


$lin = mysql_num_rows($query);
    if($lin==0) // verifica se retornou algum registro
    {
   echo '<br/><center><span  class="msgalert" > Nada encontrado ou sua segmentação é inferior ao produto solicitado</span></center>';
     }

	while($array_pe_01 = mysql_fetch_array($query)){$artigo  = $array_pe_01["Artigo"];$segmento = $array_pe_01["Segmento"];$descricao  = $array_pe_01["Descricao"];$vitrine  = $array_pe_01["vitrine"];$data_la  = $array_pe_01["Data de Lancamento"];
	$vitrine = str_replace(",", ".", $vitrine);
	$vitrine =  number_format($vitrine, 2, ',', '.');
	$data_la = date('d/m/Y', strtotime(str_replace("-", "/", $data_la )));
#----------------------------------------------------------------------------------
$query_cont = mysql_query("SELECT Artigo FROM `adisul_adidas`.`fw12` WHERE Artigo = '$artigo'");
$cont_artigo = mysql_num_rows($query_cont);
#--------------------------------------Formula----------------------
	
		$artigo     = $array_pe_01["Artigo"];
		$segmento   = $array_pe_01["Segmentacao"];
		$descricao  = $array_pe_01["Descricao"];
		$vitrine    = $array_pe_01["vitrine"];
		$data_la    = $array_pe_01["Data de Lancamento"];
		$usage      = $array_pe_01["Usage"];
		
		
	$segmento = strtoupper($segmento);	
	$vitrine = str_replace(",", ".", $vitrine);
	$vitrine =  number_format($vitrine, 2, ',', '.');
	$data_la = date('d/m/Y', strtotime(str_replace("-", "/", $data_la )));
#----------------------------------------------------------------------------------
$query_cont = mysql_query("SELECT Artigo FROM `adisul_adidas`.`fw12` WHERE Artigo = '$artigo'");
$cont_artigo = mysql_num_rows($query_cont);
#--------------------------------------Formula----------------------
	
		
	if($segmento == "CORE")           {$cor = "style=\"color:#090;border-color:#090;font-size:6pt;\"";} 
	elseif($segmento == "TOP")        {$cor = "style=\"color:#F00;border-color:#F00;font-size:6pt;\"";} 
	elseif($segmento == "ENHANCED")   {$cor = "style=\"color:#F90;border-color:#F90;font-size:6pt;\"";}
	elseif($segmento == "TRAFFIC")    {$cor = "style=\"color:#09F;border-color:#09F;font-size:6pt;\"";} 
	else							  {$cor = "style=\"color:#F90;border-color:#F90;font-size:6pt;\"";}
	
	
	
$img = "<img src=\"http://adisul.com/thumb/".$artigo."_F.jpg\" width=\"120px\" height=\"100px\" />";
$resultado_index = "<a href=\"shop.php?artigo=$artigo\"  title=\"$descricao\"><label >$descricao <br />
$img<br />
Vitrine R$ $vitrine <br /><b $cor >$segmento</b><font class=\"informa\"> | $usage |  $cont_artigo</font><br />

<font class=\"informa\">Lançamento $data_la</font><font class=\"lang\" >$artigo</font>
</label></a>";

echo $resultado_index;	
}}
?>
</div>

</div>

<div id="painel_botton"><span class="email"><?php echo $rodape_fixo; ?></span></div>

<div id="boxes">
<div id="dialog" class="window">
<a href="#" class="close">Fechar [X]</a><br />
<?php 
$v_p_verifica =  mysql_query("SELECT `nome`,`status` FROM login WHERE `B` = '$senha'") or die(mysql_error());
while($v_p_array = mysql_fetch_array($v_p_verifica)){
	$v_grupo             = $v_p_array["nome"];
	$v_status_login      = $v_p_array["status"];
	
	};
if($v_grupo == "SEM GRUPO") {
	?>
    Selecione a loja:
<form action="<?php echo $PHP_SELF;?>?iniciarPedidos&ok=1&tipo=<?php echo $tipo ;?>&categoria=<?php echo $categoria;?>" method="post">
  <select name="codadidas">
    
<?php
$v_p_verifica_grupo =  mysql_query("SELECT * FROM login WHERE `B` = '$senha'") or die(mysql_error());

while($v_p_array_grupo = mysql_fetch_array($v_p_verifica_grupo)){	
	
	$v_codadidas  = $v_p_array_grupo["B"];
	$v_cliente    = $v_p_array_grupo["loja"];
	$v_cnpj       = $v_p_array_grupo["C"];
	$segmenta     = $v_p_array_grupo["segmento_2"];
			
				if($segmenta == "C03") {$v_segmento = "Especializada";}
			elseif($segmenta == "C04") {$v_segmento = "Generalista de Imagem";}
			elseif($segmenta == "C05") {$v_segmento = "Generalista Comercial";}
			elseif($segmenta == "C06") {$v_segmento = "Directional de Imagem";}
			elseif($segmenta == "C07") {$v_segmento = "Lifestyle de Imagem";}
			elseif($segmenta == "C08") {$v_segmento = "Lifestyle Comercial";}
			elseif($segmenta == "C09") {$v_segmento = "Fashion";}
			elseif($segmenta == "C10") {$v_segmento = "Loja Conceito";}
			$v_segmento = strtoupper($v_segmento); 
			
	echo "<option value=\"$v_codadidas\">$v_cnpj | $v_cliente | $v_segmento</option>";
	
};
?>
    </select>
  <input name="button" type="submit"  value="Começar Pedido">
</form>
	
	<?php
	;}
	
elseif($v_status_login == "2") {
	?>
    Selecione a loja:
<form action="<?php echo $PHP_SELF;?>?iniciarPedidos&ok=1&tipo=<?php echo $tipo ;?>&categoria=<?php echo $categoria;?>" method="post">
  <select name="codadidas">
    
<?php
$v_p_verifica_grupo =  mysql_query("SELECT * FROM login WHERE `B` = '$senha'") or die(mysql_error());

while($v_p_array_grupo = mysql_fetch_array($v_p_verifica_grupo)){	
	
	$v_codadidas  = $v_p_array_grupo["B"];
	$v_cliente    = $v_p_array_grupo["loja"];
	$v_cnpj       = $v_p_array_grupo["C"];
	$segmenta     = $v_p_array_grupo["segmento_2"];
			
				if($segmenta == "C03") {$v_segmento = "Especializada";}
			elseif($segmenta == "C04") {$v_segmento = "Generalista de Imagem";}
			elseif($segmenta == "C05") {$v_segmento = "Generalista Comercial";}
			elseif($segmenta == "C06") {$v_segmento = "Directional de Imagem";}
			elseif($segmenta == "C07") {$v_segmento = "Lifestyle de Imagem";}
			elseif($segmenta == "C08") {$v_segmento = "Lifestyle Comercial";}
			elseif($segmenta == "C09") {$v_segmento = "Fashion";}
			elseif($segmenta == "C10") {$v_segmento = "Loja Conceito";}
			$v_segmento = strtoupper($v_segmento); 
			
	echo "<option value=\"$v_codadidas\">$v_cnpj | $v_cliente | $v_segmento</option>";
	
};
?>
    </select>
  <input name="button" type="submit"  value="Começar Pedido">
</form>
	
	<?php
	;}

else {
	?>
Selecione a loja:
<form action="<?php echo $PHP_SELF;?>?iniciarPedidos&ok=1&tipo=<?php echo $tipo ;?>&categoria=<?php echo $categoria;?>" method="post">
  <select name="codadidas">
   
<?php
$v_p_verifica_grupo =  mysql_query("SELECT * FROM `login` WHERE `login`.`nome` = '$v_grupo'") or die(mysql_error());

while($v_p_array_grupo = mysql_fetch_array($v_p_verifica_grupo)){	
	
	$v_codadidas  = $v_p_array_grupo["B"];
	$v_cliente    = $v_p_array_grupo["loja"];
	$v_cnpj       = $v_p_array_grupo["C"];
	$segmenta     = $v_p_array_grupo["segmento_2"];
			
				if($segmenta == "C03") {$v_segmento = "Especializada";}
			elseif($segmenta == "C04") {$v_segmento = "Generalista de Imagem";}
			elseif($segmenta == "C05") {$v_segmento = "Generalista Comercial";}
			elseif($segmenta == "C06") {$v_segmento = "Directional de Imagem";}
			elseif($segmenta == "C07") {$v_segmento = "Lifestyle de Imagem";}
			elseif($segmenta == "C08") {$v_segmento = "Lifestyle Comercial";}
			elseif($segmenta == "C09") {$v_segmento = "Fashion";}
			elseif($segmenta == "C10") {$v_segmento = "Loja Conceito";}
			$v_segmento = strtoupper($v_segmento); 
			
	echo "<option value=\"$v_codadidas\">$v_cnpj | $v_cliente | $v_segmento</option>";
	
};
?>
   </select>
  <input name="button" type="submit" onclick="" value="Começar Pedido ">
</form>

<?php ;}?>
</div>
</div>
<div id="mask"></div> 
</body>
</html>