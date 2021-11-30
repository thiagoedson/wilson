<?php
session_start();
include "conexao.php";
$senha  = $_SESSION["codigo"];
$senha1 = $_POST["senha1"];
$senha2 = $_POST["senha2"];
if ($senha1 == $senha2) {
$sql = mysql_select_db("login", $con);
$ssql = mysql_query("UPDATE  login SET `D` = '$senha2'  WHERE B = '$senha'; ") or die(mysql_error());


#-------------------------------------------------------------------------------------------------------


$query = mysql_query("SELECT * FROM login WHERE `B` = '$senha'");
while($array = mysql_fetch_array($query)){	  
	  $e_comprador    = $array["comprador"];
	  $e_senha        = $array["D"];
	  $e_email        = $array["email"];
	  
};

$assunto = "ADISUL - Alteração da senha";



$html = "
<html>
<body>
<img src=http://www.adisul.com/images/header.png /> <BR/>

Sr(a) $e_comprador - $senha  <br/>
Sua senha foi alterada com sucesso,<br/>
sua nova senha é <b>$e_senha</b>
<br/>
<br/>
<br/>


<br/>
<img src=http://www.adisul.com/images/email.jpg /> <BR/>
</body>
</html>";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: adisul@adisul.com' . "\r\n" .
    'Reply-To: adisul@adisul.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($e_email, $assunto, $html, $headers);


echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=info2.php'>";
}
else  {echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=info2.php?erro=1'>";}
?>