<?php 
session_start();
include "dire.php";
$senha = $_SESSION["codigo"];


$query = mysql_query("SELECT * FROM login WHERE `B` = '$senha'");
while($array = mysql_fetch_array($query)){	
	  $nome_cliente   = $array["nome"];
	  $p_login        = $array["C"];
	  $p_senha        = $array["D"];
	  $p_comprador    = $array["comprador"];
	  $p_telefone     = $array["telefone"];
	  $p_celular1     = $array["celular1"];
	  $p_celular2     = $array["celular2"];
	  $p_email        = $array["email"];
	  $p_codigo       = $array["B"];
	  
};

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Atualizando Perfil</title>
<style type="text/css">
body {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 8pt;
}
.list {
	color:#000;
	font-size: 8pt;
	background-color:#CCC;}
.lost {
	color:#666;
	font-size: 8pt;
	background-color:#FFC;}	
.ativo {
	color:#0C0;
	font-size: 8pt;}
.inativo {
	color:#F00;
	font-size: 8pt;}

li {
	text-decoration: none;
	list-style-type: none;
	
}

a{ text-decoration:none;
   color:#00F;
	}
a:hover {
	color:#F00;
	text-decoration:underline;}
.nega {
	
	color:#F00;}
.list11 {
	font-family:Verdana, Geneva, sans-serif;
	font-size:8pt;
	color:#333;}
input {
	font-size:8pt;}
.lowcase {
	text-transform:lowercase;}
</style>
<script language= "JavaScript">
function isEmail2(email){
if (email.value.search(/^\w+((-\w+)|(\.\w+))*\@\w+((\.|-)\w+)*\.\w+$/) == -1) {
   alert("Caracteres inválidos, por verifique se não há espaço.");
   email.focus();
    return false;
}
  return true;
}
</script>
</head>

<body>
<form action="perfi_update_sql.php" method="post" name="tstmail" onsubmit="return isEmail2(document.tstmail.email);">
<table width="100%">
  <tr >
    <td align="center" colspan="4" bordercolor="#000000">Atualizar Cadastro</td>
  </tr>
  
    <td class="list">Login:</td><td  class="lost" colspan="3"><?php echo $p_login;?></td>
  </tr>
  <tr>
    <td class="list">Senha:</td><td  class="lost" colspan="3">*********</td>
  </tr>
  <tr>
    <td class="list">Comprador:</td><td  class="lost"><input type="text" size="35" name="comprador" value="<?php echo $p_comprador;?>" /></td><td class="list">Telefone:</td><td  class="lost"><input type="text" name="telefone" value="<?php echo $p_telefone;?>" /></td>
  </tr>
  <tr>
    <td class="list">Celular 1:</td><td  class="lost" ><input type="text" name="celular1" value="<?php echo $p_celular1;?>" /></td><td class="list">Celular 2:</td><td  class="lost"><input type="text" name="celular2" value="<?php echo $p_celular2;?>" /></td>
  </tr>
  <tr>
    <td class="list">Email principal*:</td><td  class="lost" colspan="3"><input type="text" class="lowcase" name="email" value="<?php echo $p_email;?>" size="75" onkeypress="return pulsada(event) /></td>
  </tr>
  <tr>
    <td class="list11" colspan="4"><input type="submit" value="Atualizar" name="ok" /></td>
  </tr>
</table>
</form>
<hr />


</body>
</html>