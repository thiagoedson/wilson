<?php
session_cache_limiter( 'nocache' );
session_start();
include"conexao.php";
$chemar = $_GET["chemar"];
$sv_post_art = $_POST["artigo"];
$sv_post_season = $_POST["season"];

if($sv_post_art <> "") {

$query_star_v = mysqli_query($con,"SELECT * FROM `$banco`.`artigo_star` WHERE `artigo` = '$sv_post_art'");

$lin = mysqli_num_rows($query_star_v);
    if($lin==0) // verifica se retornou algum registro
    {
     $query_star_x = mysqli_query($con,"INSERT INTO `$banco`.`artigo_star` (`id`, `artigo` ,`season`) VALUES (NULL ,'$sv_post_art', '$sv_post_season')");
     }

}


function remArtigo() {
	
	$cd_cl = $_GET["id"];
	$ssql = mysqli_query($con,"DELETE FROM `artigo_star` WHERE `id` = '$cd_cl';");
	header("location:star.php?id=$cd_cl");
}


if(isset($chemar)){
remArtigo();
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
<title>ADISUL- Controle Administrativo</title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<script type="text/javascript" src="jquery.js">    </script>
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="menu.js"></script>
<style type="text/css" media="all">
@import url("menu.css");
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
	
#campo_25 {
	position: absolute;
	left: 0;
	top: 150px;
	width: 450px;
	height: auto;
	background-color: #FFFFFF;
	background-image: url(images/logo_star.jpg);
	background-repeat: no-repeat;
	padding: 20px;
	padding-top: 70px;
}
</style>
</head>
<body>
<div id="faixa"></div>
<div id="container">
<?php echo $menu_adi;?>
<div id="campo_25">

<br />
<br />
<form action="<?php echo $PHP_SELF; ?>" method="post">
Artigo:<input type="text" size="10" max="6" maxlength="6" name="artigo" /> Pré-venda:
            <select name="season">
			<option>FW13</option>
            <option>SS14</option>
            </select>   
       <input type="submit" value="Adicionar" style="padding:5px;" />
</form>
<br />
<br />
<br />

<table style="border:none; border-color:transparent; border-style:none;border-width:thick;">
  <tr>
    <td>Artigo</td><td></td><td>Coleção</td><td></td>
  </tr>
  
<?php 
$query_star = mysqli_query($con,"SELECT * FROM `$banco`.`artigo_star` ORDER BY `artigo`");

 while ($array_star    = mysqli_fetch_assoc($query_star)){
		$st_artigo       = $array_star["artigo"];
		$st_season       = $array_star["season"];
		$st_id           = $array_star["id"];
		
		echo "<tr><td>$st_artigo</td><td><img src=\"adisul.com/thumb/".$st_artigo."_F.jpg\" width=\"50px\" heidth=\"50px\" /></td><td>$st_season</td><td><a href='?chemar&id=$st_id' title=\"\"><img src=\"images/excluir.png\"</a></td></tr>";
 }

?>
</table>
</div>

</div>
</body>
</html>