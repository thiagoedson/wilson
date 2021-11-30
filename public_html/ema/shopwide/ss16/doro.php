<?php
$host = "localhost";      //computador onde o servidor de banco de dados esta instalado
$user = "adisul_adidas";  //seu usuario para acessar o banco
$pass = "mhvt26mnk";      //senha do usuario para acessar o banco
$banco = "adisul_adidas"; //banco que deseja acessar
$con = mysql_connect($host, $user, $pass) or die (mysql_error());
mysql_select_db($banco);

#-------------------------------------------------------
$senha = $_SESSION["codigo"];
$ver_ifica = $_SESSION["valida"];
$var_status = $_SESSION["status_login"];

$sul = 0.95;



if ($ver_ifica == "") {echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../../index.php?erro=1'>";}

	  
$site1 = mysqli_query($con, "SELECT * FROM site");
while($array_site = mysqli_fetch_array($site1)){	
	$colecao = $array_site["colecao"];
	$data_atua = $array_site["data_atua"];
	$titulo = $array_site["titulo"];
	$carteira = $array_site["carteira"];
	$faturamento = $array_site["faturamento"];
	$situa_site = $array_site["situa"];
	$cancelamento = $array_site["cancelamento"];
	$textil = $array_site["textil"];
	$calcados = $array_site["calcados"];
	$equi = $array_site["equi"];
	$cle = $array_site["cle"];
	$loja_status = $array_site["loja"];
		
$cle = date('d/m/Y', strtotime(str_replace("-", "/", $cle )));
$equi = date('d/m/Y', strtotime(str_replace("-", "/", $equi )));
$calcados = date('d/m/Y', strtotime(str_replace("-", "/", $calcados )));
$textil = date('d/m/Y', strtotime(str_replace("-", "/", $textil )));

$data_atua = date('d/m/Y', strtotime(str_replace("-", "/", $data_atua )));
$carteira = date('d/m/Y', strtotime(str_replace("-", "/", $carteira )));
$faturamento = date('d/m/Y', strtotime(str_replace("-", "/", $faturamento )));
$situa_site = date('d/m/Y', strtotime(str_replace("-", "/", $situa_site )));
$cancelamento = date('d/m/Y', strtotime(str_replace("-", "/", $cancelamento )));
}

if($loja_status == "2") {
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php?erro=1'>";}
	
$rodape_fixo = "
<!-- LiveZilla Chat Button Link Code (ALWAYS PLACE IN BODY ELEMENT) --><div style=\"text-align:center;width:200px;\"><a href=\"javascript:void(window.open('http://chat.adisul.net/chat.php','','width=590,height=610,left=0,top=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes'))\"><img src=\"http://chat.adisul.net/image.php?id=04&amp;type=inlay\" width=\"200\" height=\"50\" border=\"0\" alt=\"LiveZilla Live Help\"></a><div style=\"margin-top:2px;\"></div></div><!-- http://www.LiveZilla.net Chat Button Link Code --><!-- LiveZilla Tracking Code (ALWAYS PLACE IN BODY ELEMENT) --><div id=\"livezilla_tracking\" style=\"display:none\"></div><script type=\"text/javascript\">
var script = document.createElement(\"script\");script.type=\"text/javascript\";var src = \"http://chat.adisul.net/server.php?request=track&output=jcrpt&nse=\"+Math.random();setTimeout(\"script.src=src;document.getElementById('livezilla_tracking').appendChild(script)\",1);</script><noscript><img src=\"http://chat.adisul.net/server.php?request=track&amp;output=nojcrpt\" width=\"0\" height=\"0\" style=\"visibility:hidden;\" alt=\"\"></noscript><!-- http://www.LiveZilla.net Tracking Code -->
</div>
" ;

?>