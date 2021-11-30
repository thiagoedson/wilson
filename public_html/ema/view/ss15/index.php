<?php
session_start();
$tabela = "prevendass16";
$categoria = $_GET["categoria"];
$search    = $_GET["search"];
$tipo      = $_GET["tipo"];
$gender    = $_GET["gender"];
$price     = $_GET["price"];
$order     = $_GET["order"];
$categoria_tipo = "AND";
include"../../conexao.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<title>adisul.net</title>
<style type="text/css" media="all">
@import url("estilo_shop.css");
</style>
<script>
function click() {
if (event.button==2||event.button==3) {
oncontextmenu='return false';
}
}
document.onmousedown=click
document.oncontextmenu = new Function("return false;")
</script>
<link rel="stylesheet" href="css/mosaic.css" type="text/css" media="screen" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript" src="js/mosaic.1.0.1.js"></script>

<script type="text/javascript">  
			
			jQuery(function($){
				
				$('.circle').mosaic({
					opacity		:	0.8			//Opacity for overlay (0-1)
				});
				
				$('.fade').mosaic();
				
				$('.bar').mosaic({
					animation	:	'slide'		//fade or slide
				});
				
				$('.bar2').mosaic({
					animation	:	'slide'		//fade or slide
				});
				
				$('.bar3').mosaic({
					animation	:	'slide',	//fade or slide
					anchor_y	:	'top'		//Vertical anchor position
				});
				
				$('.cover').mosaic({
					animation	:	'slide',	//fade or slide
					hover_x		:	'400px'		//Horizontal position on hover
				});
				
				$('.cover2').mosaic({
					animation	:	'slide',	//fade or slide
					anchor_y	:	'top',		//Vertical anchor position
					hover_y		:	'80px'		//Vertical position on hover
				});
				
				$('.cover3').mosaic({
					animation	:	'slide',	//fade or slide
					hover_x		:	'400px',	//Horizontal position on hover
					hover_y		:	'300px'		//Vertical position on hover
				});
		    
		    });
		    
</script>
<script type="text/javascript">
$().ready(function() {
	$("#search").autocomplete("get_course_list.php", {
		width: 260,
		matchContains: true,
		selectFirst: false
	});
});
</script>
</head>
<body>
<div id="conta">
<?php include"top.php";?>
<div id="campo1">
<fieldset>
<legend>Pesquisa 1:</legend>
<form action="<?php echo $PHP_SELF; ?>" method="get">
<select name="tipo">
						<option value="Footwear" <?php if($tipo == "Footwear"){echo "selected=\"selected\" ";}?> >Calçados</option>	
  						<option value="Hardware" <?php if($tipo == "Hardware"){echo "selected=\"selected\" ";}?> >Equipamento</option>
  						<option value="Apparel"  <?php if($tipo == "Apparel") {echo "selected=\"selected\" ";}?> >Têxtil</option>
  						
</select>
<select name="categoria">  						 			          
<?php

$query_ca = mysqli_query($con, "SELECT DISTINCT(`Categoria`) FROM  `rbkne024_reebok`.`$tabela`  ORDER BY `Categoria`") or die(mysql_error());
while($array_ca = mysqli_fetch_array($query_ca)){
if($categoria == $array_ca["Categoria"]) {$condi_eua = "selected=\"selected\" ";}
else {$condi_eua = "";}
echo "<option ".$condi_eua." >".$array_ca["Categoria"]."</option>";}
?>
</select>
<select name="gender">
<?php if($gender == "x") {$cheeked = "selected=\"selected\""; $sinal_x = "<>"; $gender = "";} else { $cheeked = ""; $sinal_x = "="; }?>
<option value="x" <?php echo $cheeked;?> >Tudo</option>
<?php
$categoria_ge = $_GET["gender"];
$query_ge = mysqli_query($con, "SELECT DISTINCT `Gender` FROM  `rbkne024_reebok`.`$tabela` WHERE `Usage` LIKE '%".$segmentacao_2."%'") or die(mysql_error());
while($array_ge = mysqli_fetch_array($query_ge)){echo "<option>".$array_ge["Gender"]."</option>";}
?>
</select>
<select name="order">
  						
                        <option value="vitrine" <?php if($order  == "vitrine")          {echo "selected=\"selected\" ";}?>>Preço</option>
                        <option value="Descricao" <?php if($order  == "Descricao")          {echo "selected=\"selected\" ";}?>>Nome</option>
                          
                       	
</select>

                        <input type="submit"  value="Buscar" style="width:100px; padding:1px;"/></form>
</fieldset>

<fieldset>
<legend>Pesquisa 2:</legend>
<form action="#" method="get">
Buscar produto por Artigo ou nome:<input type="text" name="search"  style="width:130;" /> Ordenar por <select name="preco_orden">
																						               <option value="Descricao">Nome</option>
                                                                                                       <option value="vitrine">Preço</option>
                                                                                                    </select>
<input type="submit" value="Buscar" style="width:100px; padding:1px;" />
</form>
</fieldset>
</div>
<div id="resultado">
<center>
<br />
<br />
<?php
function verifica($tabela , $con_reebok) { 

$mysql_verifica = "SELECT * FROM `rbkne024_reebok`.`$tabela`";

if(!(mysqli_query($con_reebok, $mysql_verifica))) { 
echo "<p class=\"msg_3\">
		<img src=\"img/msg_3.jpg\"><br />
		Estamos atualizando o banco de dados , dentro de instantes estaremos de volta</p>"; 
exit;
} else { 

echo $msg_4; 

} 
} 

verifica("$tabela", $con_reebok); 

 if($_GET["search"] == "" && $_GET["tipo"] == ""  && $_GET["categoria"] == ""){
	 
?>




<?php

;}
  elseif($_GET["search"] == "" && $_GET["tipo"] == "X" && $_GET["categoria"] <> "") {?> <span class="msgalert">Escolha primeiro a Divisão!</span><?php ;}  
  elseif($_GET["search"] == "" && $_GET["tipo"] <> ""  && $_GET["categoria"] == "X"){?> <span class="msgalert">Escolha a Categoria!</span><?php ;}  
  elseif($_GET["search"] == "" && $_GET["tipo"] <> ""  && $_GET["categoria"] <> "") {?>Resultado para <span class="pesquisa"><?php 	echo $tipo." e ".$categoria."</span>";} 
  
  else                                                                              {?>Resultado para <span class="pesquisa"><?php 	echo $search."</span>";} ?>
</center>
<br />
<?php 
$sinal = "=";
if($gender == ""){$sinal = "<>";}
if($order == "") {$order = "ORDER BY `Descricao` ASC";}
elseif($order == "vitrine") {$order = "ORDER BY CAST(vitrine as SIGNED) ASC;";}
elseif($order == "Descricao") {$order = "ORDER BY `Descricao` ASC";}	
elseif($order == "Data de Lancamento") {$order = "ORDER BY `Data de Lancamento` ASC";}

     
       if($price == "futebol") {$regra_price = " AND `Categoria` = '06 Football/Soccer'  ";}
   elseif($price <> "")        {$regra_price = " AND `vitrine` < '$price'  ";}
                           else{$regra_price = " AND `Categoria` = '$categoria'   ";}



if($tipo <> "") { 					   
			   
$query = mysqli_query($con, "SELECT DISTINCT `Artigo`,`Descricao`,`vitrine`,`pag`,`NCM`,`IPI` FROM  `rbkne024_reebok`.`$tabela` WHERE Divisao = '$tipo' $regra_price  $order") or die(mysql_error());


}
if($search <> "") { 

#-----------Tratamento da order por do search --------------------------------

$order_s = $_GET["preco_orden"];

    if($order_s == "") {$order_search = "ORDER BY `Descricao` ASC";}
elseif($order_s == "vitrine") {$order_search = "ORDER BY CAST(vitrine as SIGNED) ASC";}
			   
$query = mysqli_query($con, "SELECT DISTINCT `Artigo`,`Descricao`,`vitrine`,`pag`,`NCM`,`IPI` FROM  `rbkne024_reebok`.`$tabela` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."')  $order") or die(mysql_error());

}

if($query == "") {} 

else 
{
$lin = mysqli_num_rows($query);
    if($lin==0) // verifica se retornou algum registro
    {
    echo '<center><span  class="msgalert" > Nada encontrado ou fora de sua segmentação</span></center>';
     }
while($array = mysqli_fetch_array($query)){
$s_artigo  = $array["Artigo"];
$s_descri  = $array["Descricao"];
$s_vitrine = $array["vitrine"];
$s_ncm     = $array["NCM"];
$s_ipi     = $array["IPI"];
$pag       = $array["pag"];
$s_segment = strtoupper($s_segment);
$s_usage   = strtoupper($s_usage);

#----------------------------------------------------------------------------------
$query_cont = mysqli_query($con, "SELECT Artigo FROM `rbkne024_reebok`.`$tabela` WHERE Artigo = '$s_artigo'");
$cont_artigo = mysqli_num_rows($query_cont);
#--------------------------------------Formula----------------------
$s_vitrine = str_replace(",", ".", $s_vitrine);
$s_vitrine =  number_format($s_vitrine, 2, ',', '.'); 	
$s_vitrine = str_replace(",", ".", $s_vitrine);
$s_vitrine =  number_format($s_vitrine, 2, ',', '.'); 
#--------------------------------------------------------------------
$img_logo = "<img src=\"../../../favicon_1.ico\" title=\"Reebok\" />";
#---------------------------------------------------------------------
$s_descri = substr($s_descri, 0, 25);  // retorna "abcde"    
$img = "<center><img src=\"http://adisul.net/demandimage/rbk/thumb/".$s_artigo."_F.jpg\"  style=\"max-height:120px;\"  /></center>";
$resultado_index = "
<a href=\"shop.php?artigo=$s_artigo\"  title=\"Clique para ver o produto\" id=\"galeria\">
	<label class=\"label\">$s_descri <br />
	<img src=\"img/bar.jpg\" /><br />
	<font class=\"lang\" >$s_artigo</font>	
	$img
	<center>
	$img_logo Preço Sugerido <br />
	<span class=\"price\">R$ $s_vitrine</span>

	</center>
	<font class=\"segm\"><center></center></font><br />
	<img src=\"img/bar.jpg\" /><br />

	NCM-$s_ncm<br />
	IPI-$s_ipi<br />
	Página : $pag
	</label>
</a>";
echo $resultado_index;	
$tudo = "";

}
};
?>
</div>
</div>

<div id="painel_botton"><span class="email"></span>
</div>
<div id="mask"></div> 
</body>
</html>