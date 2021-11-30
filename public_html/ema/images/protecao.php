<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Carregando..</title>
<style type="text/css">

* {
	padding:0;
	margin:0;}
#contagem1 {
	height: 100px;
	width: 800px;
	text-align:center;
	border: thin 1 #666;
	position:relative;
	margin:auto;
	top:100px;
	background:#CCC;
	border-radius:20px;
}
.cente {
	position:relative;
	margin:auto;
	top:50px;
	width:128px;}
.center {
	position:relative;
	margin:auto;
	top:120px;
	width:128px;}
	
#conta {
	position:relative;
	margin:auto;
	width:800px;}
</style>
</head>
<body>
<div id="conta">
<?php
#--- pegando os posts da index.php-----------

$conexao = mysql_connect("127.0.0.1","root","");
$seleciona = mysql_query("SELECT * FROM adidas.login");

if($_POST["ok"]){
		if($_POST["login"] and $_POST["senha"]) {
			$login = addslashes(trim($_POST["login"]));# pegando o valor do formulario
			$senha = addslashes(trim($_POST["senha"]));# pegando o valor do formulario
			
			$seleciona = mysql_query("SELECT D FROM adidas.login WHERE C = '$login';"); #pegando a senha do login do formulario
			$nome_1 = @mysql_query("SELECT B FROM adidas.login WHERE C =  '$login';");# seleciona o nome do usuario no bando de dados
			while($array3 = @mysql_fetch_array($nome_1)){	
	        $nome_1 = $array3["B"];}
            $nome = @mysql_result($nome_1, 0, "B"); # e aqui ele trata ele pegando o conteudo
			
			
			
				if(mysql_num_rows($seleciona)){$senha_sql = mysql_result($seleciona, 0, "D"); 
				if($senha_sql==$senha) {
				
				session_start();
					$_SESSION['valida'] = true;
					$_SESSION['codigo'] = $nome_1;
					echo "
<div id=\"contagem1\">
Você será redirecionado dentro de <div id=\"contagem\"></div>
<script language=\"JavaScript\" type=\"text/javascript\">
<!--
var targetURL=\"principal.php\"
var countdownfrom=7
var currentsecond=document.getElementById(\"contagem\").innerHTML=countdownfrom+1
function countredirect(){
if (currentsecond!=1){
currentsecond-=1
document.getElementById(\"contagem\").innerHTML=currentsecond + \" segundos\"
}else{
window.location=targetURL
return
}
setTimeout(\"countredirect()\",1000)
}
countredirect()
//-->
</script>
</div>
<center>
<img class=\"cente\" src=\"images/loader.gif\" width=\"128\" height=\"15\" alt=\"Carregando..\" /></center>";
				}
					
					
					
				} else {echo '<div id=contagem1>CNPJ ou senha inválidos <br/> <a href=index.php>Tentar novamente ?</a></div>';}
			} else {echo '<div id=contagem1>CNPJ ou senha inválidos <br/> <a href=index.php>Tentar novamente ?</a></div>';}
		} else {echo '<div id=contagem1>CNPJ ou senha inválidos <br/> <a href=index.php>Tentar novamente ?</a></div>';}
	
	  
  

?>
</div>
</body>
</html>
