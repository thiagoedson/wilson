<?php
session_start();
$barra_endereco = "../../";
include"../../conexao.php";
include"sql_pedido/p_pedido.php";

$s_artigo = $_GET["artigo"];
$artigo = $_GET["artigo"];
$search = $_GET["search"];
#-------------------------------------------------------------

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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../../img/Adidas.ico" rel="shortcut icon" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="magiczoom/magiczoom.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="magiczoom/magiczoom.js" type="text/javascript"></script>
<script type="text/javascript" src="../../jquery.js"></script>
<script type="text/javascript" src="../../menu.js"></script>

<script type="text/javascript" >
var req;
 
// FUNÇÃO PARA BUSCA NOTICIA
function buscarNoticias(valor) {
 
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
 
// Arquivo PHP juntamente com o valor digitado no campo (método GET)
var url = "funcao.php?valor="+valor+"&npedido="+<?php echo $npedido;?>;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
req.send(null);
}
</script>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<title>adisul.net</title>
<link type="text/css" href="../../menu.css" rel="stylesheet" />
<style type="text/css" media="all">
@import url("estilo_shop.css");

</style>
<script type="text/javascript" src="../../jquery.js"></script>
<script type="text/javascript" language="javascript">
    window.onload = function(){setInterval("trocaCor()", 1000);}
   
    function trocaCor()
    {
      var pisca = document.getElementById("painel_carteira");
      if(pisca.style.backgroundColor == "red")
      {
       pisca.style.backgroundColor = "blue";
       setTimeout("trocaCor();", 1000);
      }    
      else
      {
       pisca.style.backgroundColor = "red";
       setTimeout("trocaCor();", 1000);
      }
    }
  </script>
<script language="JavaScript">
function Enter() {
    var teste = window.event.keycode;
    if (teste == 13){
        return false;
    }
    return true;
}
</script>
<script type="text/javascript"> 
function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}
</script>
<script type="text/javascript">
function id( el ){
        return document.getElementById( el );
}
function getMoney( el ){
        var money = id( el ).value.replace( ',', '.' );
        return parseFloat( money )*100;
}
function soma()
{
        var total = getMoney('valor_servicos')+getMoney('valor_total_pecas');
        id('valor_total_geral').value = 'R$ '+total/100;
}
</script>
<script type="text/javascript">  
$(document).ready(function() {	
 
	$('a[name=modal]').click(function(e) {
		e.preventDefault();		
		var id = $(this).attr('href');	
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();	
		$('#mask').css({'width':maskWidth,'height':maskHeight}); 
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);		
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();              
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);	
		$(id).fadeIn(2000); 	
	});
	
	$('.window .close').click(function (e) {
		e.preventDefault();		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			
	
}); 
</script>
<script>
function click() {
if (event.button==2||event.button==3) {
oncontextmenu='return false';
}
}
document.onmousedown=click
document.oncontextmenu = new Function("return false;")
</script> 
<script type="text/javascript">
if(screen.width==1024) {
document.write('<style type="text/css">') 
document.write('#aqui{position: fixed; top: 0px; left: 390px;}') 
document.write('* html #aqui{position: absolute;')
document.write('top:expression(body.scrollTop + 0 + "px"); left:expression(body.scrollLeft + 390 + "px");') 
document.write('}</style>')
}
</script>
<script type="text/javascript">
function mostra(figura) {
document.getElementById("aqui").style.display="block";
document.getElementById("aqui").innerHTML="<img src='<?php echo "http://adisul.net/demandimage/rbk/wide/".$s_artigo."_F.jpg" ;?>' width='200' height='200'>";
}
function retira() {
document.getElementById("aqui").style.display="none";
document.getElementById("aqui").innerHTML="";
}
</script>
<script type="text/javascript">
 
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
<SCRIPT language="JavaScript1.2"> 
function openwindow()
{
	window.open("http://www.adisul.net/images/grade_e.jpg","mywindow","menubar=1,resizable=1,width=291,height=638");
}


function validar()
{

 if ($('input[type=checkbox][name=desta[]]:checked').length == 0){
        alert("Escolha qual loja deve receber este produto.");
        return false;
    }
   return true

}


</SCRIPT>
<script language="JavaScript">
function abrir(URL) {
 
  var width = 920;
  var height = 600;
 
  var left = 150;
  var top = 150;
 
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=0, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
 
}
</script>
<script type="text/javascript" >
var req;
 
// FUNÇÃO PARA BUSCA NOTICIA
function buscarNoticias(valor) {
 
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
 
// Arquivo PHP juntamente com o valor digitado no campo (método GET)
var url = "funcao.php?valor="+valor+"&npedido="+<?php echo $senha;?>;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
req.send(null);
}
</script>
</head>
<body  onkeypress="para();">
<div id="conta">
<?php 
include"top.php";
?>
<a href="dispo.php"><div id="bt_shop"></div></a>
<?php



function verifica($tabela,$con_reebok) { 
if(!(mysqli_query($con_reebok, "SELECT * FROM `rbkne024_reebok`.`$tabela`"))) { 
echo "<p class=\"msg_3\"><img src=\"img/msg_3.jpg\"><br />
Estamos atualizando o banco de dados , dentro de instantes estaremos de volta</p>"; 
exit;
} else { 

echo $msg_4; 

} 
} 

verifica("$tabela",$con_reebok); 

$query_artigo = mysqli_query($con, "SELECT * FROM  `rbkne024_reebok`.`$tabela`  WHERE  `Artigo` = '$s_artigo'") or die(mysql_error());
while($array_grade = mysqli_fetch_array($query_artigo)){
$descricao           = $array_grade["Descricao"];
$gender              = $array_grade["Gender"];
$seg                 = $array_grade["seg"];
$datadelancamento    = $array_grade["Data de Lancamento"];
$datadeencerramento  = $array_grade["Data de Encerramento"];




}
?>


<div id="moldura">
<div class="photo">

	<a  href="http://adisul.net/demandimage/rbk/wide/<?php echo $s_artigo;?>_F.jpg" rel="zoom-width:600px;zoom-height:300px;" class="MagicZoom">
   	  <img src="http://adisul.net/demandimage/rbk/wide/<?php echo $s_artigo;?>_F.jpg" alt="image"  style="max-width:180px; max-height:330px;" />
   </a>
   <br />
   A tonalidade das cores apresentadas <br />
   podem variar de acordo com cada monitor.
</div>
</div>


<div id="grade">


<table border="1px" align="center">

<tr>
	<td colspan="9" class="descricao"><?php echo $descricao ." | ". $s_artigo;?></td></tr>
<tr>
	<td>Tamanho</td>
    <td>Novembro</td>
    <td>Dezembro</td>
    <td>Janeiro</td>
    <td>Fevereiro</td>
    <td>Março</td>
    <td>Abril</td>
    <td>Maio</td>
    <td>Junho</td>
    
</tr> 
<?php 
$query_grade = mysqli_query($con, "SELECT * FROM  `rbkne024_reebok`.`$tabela`  WHERE  `Artigo` = '$s_artigo'") or die(mysql_error());
while($array_grade = mysqli_fetch_array($query_grade)){
$divisao     = $array_grade["Divisao"];
$tamanho     = $array_grade["Tamanho"];
$categoria   = $array_grade["Categoria"];
$segmento    = $array_grade["Segmentacao"];
$descricao   = $array_grade["Descricao"];
$mes_11  	 = $array_grade["mes_11"];
$mes_22  	 = $array_grade["mes_22"];
$mes_33      = $array_grade["mes_33"];
$mes_44      = $array_grade["mes_44"];
$mes_55      = $array_grade["mes_55"];
$mes_66      = $array_grade["mes_66"];
$mes_77      = $array_grade["mes_77"];
$mes_88      = $array_grade["mes_88"];
$s_vitrine   = $array_grade["vitrine"];
$s_custo     = $array_grade["custo"];
$s_cle_1     = $array_grade["cle_1"];
$season      = $array_grade["Season"];
$codmae      = $array_grade["mod"];
$usage       = $array_grade["Usage"];
$corr        = $array_grade["Color"];
$atri_seg    = $array_grade["Usage"];
$pag         = $array_grade["pag"];
$datadelancamento        = $array_grade["Data de Lancamento"];
$datadeencerramento      = $array_grade["Data de Encerramento"];

$datadelancamento   = date('d/m/Y', strtotime(str_replace("-", "/", $datadelancamento ))); 
$datadeencerramento = date('d/m/Y', strtotime(str_replace("-", "/", $datadeencerramento ))); 
$s_custo   = str_replace(",", ".", $s_custo);
$s_custo   = $s_custo * $sul;
$s_custo   =  number_format($s_custo, 2, ',', '.');
$s_cle_1   = str_replace(",", ".", $s_cle_1);
$s_cle_1   = $s_cle_1 * $sul;
$s_cle_1   =  number_format($s_cle_1	, 2, ',', '.');
$s_vitrine = str_replace(",", ".", $s_vitrine);
$s_vitrine =  number_format($s_vitrine, 2, ',', '.');

if($mes_11 > 1 ) {$mes_11 = "FREE";}
if($mes_22 > 1 ) {$mes_22 = "FREE";}
if($mes_33 > 1 ) {$mes_33 = "FREE";}
if($mes_44 > 1 ) {$mes_44 = "FREE";}
if($mes_55 > 1 ) {$mes_55 = "FREE";}
if($mes_66 > 1 ) {$mes_66 = "FREE";}
if($mes_77 > 1 ) {$mes_77 = "FREE";}
if($mes_88 > 1 ) {$mes_88 = "FREE";}


#------------ Tamanhos diferentes dos nacionais------------------------------------------------ -------------------------------------

echo " <tr><td>$tamanho</td><td>$mes_11</td><td>$mes_22</td><td>$mes_33</td><td>$mes_44</td><td>$mes_55</td><td>$mes_66</td><td>$mes_77</td><td>$mes_88</td></tr>";
}
?>
    
    <tr>
      <td colspan="9"></td>
    </tr>
  </table>
</div>
<div id="star_adisul"><div id="star_label_v"><?php echo $star;?><br />
 </div>

 </div>
<div id="price_n">

<br />
<br />
<br />
<div id="op_1">Vitrine R$ <?php echo $s_vitrine;?></div>
<div id="op_2">Custo R$ <?php echo $s_custo;?></div>
<div id="op_5"></div>


</div>
<?php 
#--------------------------------------------------compra----------------------------------------------
if($p_status == "1") {
?>

<a href="#dialog_dp" name="modal"><div id="buy">Adicionar ao carrinho</div></a>
<a href="javascript:abrir('window.php?artigo=<?php echo $s_artigo;?>');" ><div id="buy">Adicionar Produto</div></a>

<?php
;}?>
<div id="tipos">
<?php
$mae_sql = mysqli_query($con, "SELECT DISTINCT `Artigo`,`Descricao`,`Data de Lancamento` FROM `rbkne024_reebok`.`$tabela` WHERE `mod` = '$codmae'");
while($array_tipo = mysqli_fetch_array($mae_sql)){
$artigo_tipo        = $array_tipo["Artigo"];
$s_artigo			= $artigo_tipo;
$s_descri           = $array_tipo["Descricao"];
$data_tipo          = $array_tipo["Data de Lancamento"];
$data_tipo = date('d/m/Y', strtotime(str_replace("-", "/", $data_tipo )));
$data_tipo = date('d/m/Y', strtotime(str_replace("-", "/", $data_tipo )));
#--------------------------------------------------------------------	
if(strstr($s_segment,"CORE"))    {  $s_segment = "<font color=\"#009900\">$s_segment</font>"; }
if(strstr($s_segment,"ENHANCED")){  $s_segment = "<font color=\"#FF9900\">$s_segment</font>"; }
if(strstr($s_segment,"TOP"))	 {  $s_segment = "<font color=\"#FF3300\">$s_segment</font>"; }
if(strstr($s_segment,"TRAFFIC") ){  $s_segment = "<font color=\"#0000FF\">$s_segment</font>"; }
#------------------------Tamanhos------------------------------------
$query_tam_sql = mysqli_query($con, "SELECT `tamanho`,`Categoria`,`Divisao`,`status`,`Gender`,`Origem` FROM `rbkne024_reebok`.`$tabela` WHERE `Artigo` = '$artigo_tipo'")or die(mysql_error());
	 while($linha_query = mysqli_fetch_array($query_tam_sql))
   {
	$tamanho_query      = $linha_query["tamanho"];
	$categoria_query    = $linha_query["Categoria"];
	$s_tipo             = $linha_query["Divisao"];
	$s_status 		    = $linha_query["status"];
	$s_gender 		    = $linha_query["Gender"];
	$s_origem 		    = $linha_query["Origem"];
	
if($s_origem == "Brasil" or $s_origem == "brasil" or $s_origem == "Brazil" or $s_origem == "brazil" ) {$s_origem = "<img src=\"../body/brasil.png\" class=\"bandeira\" />";}
else {$s_origem = "";}
	
#------------ Tamanhos diferentes dos nacionais------------------------------------------------ -------------------------------------
	$tudo .= "<span class=\"tmb\">$tamanho_query</span>";
	};
#------------ Novo filtro se quantidade por tamamho "somente acima de 4 tamanhos serão exibidos -------------------------------------
$lin_filtro = mysqli_num_rows($query_tam_sql);
         if($lin_filtro < 1 && $s_tipo == "Footwear" && $categoria_query <> "Swim") // verifica se retornou algum registro
	       { $filtro_tamanho = "style=\"display:none;\"";  }
	  else { $filtro_tamanho = ""; }
#------------------Regra na procura da imagem------------------------------
#------------------------------------------------------------------------------------------------------------------------------------	
			$s_colecao = "new_collection";
	   $img_logo = "../../../favicon_1.ico";
#---------------------------------------------------------------------
include"star.php";
#-----------------------------------------------------------------------------------------------------------------------------------------------------------
if($p_status == "1") { $link_car = "<a href=\"javascript:abrir('window.php?artigo=$s_artigo');\" $filtro_tamanho><div id=\"buy_car\">Adicionar Produto</div></a>";
						
#------------Verifica se está na lista de produtos -------------------------------------
$query_marca = mysqli_query($con, "SELECT * FROM `$banco`.`lista_ss16` WHERE `npedido` = '$senha' AND `artigo` = '$s_artigo'")or die(mysql_error());
$filtro_marca = mysqli_num_rows($query_marca);
if($filtro_marca == 0 ) {						
$link_mar = "<span class=\"marcadorr\"> Incluir na lista <input type=\"checkbox\" id=\"busca\" onclick=\"buscarNoticias(this.value)\"  value=\"".$s_artigo."\" class=\"marcador\" /></span>";}
else {
$link_mar = "<span class=\"marcadorr_re\"> Incluir na lista <input type=\"checkbox\" id=\"busca\" onclick=\"buscarNoticias(this.value)\"  value=\"".$s_artigo."\" class=\"marcador\" checked=\"checked\"/></span>";}}
else {$link_car = "";
	  $link_mar = "";}   
	  
#------------Verifica se está na lista de produtos -------------------------------------
	$query_monst = mysqli_query($con, "SELECT `artigo` FROM `$banco`.`prevenda_monst_ss16` WHERE `artigo` = '$s_artigo'")or die(mysql_error());
	$filtro_monst = mysqli_num_rows($query_monst);
		if($filtro_monst == 0 ) {						
			$link_monst = "";}
		else {
 			$link_monst = "<span class=\"monst\">!</span>";}
               
#--------------------------------------------------------------------------	    
include"../body/artigo_pre.php";	
}
?>
<footer id="blocodado" name="blocodado"></footer>  
</div>
<?php if($search <> "") { ?>
<a href="dispo.php?search=<?php echo $search;?>"><div id="bt_volto"></div></a>
<?php } else {?>
<a href="javascript:window.history.go(-1)"><div id="bt_volto"></div></a>
<?php } ?>
<script language="javascript"> 
function tresd (URL){ 
   window.open("hall.php?artigo=<?php echo $s_artigo; ?>","janela1","width=600,height=600,scrollbars=NO") 
} 
</script> 
<div id="aqui"></div> 
<div id="barra_pedido">
<?php echo $p_menu;?>
</div>
<?php 

if($material == "0") {;}
else {?>
<?php } ?>
<div id="info_arigo">
<center><b>Dados Gerais </b></center><br />
<b>Página :</b> <?php echo $pag;?><br />
<b>Data de Lancamento :</b> <?php echo $datadelancamento;?><br />
<b>Data de Encerramento :</b> <?php echo $datadeencerramento;?><br />
<b>Descrição :</b> <?php echo $descricao;?><br />
<b>Divisao :</b> <?php echo $divisao;?><br />
<b>Categoria :</b> <?php echo $categoria;?><br />
<b>Segmentação :</b><?php echo $segmento;?><br />

<?php
mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');
$atributos_sql = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`banco_artigo` WHERE `Artigo` = '$s_artigo'");
while($array_atri = mysqli_fetch_array($atributos_sql)){
$atri_material1  = $array_atri["material1"];
$atri_material2  = $array_atri["material2"];
$atri_material3  = $array_atri["material3"];
$atri_material4  = $array_atri["material4"];
$atri_material5  = $array_atri["material5"];
$atri_material6  = $array_atri["material6"];
$atri_cor        = $array_atri["cor"];
$atri_tamanho    = $array_atri["Tamanho"];

}


?>
<b>Material : </b> <?php echo $atri_material1 ;?><br />
<b>+ : </b> <?php echo $atri_material2 ;?><br />
<b>+ : </b> <?php echo $atri_material3 ;?><br />
<b>+ : </b> <?php echo $atri_material4 ;?><br />
<b>+ : </b> <?php echo $atri_material5 ;?><br />
<b>+ : </b> <?php echo $atri_material6 ;?><br />
<b>Cor : </b> <?php echo $corr ;?><br />


</div>
<?php

$star = "";
include"star.php";
                    
#--------------------------------------------------------------------------
?>

 

</div>




<div id="boxes">

<div id="dialog_dp" class="window">
<a href="#" class="close">Fechar [X]</a><br />
<iframe src="window.php?artigo=<?php echo $s_artigo;?>" scrolling="yes" frameborder="0" width="100%" height="500px" style="overflow-x: hidden;"></iframe>
 
</div>
  
</div>


</body>
</html>