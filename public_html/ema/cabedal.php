<?php
# Informa qual o conjunto de caracteres será usado.
header('Content-Type: text/html; charset=utf-8');

include "conexao.php";

$cabedal_artigo = $_GET["artigo"];

# Aqui está o segredo
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INFO</title>
<style type="text/css">

* {
	font-family:Verdana, Geneva, sans-serif;
	font:Verdana, Geneva, sans-serif;
	font-size:10pt;
	margin:0;
	padding:0;
}

#conta {
	position:absolute;
	top:0;
	left:0;
	width:900px;
	height:auto;}

.texto1 {
	background-color:#E4E4E4;	
	display:block;
	width:260px;	
	height:auto;
	padding:1px 5px 1px 5px;
	border:double;
	border-color:#030303;
	text-align:center;
	
}

.texto2 {
	background-color:#CCC;
	text-align:center;
	padding:1px 5px 1px 5px;
	width:260px;	
	display:block;
	border:double;
	border-color:#030303;	
	height:auto;
	
}

.toco {
	display:block;
	float:left;}
</style>
</head>

<body>
<?php

$query_cabedal = mysql_query("SELECT * FROM dados_artigos WHERE `artigo` = '$cabedal_artigo' LIMIT 1") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_cabedal = mysql_fetch_array($query_cabedal)){	
	
	$cabe_artigo       = $array_cabedal["artigo"];
	$cabe_cabedal      = $array_cabedal["cabedal"];
	$cabe_material     = $array_cabedal["Material-Composition"];
	$cabe_revestimento = $array_cabedal["Revestimento"];
	$cabe_entresola    = $array_cabedal["Entressola"];
	$cabe_sola         = $array_cabedal["Sola"];
	$cabe_vantagens    = $array_cabedal["Vantagens"];
	$cabe_texto        = $array_cabedal["Texto"]; 
	$cabe_b2c          = $array_cabedal["B2C Copy"]; 
	$cabe_material_con = $array_cabedal["Material-Construction"]; 
	$cabe_gender       = $array_cabedal["Gender"]; 
	$cabe_age          = $array_cabedal["Age Group"];
	$cabe_descri       = $array_cabedal["Source Model Name"]; 
	
	
	if($cabe_age == "adults") { $cabe_age = "Adulto";}
	elseif($cabe_age == "kids") { $cabe_age = "Infantil";}
	elseif($cabe_age == "infants") { $cabe_age = "Infantil";}
	elseif($cabe_age == "children") { $cabe_age = "Infantil";}
	elseif($cabe_age == "junior") { $cabe_age = "Junior";}
	else { $cabe_age = "Adulto";}
	
	
	if($cabe_gender == "male") {$cabe_gender = "Masculino";}
	elseif($cabe_gender == "female") { $cabe_gender = "Femenino";}	
	else { $cabe_gender = "Unisex";}
	
	
	 $cabe_artigo."<br/>";  
	 $cabe_cabedal = ucfirst($cabe_cabedal);
	 $cabe_material = ucfirst($cabe_material);
	 $cabe_revestimento = ucfirst($cabe_revestimento);
	 $cabe_entresola = ucfirst($cabe_entresola);
	 $cabe_sola  = ucfirst($cabe_sola);
	 $cabe_vantagens ."<br/>";
	 $cabe_texto ."<br/>";
	 $cabe_b2c ."<br/>";
	 $cabe_material_con ."<br/>";
	 $cabe_gender ."<br/>";
	 $cabe_age ."<br/>";
	
};


?>

<div id="conta">
<span class="toco"><span class="texto2"> Cabedal </span><span class="texto1"><?php echo $cabe_cabedal ;?>                             </span></span>
<span class="toco"><span class="texto2"> Revestimento </span><span class="texto1"><?php echo $cabe_revestimento ;?>                   </span></span>
<span class="toco"><span class="texto2"> Entresola </span><span class="texto1"><?php echo $cabe_entresola ;?>                         </span></span>
<span class="toco"><span class="texto2"> Sola </span><span class="texto1"><?php echo $cabe_sola ;?>                                   </span></span>
<span class="toco"><span class="texto2"> Vantagens </span><span class="texto1"><?php echo $cabe_vantagens ;?>                         </span></span>
<span class="toco"><span class="texto2"> Sobre este produto </span><span class="texto1"><?php echo $cabe_texto ;?>                    </span></span>
<span class="toco"><span class="texto2"> - </span><span class="texto1"><?php echo $cabe_b2c ;?>                                       </span></span>
<span class="toco"><span class="texto2"> Material </span><span class="texto1"><?php echo $cabe_material ;?>                           </span></span>
<span class="toco"><span class="texto2"> Material de Construção </span><span class="texto1"><?php echo $cabe_material_con ;?>         </span></span>
<span class="toco"><span class="texto2"> Sexo | Uso </span><span class="texto1"><?php echo $cabe_gender ;?> | <?php echo $cabe_age ;?></span></span>





</div>
</body>
</html>