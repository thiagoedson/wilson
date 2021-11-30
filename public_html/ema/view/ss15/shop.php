<?php
session_start();
$tabela = "prevendass16";
$s_artigo = $_GET["artigo"];
$artigo = $_GET["artigo"];
$search = $_GET["search"];
include"../../conexao.php";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="magiczoom/magiczoom.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="magiczoom/magiczoom.js" type="text/javascript"></script>
<script type="text/javascript" src="../../jquery.js"></script>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<title>adisul.net</title>
<style type="text/css" media="all">
@import url("estilo_shop.css");
#price_n {
	position: absolute;
	left: 730px;
	top: 320px;
	width: 216px;
	height: 265px;
	background-image: url(imagens/tela_painel.png);
}
html {
overflow-y:auto;
overflow-x:hidden;
}
iframe {
	overflow-x: hidden;}


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
document.getElementById("aqui").innerHTML="<img src='<?php echo "http://adisul.net/demandimage/rbk/wide/".$s_artigo."_F.jpg" ;?>' width='200' >";
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
		// charAt -> retorna o caractere posicionado no �ndice especificado
		var lchar = val.value.charAt(i);
		var nchar = val.value.charAt(i+1);	
		if(i==0){
		   // search -> retorna um valor inteiro, indicando a posi��o do inicio da primeira
		   // ocorr�ncia de expReg dentro de instStr. Se nenhuma ocorrencia for encontrada o m�todo retornara -1
		   // instStr.search(expReg);
		   if ((lchar.search(expr) != 0) || (lchar>3)){
			  val.value = "";
		   }
		   
		}else if(i==1){			   
			   if(lchar.search(expr) != 0){
				  // substring(indice1,indice2)
				  // indice1, indice2 -> ser� usado para delimitar a string
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

</head>
<body  onkeypress="para();">
<div id="conta">
<?php include"top.php";?>
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

$query_artigo = mysqli_query($con_reebok, "SELECT * FROM  `rbkne024_reebok`.`$tabela`  WHERE  `Artigo` = '$artigo'") or die(mysql_error());
while($array_grade = mysqli_fetch_array($query_artigo)){
$descricao_tipo_1    = $array_grade["Descricao"];
$seg                 = $array_grade["seg"];
$datadelancamento    = $array_grade["Data de Lancamento"];
$datadeencerramento  = $array_grade["Data de Encerramento"];
$s_artigo  			 = $array_grade["Artigo"];
$s_descri 			 = $array_grade["Descricao"];
$s_custo			 = $array_grade["custo"];
$s_vitrine 		     = $array_grade["vitrine"];
$s_segment 			 = $array_grade["Segmentacao"];
$s_usage  			 = $array_grade["Usage"];
$s_color             = $array_grade["Color"];
$s_categoria         = $array_grade["Categoria"];
$s_divisao           = $array_grade["Divisao"];
$s_mod               = $array_grade["mod"];
$gender_tipo         = $array_grade["Gender"];
$pag_tipo            = $array_grade["pag"];
$divisao_tipo        = $array_grade["Divisao"];
$segmento_tipo       = $array_grade["Segmentacao"];
$categoria_tipo      = $array_grade["Categoria"];
$ncm_tipo            = $array_grade["NCM"];
$ipi_tipo            = $array_grade["IPI"];
$pag_tipo            = $array_grade["pag"];
$tamanho             = $array_grade["SizeLocal"];
$s_segment			 = strtoupper($s_segment);
$s_usage 			 = strtoupper($s_usage);
$datadelancamento    = date('d/m/Y', strtotime(str_replace("-", "/", $datadelancamento ))); 
$datadeencerramento  = date('d/m/Y', strtotime(str_replace("-", "/", $datadeencerramento ))); 


$s_vitrine = str_replace(",", ".", $s_vitrine);
$s_vitrine =  number_format($s_vitrine, 2, ',', '.');
$s_custo = str_replace(",", ".", $s_custo);
$s_custo =  number_format($s_custo, 2, ',', '.');

if($datadeencerramento == "31/12/1969") {$datadeencerramento = "00/00/0000";}
}
?>
<iframe src="http://adisul.net/demandimage/swf/index.php?artigo=<?php echo $artigo;?>" name="tresd" frameborder="0" id="tresd" scrolling="no"></iframe>
<div id="moldura">
<div class="photo">

	<a  href="http://adisul.net/demandimage/rbk/wide/<?php echo $s_artigo;?>_F.jpg" rel="zoom-width:600px;zoom-height:300px;" class="MagicZoom"><img src="http://adisul.net/demandimage/rbk/wide/<?php echo $s_artigo;?>_F.jpg" alt="image" style="max-height:280px;" /></a><div id="apDiv2"></div>
</div>
</div>
<?php 
#--------------------------------------------------compra----------------------------------------------
if($p_status == "1") {
?>
<?php
;}?>
<div id="tipos">
<?php
$mae_sql = mysqli_query($con_reebok, "SELECT DISTINCT `Artigo` FROM `rbkne024_reebok`.`$tabela` WHERE `mod` = '$s_mod'");
while($array_tipo = mysqli_fetch_array($mae_sql)){
$artigo_tipo        = $array_tipo["Artigo"];
$descricao_tipo     = $array_tipo["Descricao"];
$data_tipo          = $array_tipo["Data de Lancamento"];
$data_tipo = date('d/m/Y', strtotime(str_replace("-", "/", $data_tipo )));
$datadelancamento = date('d/m/Y', strtotime(str_replace("-", "/", $datadelancamento )));

echo "<a href=\"shop.php?artigo=$artigo_tipo\" title=\"$descricao_tipo | $data_tipo \" ><img class=\"img_tipo\" src=\"http://adisul.net/demandimage/thumb/".$artigo_tipo."_F.jpg\" /></a>";
}
?>
</div>
<script language="javascript"> 
function tresd (URL){ 
   window.open("hall.php?artigo=<?php echo $s_artigo; ?>","janela1","width=600,height=600,scrollbars=NO") 
} 
</script> 
<div id="aqui"></div>
<?php 

if($material == "0") {;}
else {?>
<?php } ?>
<div id="info_arigo">
<span class="pdv">PDV "Pre&ccedil;o Sugest&atilde;o  de vitrine" <br />
	<p class="pdv_e">R$ <?php echo $s_vitrine;?></p></span>
<?php
$star_1 = "<img src=\"img/star_black.jpg\"/>";
$query_star_1 = mysqli_query($con_reebok, "SELECT * FROM `rbkne024_reebok`.`vistos_artigo` WHERE `artigo` = '$artigo'")or die(mysql_error());
while($star_array_1 = mysqli_fetch_array($query_star_1)){		
	  $total_star_1       = $star_array_1["count"];
	  }
#---- Condi��es-----
    if($total_star_1 >= 175) {$star_1 = "<img src=\"img/star_1.jpg\"/>";}
    if($total_star_1 >= 250) {$star_1 = "<img src=\"img/star_2.jpg\"/>";}
    if($total_star_1 >= 325) {$star_1 = "<img src=\"img/star_3.jpg\"/>";}
	if($total_star_1 >= 400) {$star_1 = "<img src=\"img/star_4.jpg\"/>";} 
	if($total_star_1 >= 475) {$star_1 = "<img src=\"img/star_5.jpg\"/>";}  
                    
#--------------------------------------------------------------------------
?>

<div id="star_adisul"><div id="star_label_v"><?php echo $star_1;?><br />
</div></div>   
<br />
 
<center><b>Dados Gerais </b></center><br />
<b>Descri&ccedil;&atilde;o :</b> <?php echo $descricao_tipo_1;?><br />
<b>Divisao :</b> <?php echo $divisao_tipo;?><br />
<b>Categoria :</b> <?php echo $categoria_tipo;?><br />
<b>Segmenta&ccedil;&atilde;o:</b><?php echo $segmento_tipo;?><br />
<b>P&aacute;g :</b> <?php echo $pag_tipo ;?><br />
<b>NCM :</b> <?php echo $ncm_tipo ;?><br />
<b>IPI :</b> <?php echo $ipi_tipo ;?><br />
<b>Cor : </b> <?php echo $s_color ;?><br />
<b>Tamanho : </b> <?php echo $tamanho ;?><br />
<?php
$atributos_sql = mysqli_query($con_reebok, "SELECT * FROM `rbkne024_reebok`.`banco_artigo` WHERE `Artigo` = '$s_artigo'");
while($array_atri = mysqli_fetch_array($atributos_sql)){
$atri_material1  = $array_atri["material1"];
$atri_material2  = $array_atri["material2"];
$atri_material3  = $array_atri["material3"];
$atri_material4  = $array_atri["material4"];
$atri_material5  = $array_atri["material5"];
$atri_material6  = $array_atri["material6"];
$atri_cor        = $array_atri["cor"];
$atri_seg        = $array_atri["seg"];
}


?>
<b>Material : </b> <?php echo $atri_material1 ;?><br />
<b>+ : </b> <?php echo $atri_material2 ;?><br />
<b>+ : </b> <?php echo $atri_material3 ;?><br />
<b>+ : </b> <?php echo $atri_material4 ;?><br />
<b>+ : </b> <?php echo $atri_material5 ;?><br />
<b>+ : </b> <?php echo $atri_material6 ;?><br />

<br />

</div>

</div>

</body>
</html>