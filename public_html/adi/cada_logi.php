<?php 
session_start();
include "conexao.php";

$var = $_GET["valida"];
$msg = $_GET["msg"];


if($var == "ok") {


	$codadidas =       $_POST["codadidas"];
	$cnpj =            $_POST["cnpj"];
	$senha =           $_POST["senha"];
	$grupodosite =     $_POST["grupodosite"];
	$comprador =       $_POST["comprador"];
	$celular1 =        $_POST["celular1"];
	$celular2 =        $_POST["celular2"];
	$telefone =        $_POST["telefone"];
	$email =           $_POST["email"];
	$status =          $_POST["status"];
	$data =            $_POST["data"];
	$loja =            $_POST["loja"];
	$segmento_1 =      $_POST["segmento_1"];
	$segmento_2 =      $_POST["segmento_2"];
	$cod_grupo  =      $_POST["cod_grupo"];
	$cod_referencia =  $_POST["cod_referencia"];
	$cidade         =  $_POST["cod_cidades"];
	$uf             =  $_POST["cod_estado"];
	$min_c          =  $_POST["min_c"];
	$min_t          =  $_POST["min_t"];
	$min_e          =  $_POST["min_e"];
	
	$resultado_npedido = mysqli_query($con ,"SELECT `B` FROM `login` WHERE `B` = '$codadidas';");
        $reg = mysqli_fetch_row($resultado_npedido);
	
	if($reg == 0){
    
	
	
	#---tratamento-----------------------
	if($grupodosite == "") {$grupodosite = "SEM GRUPO";}
	
	$grupodosite = strtoupper($grupodosite);
	$loja = strtoupper($loja);
	
	$data = date('Y-m-d', strtotime(str_replace("/", "-", $data )));
	
	if($codadidas == "") {header("Location:cada_logi.php?msg=5");} elseif($codadidas == " ") {header("Location:cada_logi.php?msg=5");} 
	
	
	$query = mysqli_query($con,"INSERT INTO login (`A` ,`B` ,`C` ,`D` ,`nome` ,`comprador` ,`celular1` ,`celular2`,`telefone`,`email`,`status`,`datanasc`, `segmento_1`, `segmento_2`, `loja`, `represe`, `cod_grupo`, `cod_referencia`, `cidade`, `min_c`, `min_t`, `min_e`) VALUES (NULL ,'$codadidas', '$cnpj', '$senha', '$grupodosite', '$comprador', '$celular1', '$celular2', '$telefone', '$email', '$status', '$data', '$segmento_1', '$segmento_2', '$loja', '$represe', '$cod_grupo', '$cod_referencia', '$cidade', '$min_c', '$min_t', '$min_e')") or die(mysql_error());
	
	 $resultado_npedido = mysqli_query($con,"INSERT INTO `tb_cle`  (`id`, `cliente`, `typt`) VALUES (NULL, '$codadidas', '1')");
	 $resultado_npedid  = mysqli_query($con,"INSERT INTO `tb_cle12`(`id`, `cliente`, `typt`) VALUES (NULL, '$codadidas', '1')");
	 $resultado_npedi   = mysqli_query($con,"INSERT INTO `tb_ss14` (`id`, `cliente`, `typt`) VALUES (NULL, '$codadidas', '1')");
	
	
#	header("Location:cada_logi.php?msg=1");
	
$mensagem = "Cadastrar Cliente com Sucesso $codadidas | $loja";
salvaLog($con,$mensagem);
}
	
	else {header("Location:cada_logi.php?msg=2");}
	

$mensagem = "Cadastrar Cliente Falhou para Código Adidas $codadidas";
salvaLog($con,$mensagem);


	
	}






?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADISUL- Controle Administrativo</title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <script type="text/javascript">
	function blockNumbers(e)
{
var key;
var keychar;
var reg;

if(window.event) {
  // for IE, e.keyCode or window.event.keyCode can be used
  key = e.keyCode; 
}
else if(e.which) {
  // netscape
  key = e.which; 
}
else {
  // no event, so pass through
  return true;
}

keychar = String.fromCharCode(key);
reg = /\d/;
// return !reg.test(keychar); ===> para tirar números é necessário tirar o exclamação (!)
        return reg.test(keychar);
}
	
	
	
function Mascara(objeto){ 
   if(objeto.value.length == 0)
     objeto.value = '(' + objeto.value;

   if(objeto.value.length == 3)
      objeto.value = objeto.value + ')';

 if(objeto.value.length == 8)
     objeto.value = objeto.value + '-';
}

function validaData(str) { 

	dia = (str.value.substring(0,2)); 
    mes = (str.value.substring(3,5)); 
	ano = (str.value.substring(6,10)); 

	cons = true; 
	
	// verifica se foram digitados números
	if (isNaN(dia) || isNaN(mes) || isNaN(ano)){
		alert("Preencha a data somente com números."); 
		str.value = "";
		str.focus(); 
		return false;
	}
		
    // verifica o dia valido para cada mes 
    if ((dia < 01)||(dia < 01 || dia > 30) && 
		(mes == 04 || mes == 06 || 
		 mes == 09 || mes == 11 ) || 
		 dia > 31) { 
    	cons = false; 
	} 

	// verifica se o mes e valido 
	if (mes < 01 || mes > 12 ) { 
		cons = false; 
	} 

	// verifica se e ano bissexto 
	if (mes == 2 && ( dia < 01 || dia > 29 || 
	   ( dia > 28 && 
	   (parseInt(ano / 4) != ano / 4)))) { 
		cons = false; 
	} 
    
	if (cons == false) { 
		alert("A data inserida não é válida: " + str.value); 
		str.value = "";
		str.focus(); 
		return false;
	} 
}

// colocar no evento onKeyUp passando o objeto como parametro
function formata(val)
{
   	var pass = val.value;
	var expr = /[0123456789]/;
		
	for(i=0; i<pass.length; i++){
		// charAt -> retorna o caractere posicionado no índice especificado
		var lchar = val.value.charAt(i);
		var nchar = val.value.charAt(i+1);
	
		if(i==0){
		   // search -> retorna um valor inteiro, indicando a posição do inicio da primeira
		   // ocorrência de expReg dentro de instStr. Se nenhuma ocorrencia for encontrada o método retornara -1
		   // instStr.search(expReg);
		   if ((lchar.search(expr) != 0) || (lchar>3)){
			  val.value = "";
		   }
		   
		}else if(i==1){
			   
			   if(lchar.search(expr) != 0){
				  // substring(indice1,indice2)
				  // indice1, indice2 -> será usado para delimitar a string
				  var tst1 = val.value.substring(0,(i));
				  val.value = tst1;				
 				  continue;			
			   }
			   
			   if ((nchar != '/') && (nchar != '')){
				 	var tst1 = val.value.substring(0, (i)+1);
				
					if(nchar.search(expr) != 0) 
						var tst2 = val.value.substring(i+2, pass.length);
					else
						var tst2 = val.value.substring(i+1, pass.length);
	
					val.value = tst1 + '/' + tst2;
			   }

		 }else if(i==4){
			
				if(lchar.search(expr) != 0){
					var tst1 = val.value.substring(0, (i));
					val.value = tst1;
					continue;			
				}
		
				if	((nchar != '/') && (nchar != '')){
					var tst1 = val.value.substring(0, (i)+1);

					if(nchar.search(expr) != 0) 
						var tst2 = val.value.substring(i+2, pass.length);
					else
						var tst2 = val.value.substring(i+1, pass.length);
	
					val.value = tst1 + '/' + tst2;
				}
   		  }
		
		  if(i>=6){
			  if(lchar.search(expr) != 0) {
					var tst1 = val.value.substring(0, (i));
					val.value = tst1;			
			  }
		  }
	 }
	
     if(pass.length>10)
		val.value = val.value.substring(0, 10);
	 	return true;
}
	</script>
	
<script language="javascript">
<!--
function contacaracter(caracter)
{
var max=250;
document.forms[0].contador.value=max-caracter.value.length;
if (caracter.value.length>250)
        document.forms[0].conta.value=document.forms[0].conta.value.substr(0,250);
}

</script>
<script type="text/javascript" src="http://cidades-estados-js.googlecode.com/files/cidades-estados-v0.2.js"></script>
<script type="text/javascript">
    window.onload = function() {
        new dgCidadesEstados(
            document.getElementById('estado'),
            document.getElementById('cidade'),
            true
        );
    }
</script>
<script src="jquery.maskedinput.js"></script>
<script>
jQuery(function($){
       $("#datepicker").mask("99/99/9999");
       $("#campoTelefone").mask("(99) 9999-9999");
	   $("#campoTelefone1").mask("(99) 9999-9999");
	   $("#campoTelefone2").mask("(99) 9999-9999");
       $("#campoSenha").mask("***-****");
	   $("#CEP").mask("99999-999");
});
</script>

<style type="text/css" media="all">
@import url("menu.css");
input {
	width:220px;}
				.carregando{
				color:#666;
				display:none;
			}
	
</style>
</head>
<body>
<div id="faixa"></div>

<?php if($msg == "1") { echo "<script>alert('Cadastrado com Sucesso');</script>";}
	elseif($msg == "2") { echo "<script>alert('Já existe um login com esse código da Adidas');</script>"; }?>
    
<div id="container">
<?php echo $menu_adi;?>
<div id="formulario01">
<form action="<?php $_SERVER["PHP_SELF"]; ?>?valida=ok" method="post">
<p style="font-size:22pt;">Cadastrar Cliente</p>
<br />
<br />

<font class="item01">Código Adidas<img src="images/warning.ico" /></font><input type="text" name="codadidas" onkeypress="return blockNumbers(event);" required="required" /><br />
<font class="item01">Razão Social<img src="images/warning.ico" /></font><input type="text" name="loja" style="text-transform:uppercase;" required="required" /><br />
<font class="item01">CNPJ "Login"<img src="images/warning.ico" /></font><input type="text" name="cnpj" maxlength="14" style="text-transform:none;" required="required" /><br />
<font class="item01">Senha<img src="images/warning.ico" /></font><input type="text" name="senha" required="required" /><br />
<font class="item01">Grupo no Site<img src="images/warning.ico" /></font><input type="text" name="grupodosite" style="text-transform:uppercase;" required="required"  /><br />
<font class="item01">Comprador "Contato" <img src="images/warning.ico" /></font><input type="text" name="comprador" /><br />
<font class="item01">Código do Grupo<img src="images/warning.ico" /></font><input type="text" name="cod_grupo" /><br />
<font class="item01">Código Referencia do Cliente<img src="images/warning.ico" /></font><input type="text" name="cod_referencia"  onkeyup="javascript:contacaracter(this);" maxlength="5"><br />
<font class="item01">Estado UF<img src="images/warning.ico" /></font><select id="estado" name="cod_estados" required="required"></select><br />
<font class="item01">Cidade<img src="images/warning.ico" /></font>
<select id="cidade" name="cod_cidades" required="required"></select><br />
<font class="item01">Celular 1 <img src="images/warning.ico" /></font><input type="text" name="celular1" id="campoTelefone" maxlength="14"><br />
<font class="item01">Celular 2 <img src="images/warning.ico" /></font><input type="text" name="celular2" id="campoTelefone1" maxlength="14"><br />
<font class="item01">Telefone<img src="images/warning.ico" /></font><input type="text" name="telefone" id="campoTelefone2" maxlength="14"><br />
<font class="item01">E-mail<img src="images/warning.ico" /></font><input type="email" name="email" placeholder="example@example.com" required="required" /><br />
<font class="item01">Tipo de Conta<img src="images/warning.ico" /></font><select name="status">
											<option value="1" selected="selected" >Acesso Completo| 1</option>
 										        <option value="2" >Acesso Individual | 2</option>
  											<option value="3" >Acesso Suspenso| 3</option>
                                            </select><br />
<font class="item01">Data de Nascimento do Comprador <img src="images/warning.ico" /></font><input type="text" class="input" name="data" onKeyUp="formata(this);" maxlength="10" size="12"><br />

<font class="item01">Segmentação Antiga <img src="images/warning.ico" /></font><input type="text" name="segmento_1" /><br />
<font class="item01">Segmentação Atual <img src="images/warning.ico" /></font>

<select name="segmento_2">
	<option value="C01" <?php if($adisul_segmento_2 == "C01"){echo "selected=\"selected\" ";}?> >C01 - Multi-Especialista de Imagem</option>
	<option value="C02" <?php if($adisul_segmento_2 == "C02"){echo "selected=\"selected\" ";}?> >C02 - Multi-Especialista Comercial</option>
	<option value="C03" <?php if($adisul_segmento_2 == "C03"){echo "selected=\"selected\" ";}?> >C03 - Especializada</option>
	<option value="C04" <?php if($adisul_segmento_2 == "C04"){echo "selected=\"selected\" ";}?> >C04 - Generalista de Imagem</option>
	<option value="C05" <?php if($adisul_segmento_2 == "C05"){echo "selected=\"selected\" ";}?> >C05 - Generalista Comercial</option>
	<option value="C06" <?php if($adisul_segmento_2 == "C06"){echo "selected=\"selected\" ";}?> >C06 - Directional de Imagem</option>
	<option value="C07" <?php if($adisul_segmento_2 == "C07"){echo "selected=\"selected\" ";}?> >C07 - Lifestyle de Imagem</option>
	<option value="C09" <?php if($adisul_segmento_2 == "C09"){echo "selected=\"selected\" ";}?> >C09 - Fashion</option>
	<option value="C08" <?php if($adisul_segmento_2 == "C08"){echo "selected=\"selected\" ";}?> >C08 - Lifestyle Comercial</option>
	<option value="C10" <?php if($adisul_segmento_2 == "C10"){echo "selected=\"selected\" ";}?> >C10 - Loja Conceito</option>
	<option value="C10" <?php if($adisul_segmento_2 == "C13"){echo "selected=\"selected\" ";}?> >C13 - CD Sports Directional</option>
</select>
<br /><br />


	<font class="item01">Quantidade Miníma por grade de calçado<img src="images/warning.ico" /></font><select name="min_c">
    																	<option value="1">Nenhuma</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="6">8</option>
                                                                        <option value="6">10</option>
                                                                        <option value="6">12</option>
                                                                      </select><br />
	<font class="item01">Quantidade Miníma por grade de têxtil<img src="images/warning.ico" /></font><select name="min_t">
    																	<option value="1">Nenhuma</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="6">8</option>
                                                                        <option value="6">10</option>
                                                                        <option value="6">12</option>
                                                                      </select><br />
	<font class="item01">Quantidade Miníma por grade de equipamento<img src="images/warning.ico" /></font><select name="min_e">
    																	<option value="1">Nenhuma</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="6">8</option>
                                                                        <option value="6">10</option>
                                                                        <option value="6">12</option>
                                                                      </select><br /><br />






<input type="submit" value="Cadastrar" onClick="return validaData(campos.data);" style="padding:5px;">

</form>
<script src="http://www.google.com/jsapi"></script>
		<script type="text/javascript">
		  google.load('jquery', '1.3');
		</script>		

		<script type="text/javascript">
		$(function(){
			$('#estado').change(function(){
				if( $(this).val() ) {
					$('#cod_cidades').hide();
					$('.carregando').show();
					$.getJSON('cidades.ajax.php?search=',{cod_estados: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value=""></option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
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
</div>
</div>
</body>
</html>