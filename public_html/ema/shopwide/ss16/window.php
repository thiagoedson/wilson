<?php
session_start();
include"../../conexao.php";
include"sql_pedido/p_pedido.php";
$s_artigo = $_GET["artigo"];
$artigo = $_GET["artigo"];
#-------------------------------------------------------------------------------------------------------------
$artigo = strtoupper($artigo);

$mysqli_query_visto = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`vistos_artigo` WHERE `artigo` = '$artigo'") ;
 
$cont_artigo_v = mysqli_num_rows($mysqli_query_visto);


if($cont_artigo_v == 0) {

$valor_1 = 1;

$insert_artigo_v = mysqli_query($con, "INSERT INTO `rbkne024_reebok`.`vistos_artigo` (`id` ,`artigo` ,`count`) VALUES (NULL ,'$artigo', '$valor_1')") or die(mysql_error());
 }

 else {
	
	 $soma_query = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`vistos_artigo` WHERE `artigo` = '$artigo'") ;
	while($array_soma = mysqli_fetch_array($soma_query)){		
	  $valor_2       = $array_soma["count"];
	  }
	  
	  $total_soma = $valor_2 + 1;
	  
	 $update_soma = mysqli_query($con, "UPDATE `rbkne024_reebok`.`vistos_artigo` SET `count` = '$total_soma'  WHERE  `artigo` = '$artigo'");
 }
 
#-------------------------------------------------------------------------------------------------------------

$query_grade = mysqli_query($con, "SELECT * FROM  `rbkne024_reebok`.`$tabela`  WHERE  Artigo = '$s_artigo' ORDER BY `tamanho`") or die(mysql_error());
while($array_grade = mysqli_fetch_array($query_grade)){
$divisao     = $array_grade["Divisao"];
$tamanho     = $array_grade["Tamanho"];
$categoria   = $array_grade["Categoria"];
$segmento    = $array_grade["Segmentacao"];
$descricao   = $array_grade["Descricao"];
$s_vitrine   = $array_grade["vitrine"];
$s_custo     = $array_grade["custo"];
$s_cle_1     = $array_grade["cle_1"];
$season      = $array_grade["Season"];
$codmae      = $array_grade["mod"];
$usage       = $array_grade["Usage"];
$gender      = $array_grade["Gender"];
$seg         = $array_grade["Usage"];
$mes_11  	 = $array_grade["mes_11"];
$mes_22  	 = $array_grade["mes_22"];
$mes_33      = $array_grade["mes_33"];
$mes_44      = $array_grade["mes_44"];
$mes_55      = $array_grade["mes_55"];
$mes_66      = $array_grade["mes_66"];
$mes_77      = $array_grade["mes_77"];
$mes_88      = $array_grade["mes_88"];
$datadelancamento    = $array_grade["Data de Lancamento"];
$datadeencerramento  = $array_grade["Data de Encerramento"];

$segmento = strtoupper($segmento);
$usage = strtoupper($usage);
$s_custo   = str_replace(",", ".", $s_custo);
$s_custo   = $s_custo * $sul;
$s_custo   =  number_format($s_custo, 2, ',', '.');
$s_vitrine = str_replace(",", ".", $s_vitrine);
$s_vitrine =  number_format($s_vitrine, 2, ',', '.');


}


if($e_represetante == "18") {
#---------------------- Condição para data ------------------------------------------------------------
		 
		   if($mes_11 <> "0") {$new_mes = date("2015-11-20");}
		   if($mes_11 == "0") {$new_mes = date("2015-12-20");}
		   if($mes_22 == "0" && $mes_11 == "0") {$new_mes = date("2016-01-20");} 
		   if($mes_33 == "0" && $mes_22 == "0" && $mes_11 == "0") {$new_mes = date("2016-02-20");}
		   if($mes_44 == "0" && $mes_33 == "0" && $mes_22 == "0" && $mes_11 == "0") {$new_mes = date("2016-03-20");}
		   if($mes_55 == "0" && $mes_44 == "0" && $mes_33 == "0" && $mes_22 == "0" && $mes_11 == "0") {$new_mes = date("2016-04-20");}
		   if($mes_66 == "0" && $mes_55 == "0" && $mes_44 == "0" && $mes_33 == "0" && $mes_22 == "0" && $mes_11 == "0") {$new_mes = date("2016-05-20");}
		   if($mes_77 == "0" && $mes_66 == "0" && $mes_55 == "0" && $mes_44 == "0" && $mes_33 == "0" && $mes_22 == "0" && $mes_11 == "0") {$new_mes = date("2016-06-20");}
 
              $data_pedido =  $new_mes ; 
			
		   if($mes_88 <> "0") {$new_mes_2 = date("2016-06-30");}	
		   if($mes_88 == "0") {$new_mes_2 = date("2016-05-30");}
		   if($mes_77 == "0" && $mes_88 == "0") {$new_mes_2 = date("2016-04-30");}
		   if($mes_66 == "0" && $mes_77 == "0" && $mes_88 == "0") {$new_mes_2 = date("2016-03-30");}
		   if($mes_55 == "0" && $mes_66 == "0" && $mes_77 == "0" && $mes_88 == "0") {$new_mes_2 = date("2016-02-30");}
		   if($mes_44 == "0" && $mes_55 == "0" && $mes_66 == "0" && $mes_77 == "0" && $mes_88 == "0") {$new_mes_2 = date("2016-01-30");}
		   if($mes_33 == "0" && $mes_44 == "0" && $mes_55 == "0" && $mes_66 == "0" && $mes_77 == "0" && $mes_88 == "0") {$new_mes_2 = date("2015-12-30");}
		   if($mes_22 == "0" && $mes_33 == "0" && $mes_44 == "0" && $mes_55 == "0" && $mes_66 == "0" && $mes_77 == "0" && $mes_88 == "0") {$new_mes_2 = date("2015-11-30");}


		   
		   $data_pedido_2 =  $new_mes_2 ; 
}

else {
		     
#------------------------------------------------------------------------------------------------------

#---------------------- Condição para data ------------------------------------------------------------
		 
		   if($mes_11 <> "0") {$new_mes = date("2015-11-01");}
		   if($mes_11 == "0") {$new_mes = date("2015-12-01");}
		   if($mes_22 == "0" && $mes_11 == "0") {$new_mes = date("2016-01-01");} 
		   if($mes_33 == "0" && $mes_22 == "0" && $mes_11 == "0") {$new_mes = date("2016-02-01");}
		   if($mes_44 == "0" && $mes_33 == "0" && $mes_22 == "0" && $mes_11 == "0") {$new_mes = date("2016-03-01");}
		   if($mes_55 == "0" && $mes_44 == "0" && $mes_33 == "0" && $mes_22 == "0" && $mes_11 == "0") {$new_mes = date("2016-04-01");}
		   if($mes_66 == "0" && $mes_55 == "0" && $mes_44 == "0" && $mes_33 == "0" && $mes_22 == "0" && $mes_11 == "0") {$new_mes = date("2016-05-01");}
		   if($mes_77 == "0" && $mes_66 == "0" && $mes_55 == "0" && $mes_44 == "0" && $mes_33 == "0" && $mes_22 == "0" && $mes_11 == "0") {$new_mes = date("2016-06-01");}
 
              $data_pedido =  $new_mes ; 
			
		   if($mes_88 <> "0") {$new_mes_2 = date("2016-06-30");}	
		   if($mes_88 == "0") {$new_mes_2 = date("2016-05-30");}
		   if($mes_77 == "0" && $mes_88 == "0") {$new_mes_2 = date("2016-04-30");}
		   if($mes_66 == "0" && $mes_77 == "0" && $mes_88 == "0") {$new_mes_2 = date("2016-03-30");}
		   if($mes_55 == "0" && $mes_66 == "0" && $mes_77 == "0" && $mes_88 == "0") {$new_mes_2 = date("2016-02-30");}
		   if($mes_44 == "0" && $mes_55 == "0" && $mes_66 == "0" && $mes_77 == "0" && $mes_88 == "0") {$new_mes_2 = date("2016-01-30");}
		   if($mes_33 == "0" && $mes_44 == "0" && $mes_55 == "0" && $mes_66 == "0" && $mes_77 == "0" && $mes_88 == "0") {$new_mes_2 = date("2015-12-30");}
		   if($mes_22 == "0" && $mes_33 == "0" && $mes_44 == "0" && $mes_55 == "0" && $mes_66 == "0" && $mes_77 == "0" && $mes_88 == "0") {$new_mes_2 = date("2015-11-30");}


		   
		   $data_pedido_2 =  $new_mes_2 ; 
}
		     
#------------------------------------------------------------------------------------------------------

#----------------Condição de minimo de grade para digitação--------------------------------------------

if($e_represetante == "18") {
#----Calçado-------------------
if($divisao == "Footwear") {$min_total = $e_min_c; }

#----Equipamento---------------
if($divisao == "Hardware" ) {
#----------Bola-----------------
		$min_total = $e_min_e;  
}
#----Têxtil -------------------
if($divisao == "Apparel") {
	
	    if(preg_match("/Meia/", $descricao))  { $min_total = "12"; }
	elseif(preg_match("/MEIA/", $descricao))  { $min_total = "12"; }
	elseif(preg_match("/MEIAO/", $descricao)) { $min_total = "12"; }
	elseif(preg_match("/Meiao/", $descricao)) { $min_total = "12"; }
	else                                      { $min_total = $e_min_t ; }
	
}
}

else {
#----Calçado-------------------
if($divisao == "Footwear") 
	{
	 $min_total = $e_min_c;  
	 }

#----Equipamento---------------
if($divisao == "Hardware" ) {
	#----------Bola-----------------
		$min_total = $e_min_e;  
}
#----Têxtil -------------------
if($divisao == "Apparel") {
	
	    if(preg_match("/Meia/", $descricao))  { $min_total = "12"; }
	elseif(preg_match("/MEIA/", $descricao))  { $min_total = "12"; }
	elseif(preg_match("/MEIAO/", $descricao)) { $min_total = "12"; }
	elseif(preg_match("/Meiao/", $descricao)) { $min_total = "12"; }
	else                                      { $min_total = $e_min_t ; }
}
}

#------------------------------------------------------------------------------------------------------      
         	 
            

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<title>Shop</title>
<script type="text/javascript" src="../../jquery.js"></script>
<script type="text/javascript">

$(document).ready(function(){
$('#data_6').focus(function(){
		$(this).calendario({ 
			target :'#data_6',
			dateDefault:$(this).val(),
			minDate:'<?php echo $data_pedido;?>',
			maxDate:'<?php echo $data_pedido_2 ; ?>'
		});
	});
});	
</script>

<script language="JavaScript" type="text/JavaScript">
ok=false;
function CheckAll() {
	if(!ok){
	  for (var i=0;i<document.f1.elements.length;i++) {
		var x = document.f1.elements[i];
		if (x.name == 'desta[]') {		
				x.checked = true;
				ok=true;
			}
		}
	}
	else{
	for (var i=0;i<document.f1.elements.length;i++) {
		var x = document.f1.elements[i];
		if (x.name == 'desta[]') {		
				x.checked = false;
				ok=false;
			}
		}	
	}
}
</script>
<script type="text/javascript" language="javascript">
function valida_form (){
if(document.getElementById("total").value < <?php echo $min_total;?>){
alert('Por favor, grade miníma de <?php echo $min_total;?>');
document.getElementById("total").focus();
return false
}
}
</script>

<style type="text/css">
@import url("estilo_shop.css");
#dinamite {
	position: absolute;
	left: 0;
	top: 0;
	width: 900px;
	height: auto;
	padding: 0;
	margin: 0;
}
body {
	background:none;
	overflow-x: hidden;}
#data_new {
	position: absolute;
	left: 153px;
	top: 7px;
	width: 200px;
	height: 62px;
}
#data_info {
	position: absolute;
	left: 115px;
	top: -78px;
	width: 154px;
	height: 50px;
	text-align: center;
}
#texto_48 {
	position: absolute;
	left: 142px;
	top: 82px;
	width: 456px;
	height: 22px;
}

.msg_23 {
	display: block;
	position: absolute;
	top: 0;
	left: 200px;
	width: 200px;
	text-align: center;
	padding: 5px;
	height: auto;
}

#img_window {
	position:absolute;
	display:block;
	top:0;
	left:500px;
	width:120px;}
</style>
</head>

<body>
<div id="dinamite">
<div id="dialog_dp" class="window"><img src="http://adisul.net/demandimage/rbk/thumb/<?php echo $artigo."_F.jpg";?>" id="img_window"/>  


       <form action="<?php echo $PHP_SELF;?>?inserirArtigos&artigo=<?php echo $artigo;?>" method="post" name="f1" onsubmit="return valida_form(this)">

<input type="hidden" name="qual">
       <div id="data">
       Escolha o mês abaixo :<br />
		<div id="container_data">
	  	<input type="text" class="dataport_1" name="artigo" value="<?php echo $s_artigo;?>" readonly hidden="hidden"  >
            
		<?php
      	$data_inicial = new DateTime( implode( '-', array_reverse( explode( '/', $data_pedido ) ) ) );
		$data_final   = new DateTime( implode( '-', array_reverse( explode( '/', $data_pedido_2 ) ) ) );
		while( $data_inicial <= $data_final ) {

	    echo "<label class=\"data_meses_2\" >
				<input type=\"checkbox\" value=\"".$data_inicial->format( 'Y-m-d' ) . "\"  name=\"data_6[]\" class=\"data_meses_3\"   /> ".$data_inicial->format( 'm/Y' ) . "</label><br />" . PHP_EOL;
		

		$data_inicial->modify('1 month');}
	
		?>
        </div>
        </div>

<div id="contatma"> 
		<span class="bloco1"><span class="quanti">Tamanho</span><span class="tama">Quantidade</span></span>   
       <?php		   
	  $query_grade_dp = mysqli_query($con, "SELECT * FROM  `rbkne024_reebok`.`$tabela`  WHERE  `Artigo` = '$s_artigo'") or die(mysql_error());
      while($array_grade_dp = mysqli_fetch_array($query_grade_dp)){
      $tamanho_dp    = $array_grade_dp["Tamanho"];
	  $valor_dp      = $array_grade_dp["custo"];
	  $valor_dp   = str_replace(",", ".", $valor_dp);
	  $valor_dp   = $valor_dp * $sul;	 
	  $valor_dp   =  number_format($valor_dp, 2, '.', '.'); 
	  $num += 1;
	  echo "
	  
	  <span class=\"bloco\">
	  	<input type=\"text\" class=\"dataport_3_3\" name=\"tamanho[]\" value=\"$tamanho_dp\" readonly><br />
		<input type=\"text\" class=\"dataport_3\"   name=\"quantidade[]\" id=\"m_".$num."\" value=\"0\" onkeypress=\"return SomenteNumero(event)\"  TABINDEX=\"1\" onblur=\"soma()\" />
	 </span>
";}?> 

 	<span class="bloco">	
      <input type="text" class="dataport_6_6" name="multipli" value="Total"  readonly="readonly"><br />
      <input type="text" class="dataport_6" id="total" name="total" value="0"  readonly="readonly" />
      
 </span>
 	<span class="bloco">	
      <input type="text" class="dataport_6_6" name="multipli" value="Multi" alt="Multiplicar está grade pelo numero abaixo, caso não deseja não altere este valor" title="Multiplicar está grade pelo numero abaixo, caso não deseja não altere este valor" readonly style="display:none;"><br />
      <input type="number" class="dataport_6" value="1"  name="multi" id="multi" alt="Multiplicar está grade pelo numero abaixo, caso não deseja não altere este valor" title="Multiplicar está grade pelo numero abaixo, caso não deseja não altere este valor" onkeypress="return SomenteNumero(event)"  style="display:none;"/>
      
 </span>
</div>
 
<script language="Javascript">

function soma(){
document.getElementById("total").value = '0'
var poko = parseInt(0);
<?php
$query_grade_dp = mysqli_query($con, "SELECT * FROM  `rbkne024_reebok`.`$tabela`  WHERE  `Artigo` = '$s_artigo'") or die(mysql_error());
while($array_grade_dp = mysqli_fetch_array($query_grade_dp)){
      $tamanho_dp    = $array_grade_dp["Tamanho"];	  
	  $num_p += 1;
	  
	  echo "var m_".$num_p." = parseInt(document.getElementById(\"m_".$num_p."\").value);";	  
} ?>
document.getElementById("total").value =<?php
$query_grade_dp = mysqli_query($con, "SELECT * FROM  `rbkne024_reebok`.`$tabela`  WHERE  `Artigo` = '$s_artigo'") or die(mysql_error());
while($array_grade_dp = mysqli_fetch_array($query_grade_dp)){
      $tamanho_dp    = $array_grade_dp["Tamanho"];	 
	  
	  $num_b += 1;
	  
   
 echo "m_".$num_b ."+";	  
} ?>poko ;
}
</script>


      <br />

      <p class="msg_23">
<?php
if($divisao == "Footwear") {echo "Atenção: Quantidade mínima $min_total , outras quantidades<br /> e múltiplos consulte seu representante.<br />";}
elseif($divisao == "Apparel") {echo "Atenção: Quantidade mínima $min_total ,<br /><img src=\"imagens/tabela.jpg\"/> <br />";}
elseif($divisao == "Hardware") {echo "Atenção: Quantidade mínima $min_total ,<br /><img src=\"imagens/tabela.jpg\"/> <br />";}
elseif($divisao == "Hardware" && $categoria == "Football/Soccer") {echo "Atenção: Quantidade mínima $min_total ,<br /><img src=\"imagens/futebol_tabela.PNG\"  /> <br />";}
elseif($divisao == "Hardware" && $categoria == "Basketball") { echo "Atenção: Quantidade mínima $min_total ,<br /><img src=\"imagens/bas_tabela.PNG\"  /> <br />";}
elseif($divisao == "Hardware" && $categoria == "Indoor") { echo "Atenção: Quantidade mínima $min_total ,<br /><img src=\"imagens/indoor_tabela.PNG\"  /> <br />";}
			

?>
Para valores em brancos e vazios subtitua com 0.</p>
    
      
     

<div id="blocoabada">
  Selecione a loja abaixo, e clique em adicionar antes de sair
  <br />
<a href="javascript:void(null)" onClick="CheckAll();" class="marcar">Marcar Todas - Desmarcar</a>
<?php
if($v_grupo == "SEM GRUPO" && $status_loja == "2"){	

$checke = "checked=\"checked\"";
	
$array_segmenta = explode(' ', $seg);		 
for($i=0; $i<count($array_segmenta); $i++)
$query_lojas = mysqli_query($con, "SELECT * FROM `$banco`.`login` WHERE `B` = '$senha'");
{$array_duplicatas2[$array_segmenta[$i]] = $array_segmenta[$i];}
}	
elseif($v_grupo <> "SEM GRUPO" && $status_loja == "2"){		
 
$checke = "checked=\"checked\"";
$query_lojas = mysqli_query($con, "SELECT * FROM `$banco`.`login` WHERE `B` = '$senha'");

{$array_duplicatas2[$array_segmenta[$i]] = $array_segmenta[$i];}
}
	
else {
#--------------------------Regra para pedido em grupos--------------------------------
$checke = "";
$seg   = explode(" ", $seg);
$dados = implode("','", $seg);

$query_lojas = mysqli_query($con, "SELECT * FROM `$banco`.`login` WHERE `segmento_2` IN('$dados') AND `nome` = '$v_grupo' AND `status` != '3' ORDER BY `cod_referencia` + 0 asc");
$lin = mysqli_num_rows($query_lojas);
    if($lin==0) // verifica se retornou algum registro
    {
   echo '

<br />
<center><span style=\"font-size=12pt;\"> Nenhuma loja está disponível para receber este produto no momento <br />
Para quaiquer dúvida entre em contato com seu representante</span></center>
<br />
<br />

<br />
<br />';
     }
	 }
	 echo "<table class=\"class_cliente\">";
	  while($array_lojas = mysqli_fetch_array($query_lojas))	  
	  {
      $lojas_adidas         = $array_lojas["B"];
	  $lojas_loja           = $array_lojas["loja"];
	  $lojas_cidade         = $array_lojas["cidade"];
	  $lojas_referenca      = $array_lojas["cod_referencia"];
	  $lojas_loja   = strtoupper($lojas_loja);
	  $lojas_cidade = strtoupper($lojas_cidade);
	  $lojas_referenca = "<b class=\"refere\">$lojas_referenca</b>";
	  	
	 echo "
	  <label class=\"parte1\" onClick=\"trocaFundo()\"  title=\"$lojas_loja - $lojas_cidade\">
	  <input class=\"abi\" type=\"checkbox\" $checke name=\"desta[]\" value=\"$lojas_adidas\" id=\"desta\"   />	 
	  $lojas_adidas / $lojas_referenca / $lojas_loja 
	  </label>
";

}
?>

<br />

<input type="submit" value="Adicionar" class="adicionar"  />


</div>

      <center><input type="hidden" value="<?php echo $npedido;?>"   name="npedido"  /></center>
	  <center><input type="hidden" value="<?php echo $valor_dp;?>"  name="valor" /></center>
      <center><input type="hidden" value="<?php echo $divisao;?>"   name="divisao" /></center>
      <center><input type="hidden" value="<?php echo $categoria;?>" name="categoria" /></center>
      <center><input type="hidden" value="<?php echo $descricao;?>" name="descricao" /></center>
      <center><input type="hidden" value="<?php echo $segmento;?>"  name="segmento" /></center>

    </form>
  </div>
</div>

</body>
</html>