<?php
session_start();
include "dire.php";
$senha = $_SESSION["codigo"];

$query = mysqli_query($con, "SELECT * FROM `$banco_representante`.`login` WHERE `B` = '$senha'");
while($array = mysqli_fetch_array($query)){
      $p_codigo       = $array["B"];	  
	  $p_login        = $array["C"];
	  $p_senha        = $array["D"];
	  $p_comprador    = $array["comprador"];
	  $p_telefone     = $array["telefone"];
	  $p_celular1     = $array["celular1"];
	  $p_celular2     = $array["celular2"];
	  $p_email        = $array["email"];	 
	  $p_cidade       = $array["cidade"];
	  $p_estado       = $array["UF"];
	  $p_referencia   = $array["cod_referencia"];
	  $p_data_nasc    = $array["datanasc"];
	  $p_loja         = $array["loja"];
	  $p_refere       = $array["cod_referencia"];
      $p_represe      = $array["represe"];	
	  
	  };

$msg = $_GET["msg"];

#------------------Atualizando dados --------------------------------------

$atualiza = $_POST["atualiza"];

if($atualiza == "Atualizar") {
	
$o_comprador   = $_POST["comprador"];
$o_telefone    = $_POST["telefone"];	
$o_celular1    = $_POST["celular1"];
$o_celular2    = $_POST["celular2"];
$o_email       = $_POST["email"];
$o_datanasc    = $_POST["datanasc"];	
$o_cidade      = $_POST["cod_cidades"];
$o_estado      = $_POST["cod_estados"];
$o_refere      = $_POST["refere"];	
	


$o_email = strtolower($o_email);

$o_comprador = strtoupper($o_comprador);
$o_cidade = strtoupper($o_cidade);
$o_refere = strtoupper($o_refere);


if($o_datanasc == "") { } else {
$o_datanasc = date('Y-m-d', strtotime(str_replace("/", "-", $o_datanasc )));}
if($o_cidade == "") {$o_cidade = $p_cidade;}
if($o_estado == "") {$o_estado = $p_estado;}

else {

$query_states = mysqli_query($con, "SELECT `UF` FROM `adisu724_adidas`.`tb_estados` WHERE `id` = '$o_estado'");
 while($array_uf = mysqli_fetch_array($query_states))
   {
	$o_estado      = $array_uf["UF"];
   }
}

$ssql = mysqli_query($con, "UPDATE  `$banco`.`login` SET
`comprador` = '$o_comprador',
`telefone` = '$o_telefone', 
`celular1` = '$o_celular1', 
`celular2` = '$o_celular2', 
`email` = '$o_email',
`datanasc` = '$o_datanasc',
`cidade` = '$o_cidade',
`UF` = '$o_estado',
`cod_referencia` = '$o_refere' WHERE `B` = '$senha'") or die(mysql_error());
	
header("location:info2.php?msg=31");		
}

$formsenha = $_POST["formsenha"];

if($formsenha == "Alterar a senha") {
	
$new_pass = $_POST["senha"];

if($new_pass == "") {header("location:info2.php?msg=44");	}
else {

$ssql = mysqli_query($con, "UPDATE  `$banco`.`login` SET `D` = '$new_pass' WHERE `B` = '$senha'")or die(mysql_error());
}

header("location:info2.php?msg=32");	
	
}





#------------------------------- Tratamento para exibir as variaveis---------------------------------------------------------------
if($p_email <> ""){	$attention = "bloco_16"; } else {$attention = "attention";}	
if($p_data_nasc == "0000-00-00") {$p_data_nasc = ""; $sinal = "bloco_15";} elseif($p_data_nasc == "") {$p_data_nasc = ""; $sinal = "bloco_15";} else {$p_data_nasc  = date('d/m/Y', strtotime(str_replace("-", "/", $p_data_nasc ))); $sinal = "bloco_18";}
if($p_comprador <> "") {$sinal_1 = "bloco_18";} else {$sinal_1 = "bloco_15";}
if($p_telefone <> "") {$sinal_2 = "bloco_18";} else {$sinal_2 = "bloco_15";}
if($p_celular1 <> "") {$sinal_3 = "bloco_18";} else {$sinal_3 = "bloco_15";}
if($p_celular2 <> "") {$sinal_4 = "bloco_18";} else {$sinal_4 = "bloco_15";}
if($p_cidade <> "") {$sinal_5 = "bloco_18";} else {$sinal_5 = "bloco_15";}
if($p_represe <> "") {$sinal_6 = "bloco_18";} else {$sinal_6 = "bloco_15";}
#----------------------------------------------------------------------------------------------------------------------------------



#-------- Tratamento das mensagens -----------------------


if($msg == "32") {$msg = "<b class=\"msg_alert\">Senha alterada com sucesso.</b>";}
elseif($msg == "31") {$msg = "<b class=\"msg_alert\">Seus dados foram atualizados com sucesso.</b>";}

else {$msg = "<b class=\"msg_alert\">Por favor verifique abaixo se todos os dados estão corretos e preenchidos.</b>";}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>adisul.net</title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<style type="text/css" media="all">
@import url("estilo.css");
</style>
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="menu.js"></script>
<script type="text/javascript">


function mascaraData(campoData){
              var datanasc = campoData.value;
              if (datanasc.length == 2){
                  datanasc = datanasc + '/';
                  document.forms[0].datanasc.value = datanasc;
      return true;              
              }
              if (datanasc.length == 5){
                  datanasc = datanasc + '/';
                  document.forms[0].datanasc.value = datanasc;
                  return true;
              }
         }
function Mascara(objeto){ 
   if(objeto.value.length == 0)
     objeto.value = '(' + objeto.value;

   if(objeto.value.length == 3)
      objeto.value = objeto.value + ')';

 if(objeto.value.length == 9)
     objeto.value = objeto.value + '-';
}

$(document).ready( function () {
$("#fade_out").ready ( function () {
$(".pass").fadeOut(0);
})
$("#fade_in").click ( function () {
$(".pass").fadeIn(2000);
})
});
fadeOut
</script>
</head>
<body>
<?php 
include"../adisul_prt1.php";

	   echo $menu_principal; 
?>
<div id="bloco_10">



<div id="pass">
<input type='hidden' id='fade_out' value='Sumir'  /><br />

<input type='button' id='fade_in' value='Trocar de senha' style="padding:5px;" />
<br /><br />
<div class='pass'>
<form action="<?php echo $PHP_SELF; ?>" method="post">
Digite a nova senha:<br /><br />

 <input type="password" name="senha" style="text-align:center;" />
 <br />
<br />

<input type="submit" value="Alterar a senha" name="formsenha" class="trocar_senha"/>
</form>
</div>

</div>




<form action="<?php echo $PHP_SELF; ?>" method="post">


<?php echo $msg;?>
<br />
<br />


<p class="subtitulo">Meus dados</p>
<br />
<br />

<table class="tables_1">
  <tr>
    <td class="primeira">Razão Social</td><td class="segunda"><?php echo $p_loja ;?></td>
  </tr>
  <tr>
    <td class="primeira">Código </td><td class="segunda"><input type="text"  value="<?php echo $p_codigo;?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td class="primeira">Usuário/login </td><td class="segunda"><input type="text"  value="<?php echo $p_login;?>" readonly="readonly" /></td>
  </tr>

</table>

<br />


<p class="subtitulo">Os campos em vermelhos devem ser preenchidos corretamente.</p>

<br />
<table class="tables_1">
  <tr>
     <td class="primeira">Nome : </td><td class="segunda"><input type="text"  value="<?php echo $p_comprador;?>" name="comprador" /></td>
  </tr>
  <tr>
     <td class="primeira">Data de Nascimento :</td><td class="segunda"><input type="date" class="<?php echo $sinal;?>" value="<?php echo $p_data_nasc;?>" name="datanasc" OnKeyUp="mascaraData(this);" maxlength="10" / > </td>
   </tr>
  <tr>
     <td class="primeira">Telefone :</td><td class="segunda"><input type="tel" class="<?php echo $sinal_2;?>" value="<?php echo $p_telefone;?>" name="telefone" onkeypress="Mascara(this);"></td>
   </tr>
  <tr>
     <td class="primeira">Celular :</td><td class="segunda"><input type="tel" class="<?php echo $sinal_3;?>" value="<?php echo $p_celular1;?>" name="celular1"  onkeypress="Mascara(this);"></td>
  </tr>
  <tr>
     <td class="primeira">Celular :</td><td class="segunda"><input type="tel"  class="<?php echo $sinal_4;?>" value="<?php echo $p_celular2;?>" name="celular2" onkeypress="Mascara(this);"></td>
   </tr>
  <tr>
     <td class="primeira">E-mail :</td><td class="segunda"><input type="email" placeholder="example@example.com"  class="<?php echo $attention;?>" value="<?php echo $p_email;?>"  size="60" name="email" required="required"/></td>
   </tr>
   <tr>
   <td colspan="2">
   *** Para adicionar mais de um e-mail , separe eles com ponto e virgula como no exemplo<br />
 ( email@email <b>;</b> email@email.com ).</i></td>
 </tr>
 </table>
<br />


<p class="subtitulo">Dados da Loja</p>
<br />

<table class="tables_1">
  <tr>
    <td class="primeira">Razão Social/Código</td><td class="segunda"><?php echo $p_loja."/".$p_login ;?></td>
  </tr>
  <tr>
     <td class="primeira">Estado atual <b><?php echo $p_estado;?> </b></td><td>
<select name="cod_estados" id="cod_estados">
<option value="">-</option>
<?php
$query_uf = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`tb_estados`");
 while($uf_query = mysqli_fetch_array($query_uf))
   {
	$uf_id      = $uf_query["id"];
	$uf_uf      = $uf_query["uf"];
	$uf_name    = $uf_query["nome"];
	
	$uf_name = utf8_decode($uf_name);
	if($adisul_estado == $uf_uf) {$che = "selected=\"selected\"";}
	else {$che = "";}
	
	echo "<option value=\"$uf_id\" $che >$uf_uf</option>";
   }

?>
</select>
</td>
  <tr>
    <td>Cidade  atual <br /><b><?php echo $p_cidade;?> </b><td>
    	<span class="carregando">Aguarde, carregando...</span>
		<select name="cod_cidades" id="cod_cidades">
			<option value="">-- Escolha um estado --</option>
		</select>
       
<script src="http://www.google.com/jsapi"></script>
		<script type="text/javascript">
		  google.load('jquery', '1.3');
		</script>		

		<script type="text/javascript">
		$(function(){
			$('#cod_estados').change(function(){
				if( $(this).val() ) {
					$('#cod_cidades').hide();
					$('.carregando').show();
					$.getJSON('cidades.ajax.php?search=',{cod_estados: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value=""></option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].nome + '">' + j[i].nome + '</option>';
						}	
						$('#cod_cidades').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('#cod_cidades').html('<option value="">– Escolha um estado –</option>');
				}
			});
		});
		</script>
</td>
</tr>   
  <tr>
    <td class="primeira">Identificação da loja no site :</td><td class="segunda"><input type="text" class="<?php echo $sinal_6;?>" value="<?php echo $p_refere;?>" size="5" name="refere" /></td>
  </tr>
  <tr>
    <td colspan="2"><i style="font-size:8pt;">*Esse informação é fornecida pelo logista para identificar a sua loja na hora de fazer pedido.</i></td>
  </tr>
</table>
<br />
<br />

<input type="submit" value="Atualizar" class="bloco_17" name="atualiza" />

</form>
</div>

</div>
</body>
</html>