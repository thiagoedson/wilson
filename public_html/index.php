<?php
session_start();
$user_agente = $_SERVER["HTTP_USER_AGENT"];
$Browser_Nome = strtok($user_agente, "/");
$Browser_Versao = strtok(" ");

if(preg_match("/MSIE/",$user_agente)) {

$Browser_Nome = "Internet Explorer";
$Browser_Versao = strtok("MSIE");
$Browser_Versao= strtok(" ");
$Browser_Versao = strtok(";");
}

if($Browser_Nome == "Internet Explorer") {
	
	header("location:fail.php");}
	
 // DETECTAR SE É IE
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (!preg_match('/MSIE/',$browser)) {
        // Parabéns, não é IE
    }
	else {header("location:fail.php");}

    // DETECTAR SE NÃO É IE 6
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (!preg_match('/MSIE 6/',$browser)) {
        // Não é Internet Explorer 6
    }
	else {header("location:fail.php");}
    // DETECTAR SE NÃO É IE 7
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (!preg_match('/MSIE 7/',$browser)) {
        // Não é Internet Explorer 7
    }
	else {header("location:fail.php");}
    // DETECTAR SE NÃO É IE 8
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (!preg_match('/MSIE 8/',$browser)) {
        // Não é Internet Explorer 8
    }
	else {header("location:fail.php");}
    // DETECTAR SE NÃO É IE 9
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (!preg_match('/MSIE 9/',$browser)) {
        // Não é Internet Explorer 9
    }
	else {header("location:fail.php");}
    // DETECTAR SE NÃO É IE 10
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (!preg_match('/MSIE 10/',$browser)) {
        // Não é Internet Explorer 10
    }
	else {header("location:fail.php");}
    // DETECTAR SE NÃO É IE 11
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (!preg_match('/MSIE 11/',$browser)) {
        // Não é Internet Explorer 11
    }
	else {header("location:fail.php");}
    // DETECTAR SE NÃO É IE 12
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (!preg_match('/MSIE 12/',$browser)) {
        // Não é Internet Explorer 12
    }
	else {header("location:fail.php");}
    // DETECTAR SE NÃO É IE 13
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (!preg_match('/MSIE 13/',$browser)) {
        // Não é Internet Explorer 13
    }
	else {header("location:fail.php");}
    // DETECTAR SE NÃO É IE 14
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (!preg_match('/MSIE 14/',$browser)) {
        // Não é Internet Explorer 14
    }
	else {header("location:fail.php");}
    // DETECTAR SE NÃO É IE 15
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (!preg_match('/MSIE 15/',$browser)) {
        // Não é Internet Explorer 15
    }
	else {header("location:fail.php");}
    // DETECTAR SE NÃO É IE 16
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (!preg_match('/MSIE 16/',$browser)) {
        // Não é Internet Explorer 16
    }
	else {header("location:fail.php");}
    // DETECTAR SE NÃO É IE 17
    $browser = $_SERVER['HTTP_USER_AGENT'];
    if (!preg_match('/MSIE 17/',$browser)) {
        // Não é Internet Explorer 17
    }
	else {header("location:fail.php");}
if(preg_match("/Opera/", $user_agente)) {

$Browser_Nome = "Opera";
$Browser_Versao = strtok("Opera");
$Browser_Versao = strtok("/");
$Browser_Versao = strtok(";");
}

$Sistema = "desconhecido";
if(preg_match("/Windows/",$user_agente) || preg_match("/WinNT/",$user_agente) || preg_match("/Win95/",$user_agente)) {
$sistema = "Windows";
}

if(preg_match("/Mac/", $user_agente)) {
$sistema = "Macintosh";
}
if(preg_match("/X11/", $user_agente)) {
$sistema = "Unix"; 
} 

#echo "$Browser_Nome $Browser_Versao<br>Sistema Operacional :$sistema";

$represente = $_GET["representante"];

    if($represente == "01") {header("Location:http://rbk.net.br/daniel");}
elseif($represente == "02") {header("Location:http://rbk.net.br/eifer");}
elseif($represente == "03") {header("Location:http://rbk.net.br/betaluc");}
elseif($represente == "04") {header("Location:http://rbk.net.br/ema");}
elseif($represente == "05") {header("Location:http://rbk.net.br/durrer");}
elseif($represente == "06") {header("Location:http://rbk.net.br/paschoal");}
elseif($represente == "07") {header("Location:http://rbk.net.br/jl3");}
elseif($represente == "08") {header("Location:http://rbk.net.br/moacir");}
elseif($represente == "09") {header("Location:http://rbk.net.br/schuma");}
elseif($represente == "10") {header("Location:http://rbk.net.br/eduardo");}
elseif($represente == "11") {header("Location:http://rbk.net.br/muchen");}
elseif($represente == "12") {header("Location:http://rbk.net.br/junior");}
elseif($represente == "14") {header("Location:http://rbk.net.br/talma");}
elseif($represente == "15") {header("Location:http://rbk.net.br/elite");}
elseif($represente == "16") {header("Location:http://rbk.net.br/danilo");}
elseif($represente == "17") {header("Location:http://rbk.net.br/reynaldo");}
elseif($represente == "18") {header("Location:http://rbk.net.br/toni");}
elseif($represente == "19") {header("Location:http://rbk.net.br/aranda");}
elseif($represente == "20") {header("Location:http://rbk.net.br/caldas");}
elseif($represente == "21") {header("Location:http://rbk.net.br/andre");}
elseif($represente == "22") {header("Location:http://rbk.net.br/fabio");}
elseif($represente == "23") {header("Location:http://rbk.net.br/gfn");}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<meta charset="utf-8">
<title>adisul.net</title>
<style type="text/css">
@import url("style.css");
</style>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31749754-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<div id="campo_01"></div>
<div id="campo"></div>
<div id="conta">
<div id="logo"></div>
<div id="campo_1">
<span class="img_portal"></span>
<h5>Paraná</h5>	   
	<ul>
    	<li><a href="index.php?representante=05">Durrer</a></li>
        <li><a href="index.php?representante=07">Jefferson</a></li>
     </ul>
<h5>Rio Grande do Sul</h5>
	<ul>
		<li><a href="index.php?representante=04">Emmanuel</a></li>
    </ul>
<h5>São Paulo</h5>
	<ul>
    	<li><a href="index.php?representante=10">Eduardo</a></li>
		<li><a href="index.php?representante=08">Moacir</a></li>
		<li><a href="index.php?representante=12">Junior Duarte</a></li>
		<li><a href="index.php?representante=14">Talma</a></li>
	</ul>
<h5>Bahia e Sergipe</h5>
    <ul>
        <li><a href="index.php?representante=16">Danilo</a></li>
	</ul>
<h5>Espírito Santo</h5>
    <ul>
        <li><a href="index.php?representante=19">Aranda</a></li>
    </ul>
<h5>Santa Catarina</h5>
    <ul>
        <li><a href="index.php?representante=1">Daniel </a></li>
    </ul>
<h5>DF,GO,TO</h5>
    <ul>
        <li><a href="index.php?representante=17">Reynaldo </a></li>
    </ul>

<h5>Rio de Janeiro</h5>
    <ul>
        <li><a href="index.php?representante=11">Munchen</a></li>
    </ul>
    <ul>
        <li><a href="index.php?representante=21">Andre Calçado </a></li>
    </ul>

<h5>Minas Gerais</h5>
    <ul>
        <li><a href="index.php?representante=18">Toninho </a></li>
	</ul>
<h5>MS,MT,RO,AC</h5>
    <ul>
        <li><a href="index.php?representante=15">Elite Representações </a></li>
	</ul>
    
  
</div>
<a href="http://adisul.net" title="Voltar" class="back">Voltar</a>  

</div>
<div id="campo_00"></div>


</body>
</html>