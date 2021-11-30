<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>adisul.net</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="slider/coin-slider.min.js"></script>
<script type="text/javascript">
function checar_caps_lock(ev) {
	var e = ev || window.event;
	codigo_tecla = e.keyCode?e.keyCode:e.which;
	tecla_shift = e.shiftKey?e.shiftKey:((codigo_tecla == 16)?true:false);
	if(((codigo_tecla >= 65 && codigo_tecla <= 90) && !tecla_shift) || ((codigo_tecla >= 97 && codigo_tecla <= 122) && tecla_shift)) {
		document.getElementById('aviso_caps_lock').style.visibility = 'visible';
	}
	else {
		document.getElementById('aviso_caps_lock').style.visibility = 'hidden';
	}
}
</script>
<link rel="stylesheet" href="slider/coin-slider-styles.css" type="text/css" />
<style type="text/css">
@import url("style_e.css");

#aviso_caps_lock {
	display: block;
	position: absolute;
	padding: 10px;
	border-radius: 8px;
	background-color: #FF6;
	width: 148px;
	height: 13px;
	left: -155px;
	top: 143px;
}
</style>

</head>
<body onload=setInterval("window.clipboardData.clearData()",20)>
<div id="conta">
 
 <div id="cs_01">
 
 <div id='coin-slider'>
	<a href="#" >
		<img src='../public/reload_1.jpg' >
		
	</a>
	
	<a href="#">
		<img src='../public/reload_2.jpg' >
		
	</a>
        <a href="#">
		<img src='../public/reload_3.jpg' >
		
	</a>
	<a href="#">
		<img src='../public/reload_4.jpg' >
		
	</a>

    
</div>


</div>
 <div id="titulo"><img src="img/logo_branco.png" /></div>

<div id="login">
 
 <p class="titulo">Login</p>
 <form action="md5.php" method="post">
 <label class="label">Usuário  </label><input type="text"     name="login" style="width:250px;" required="required" />
 <label class="label">Senha    </label><input type="password" name="senha" style="width:250px;"   onkeypress="checar_caps_lock(event)" required="required" /><br />
 <input type="submit" class="login" value="Login" />	
 </form>
 <div id="aviso_caps_lock" style="visibility: hidden">CAPS LOCK ATIVADO</div>
 </div>
  <div id="logo"></div>
 
<div id="sena"></div>
    <div id="back">
	<a href="../" title="Voltar para página anterior">Voltar para página anterior</a>
    </div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		$('#coin-slider').coinslider({ 
width: 470, 
navigation: true, 
delay: 5000 ,
height: 300,
spw: 7, // squares per width
sph: 5, // squares per height
delay: 3000, // delay between images in ms
sDelay: 30, // delay beetwen squares in ms
opacity: 0.7, // opacity of title and navigation
titleSpeed: 500, // speed of title appereance in ms
effect: '', // random, swirl, rain, straight
navigation: false, // prev next and buttons
links : true, // show images as links
hoverPause: true // pause on hover // height of slider panel

		});
	});
</script>
</body>
</html>