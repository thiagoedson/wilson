<?php
session_start();

?>
﻿
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script src="http://j.maxmind.com/app/geoip.js" charset="ISO-8859-1" type="text/javascript" ></script>
<script type="text/javascript">
$(document).ready(function() {
  var $sigla	= geoip_country_code();
  var $pais	= geoip_country_name();
  var $cod_uf	= geoip_region();
  var $cidade	= geoip_city();
  var $estado 	= geoip_region_name();
 
  $("#sigla").append($sigla);
  $("#pais").append($pais);
  $("#estado").append($estado);
  $("#cod_estado").append($cod_uf);
  $("#cidade").append($cidade);
});
</script>
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
	background:#FFF;
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

include"conexao.php";

//Recebendo os dados do formulário
$login = addslashes($_POST["login"]);
$senha = addslashes($_POST["senha"]);
 
$sql = mysqli_query($con, "SELECT * FROM `$banco`.`login` WHERE `C` = '$login' AND `D` = '$senha'");

 
if(mysqli_num_rows($sql) == 1) {
	$user = mysqli_fetch_array($sql);
	//conferindo o login e senha para segurança
	if($login == $user['C']){
		//se entrou, entao o login é igual
		if($senha == $user['D']){
			//se entrou, então a senha também é igual
			
			
			// se usuario for igual a 3 em status é porque ele foi banido por algum motivo e negado o acesso ao site
			if($user['status'] == "3"){echo "<meta http-equiv=\"refresh\" content=\"0; url=fail_2.html\">"; break;}
			
			//criando a sessão
			@session_start();
			$_SESSION["valida"]       = "1";
			$_SESSION["status_login"] = $user['status'];
			$_SESSION["codigo"]       = $user['B'];
			$_SESSION["represe"]      = $user['represe'];			
			$comprador                = $user['comprador'];
		       require_once("/home/rbkne024/php/Net/GeoIP.php");
    $geoip = Net_GeoIP::getInstance('/home/rbkne024/php/Net/GeoIP/GeoLiteCity.dat');
    try {
        $location = $geoip->lookupLocation($_SERVER['REMOTE_ADDR']);
    } catch (Exception $e) {
        die("Erro: Falha ao localizar a pessoa pelo IP.");
    }
    //exibindo valores na tela (quando estivermos utilizando o Google Maps, não vamos usar
    //estas duas linhas a seguir.
    $exho1 = $location->latitude;
    $exho2 = $location->longitude;
    $exho3 = $location->city;
    $exho33= $location->city;
    $exho4 = $location->countryName;
    $exho5 = $location->isp;
    $exho6 = $location->countryCode3;
    $exho7 = $location->countryCode;
    
    $exho3 = utf8_encode($exho3);
    $exho4 = utf8_encode($exho4);
    $data_time = date('Y-m-d H:i:s');
   
    $custom = $exho3;
    
    $codigo_cliente = $_SESSION["codigo"];
    
    $query_state = mysqli_query($con_reebok, "SELECT * FROM `rbkne024_reebok`.`tb_cidades` WHERE `nome` = '$exho33'");
    while($array2 = mysqli_fetch_array($query_state)){
		$state = $array2["uf"];}


$query = mysqli_query($con, "INSERT INTO location_user (
	`id` ,`codigo` ,`latitude` ,`longitude` ,`data` ,`custon`, `city`, `region`, `state`, `postalcode`, `code3`) VALUES (NULL , '$codigo_cliente', '$exho1', '$exho2', '$data_time', '$custom', '$exho33', '$exho4', '$state ', '$exho6', '$exho7')");
		echo "
<div id=\"contagem1\">
Bem vindo, $comprador <br />
Você será redirecionado dentro de <div id=\"contagem\"></div>
<script language=\"JavaScript\" type=\"text/javascript\">
<!--
var targetURL=\"principal.php\"
var countdownfrom=9
var currentsecond=document.getElementById(\"contagem\").innerHTML=countdownfrom+1
function countredirect(){
if (currentsecond!=9){
currentsecond -= 1
document.getElementById(\"contagem\").innerHTML=currentsecond + \" segundos\"
}else{
window.location=targetURL
return
}
setTimeout(\"countredirect()\",0)
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