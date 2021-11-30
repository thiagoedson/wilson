<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Carregando...</title>
<style type="text/css">

* {
	padding:0;
	margin:0;}
#contagem1 {
	height: 150px;
	width: 800px;
	text-align:center;
	border: thin 1 #666;
	position:relative;
	margin:auto;
	top:100px;
	background:#CCC;
	border-radius:20px;
	font-size:10pt;
	font-family:Verdana, Geneva, sans-serif;
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

$host = "localhost";      //computador onde o servidor de banco de dados esta instalado
$user = "zk10n546_cebola";  //seu usuario para acessar o banco
$pass = "mhvt26mnk";      //senha do usuario para acessar o banco
$banco = "zk10n546_cebola"; //banco que deseja acessar
$con = mysql_connect($host, $user, $pass) or die (mysql_error());
mysql_select_db($banco);

//Recebendo os dados do formulário
$login = addslashes($_POST["login"]);
$senha = addslashes($_POST["senha"]);
 
$sql = mysql_query("SELECT * FROM login WHERE C = '$login' AND D = '$senha'");

 
if(mysql_num_rows($sql) == 1) {
	$user = mysql_fetch_array($sql);
	//conferindo o login e senha para segurança
	if($login == $user['C']){
		//se entrou, entao o login é igual
		if($senha == $user['D']){
			//se entrou, então a senha também é igual
			
			if($user['status'] == "3"){echo "<meta http-equiv=\"refresh\" content=\"0; url=fail_2.html\">"; break;}
			
			//criando a sessão
			@session_start();
			$_SESSION["valida"] = "1";
			$_SESSION["status_login"] = $user['status'];
			$_SESSION["codigo"] = $user['B'];
			$comprador = $user['comprador'];
				
			
			echo "
<div id=\"contagem1\">
Bem vindo, $comprador <br />
Você será redirecionado dentro de <div id=\"contagem\"></div>
<script language=\"JavaScript\" type=\"text/javascript\">
<!--
var targetURL=\"principal.php\"
var countdownfrom=2
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
 
			//depois que criarmos a sessão, 
                        //vamos redirecionar para a página privada
			
		} else {echo '<div id=contagem1>CNPJ ou senha inválidos <br/> <a href=index.php>Tentar novamente ?</a></div>';}
			} else {echo '<div id=contagem1>CNPJ ou senha inválidos <br/> <a href=index.php>Tentar novamente ?</a></div>';}
		} else {echo '<div id=contagem1>CNPJ ou senha inválidos <br/> <a href=index.php>Tentar novamente ?</a></div>';}
?>
	
</div>
</body>
</html>