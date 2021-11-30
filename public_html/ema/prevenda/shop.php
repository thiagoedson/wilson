<?php
session_start();
include"../conexao.php";
include"sql_prevenda/pedreativo.php";

$s_artigo = $_GET["artigo"];
$artigo = $_GET["artigo"];
$search = $_GET["search"];

$query_cont = mysql_query("SELECT Artigo FROM fw12 WHERE Artigo = '$artigo'");
$cont_artigo = mysql_num_rows($query_cont);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="magiczoom/magiczoom.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="magiczoom/magiczoom.js" type="text/javascript"></script>
<script type="text/javascript" src="../jquery.js"></script>
<link href="../img/Adidas.ico" rel="shortcut icon" type="image/x-icon" />
<title>Pré Venda FW12</title>
<style type="text/css" media="all">
@import url("estilo_shop.css");

}
</style>
<script type="text/javascript" src="../jquery.js"></script>
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
document.getElementById("aqui").innerHTML="<img src='<?php echo "http://adisul.com/loja/imagens/produtos/".$s_artigo."_F.jpg" ;?>' width='300' height='200'>";
}
function retira() {
document.getElementById("aqui").style.display="none";
document.getElementById("aqui").innerHTML="";
}
</script>
<script type="text/javascript">
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

<SCRIPT language="JavaScript1.2"> 
function openwindow()
{
	window.open("http://www.adisul.com/images/grade_e.jpg","mywindow","menubar=1,resizable=1,width=291,height=638");
}
</SCRIPT>
</head>
<body  onkeypress="para();">
<div id="conta">
<div id="campo_03"></div>
<div id="bg_div"></div>
<div id="painel_carteira" style="background-color: red;">
<center>
<?php 
$query2 = mysql_query("select * from carteira WHERE `Codigo Cliente` = '$senha' AND `Codigo Artigo` = '$s_artigo' ORDER BY `Data Entrega  Revisada`") or die(mysql_error());

while($array2 = mysql_fetch_array($query2)){

$categoria 		   = $array2["Categoria"];
$categoriac	       = $array2["Categoria"];
$cod_Artigo        = $array2["Codigo Artigo"];
$cliente_grupo     = $array2["Cliente"];
$order_type 	   = $array2["Order Type"];
$desc_artigo       = $array2["Descricao Artigo"];
$qtnd_faturada     = $array2["Qtde Total a Faturar"];
$total_faturado    = $array2["Valor total a Faturar"];
$qtnd_tamanho      = $array2["Qtde por Tamanho"];
$entrega_revisada  = $array2["Data Entrega  Revisada"];
$status  		   = $array2["Status do pedido"];
$ccodigo_cliente   = $array2["Codigo Cliente"];
$cidade            = $array2["Cidade"];
$entrega_revisada  = date('d/m/Y', strtotime(str_replace("-", "/", $entrega_revisada )));
if( $status == "Confirmado"){
			$cor = "#CF9";}
		else
			{$cor = "#FFFFFF";}
if (strstr($categoria, "Footwear")) {$categoria = "Calçado";}
if (strstr($categoria, "Apparel")) {$categoria = "Têxtil";}
if (strstr($categoria, "Hardware")) {$categoria = "Equip";}
$total_faturado = str_replace(",", ".", $total_faturado);
$total_faturado =  number_format($total_faturado, 2, ',', '.');
$total_faturado = "R$ $total_faturado";
echo "
 <table border=\"1px\" class=\"carteira_table\">
 <tr><td colspan=\"7\" align=\"center\" class=\"carteira\">Produto em sua carteira</td><tr>
 <tr bgcolor=\"$cor\" >
   <td width=\"100px\">Artigo</td><td>Coleção</td><td>Quant</td><td>Valor</td><td>Quant/Tam</td><td>Data Revidada</td><td>Status</td>
 </tr>
 <tr bgcolor=\"$cor\" >
   <td width=\"100px\">$cod_Artigo</td><td>&nbsp;$order_type</td><td>$qtnd_faturada</td><td>$total_faturado</td><td>$qtnd_tamanho</td><td>$entrega_revisada</td><td>$status</td>
 </tr>
 </table>";
 $cont++;
}
?>
</center>
</div>
<?php 
#--------------------------------------------------compra----------------------------------------------
if($p_status == "1") {
?>
<a href="#dialog_dp" name="modal"><div id="buy">Adicionar ao Carrinho</div></a>
<?php
;}?>
<iframe src="http://adisul.com/shop/tresd/index.php?artigo=<?php echo $artigo;?>" name="tresd" frameborder="0" id="tresd" scrolling="no"></iframe>
<div id="moldura">
<?php echo $img = "<a  href=\"http://adisul.com/loja/imagens/produtos/".$s_artigo."_F.jpg\" rel=\"zoom-width:600px;zoom-height:300px;\" class=\"MagicZoom\"><img src=\"http://adisul.com/loja/imagens/produtos/".$s_artigo."_F.jpg\" width=\"320px\" height=\"300px\" /></a>" ; ?>
</div>
<div id="grade">

<table border="1px" width="100%">

<tr><td colspan="8">Artigo Nº <?php echo $s_artigo;?></td></tr>
<tr><td>Grade</td><td>Junho</td><td>Julho</td><td>Agosto</td><td>Setembro</td><td>Outubro</td><td>Novembro</td><td>Dezembro</td></tr> 
<?php 
$query_grade = mysql_query("select * from  `adisul_adidas`.`fw12`  where  artigo = '$s_artigo'") or die(mysql_error());
while($array_grade = mysql_fetch_array($query_grade)){
$divisao     = $array_grade["Divisao"];
$tamanho     = $array_grade["Tamanho"];
$categoria   = $array_grade["Categoria"];
$segmento    = $array_grade["Segmentacao"];
$usage       = $array_grade["Usage"];
$descricao   = $array_grade["Descricao"];
$junho       = $array_grade["Junho 2012"];
$julho       = $array_grade["Julho 2012"];
$agosto      = $array_grade["Agosto 2012"];
$setembro    = $array_grade["Setembro 2012"];
$outubro     = $array_grade["Outubro 2012"];
$novembro    = $array_grade["Novembro 2012"];
$dezembro    = $array_grade["Dezembro 2012"];
$s_vitrine   = $array_grade["vitrine"];
$s_custo     = $array_grade["custo"];
$season      = $array_grade["Season"];
$codmae      = $array_grade["mod"];
$gender      = $array_grade["Gender"];
$clearence      = $array_grade["Clearance"];
$cor_artigo      = $array_grade["Color"];
$datadelancamento      = $array_grade["Data de Lancamento"];
#---Tratamento--------------------------------------------------
$s_custo = str_replace(",", ".", $s_custo);
$s_custo = $s_custo * 0.95;
$s_custo =  number_format($s_custo, 2, ',', '.');
$s_vitrine = str_replace(",", ".", $s_vitrine);
$s_vitrine =  number_format($s_vitrine, 2, ',', '.');
$datadelancamento = date('d/m/Y', strtotime(str_replace("-", "/", $datadelancamento )));
echo " <tr><td width=\"30px\">$tamanho</td><td>$junho</td><td>$julho</td><td>$agosto</td><td>$setembro</td><td>$outubro</td><td>$novembro</td><td>$dezembro</td></tr>";
}
?>  
<tr><td colspan="8"><?php echo $descricao;?></td></tr>
<tr><td colspan="4" class="vitrine">Vitrine R$ <?php echo $s_vitrine;?></td><td colspan="4" class="custo">14DD Bruto R$ <?php echo $s_custo;?></td></tr>
<br />
<?php
if(preg_match('[^0-9]',$tamanho)){ echo "<center><A href=\"javascript: openwindow()\" class=\"duvida\">Dúvida na grade ? clique aqui</a></center>";} else 
{       
 echo "";     
}
?>
</table>
</div>

<?php

if($search == "") {
?>
<a href="index.php?divisao=<?php echo $divisao ;?>&categoria=<?php echo $categoria;?>&gender=<?php echo $gender;?>"><div id="bt_volto">Voltar</div></a>
<?php } 

else {
?>
<a href="index.php?search=<?php echo $search;?>"><div id="bt_volto">Voltar</div></a>
<?php } ?>


<div id="desc">
  Descrição:
  <?php echo $descricao; echo "<br />
Segmentação : $segmento Usage: $usage<br />
Categoria : $categoria<br />
Divisão : $divisao<br />
Season : $season<br />
Data de lançamento : $datadelancamento<br />
Cor: $cor_artigo;
";
?>
  <hr />
</div>
<script language="javascript"> 
function tresd (URL){ 
   window.open("hall.php?artigo=<?php echo $s_artigo; ?>","janela1","width=600,height=600,scrollbars=NO") 
} 
</script> 
<div id="aqui"></div>
<div id="barra_pedido">
  <?php echo $p_menu;?>
</div>
<div id="tipo">
<?php

$mae_sql = mysql_query("select DISTINCT Artigo, Descricao , `Data de Lancamento` from `adisul_adidas`.`fw12` where `mod` = '$codmae'");
while($array_tipo = mysql_fetch_array($mae_sql)){
$artigo_tipo     = $array_tipo["Artigo"];
$descricao_tipo     = $array_tipo["Descricao"];
$data_tipo     = $array_tipo["Data de Lancamento"];

$data_tipo = date('d/m/Y', strtotime(str_replace("-", "/", $data_tipo )));

echo "<a href=\"shop.php?artigo=$artigo_tipo\" title=\"$descricao_tipo | $data_tipo \" ><img class=\"img_tipo\" src=\"http://adisul.com/thumb/".$artigo_tipo."_F.jpg\" /></a>";
}

?>

</div>
</div>


<div id="boxes">
<script>

function validar() {
data=new Date()
dia=data.getDate()
mes=data.getMonth()
ano=data.getYear()
toda=dia+"/"+mes+"/"+ano

data_usu=teste.data.value
if(data_usu<toda) {

alert(data_usu+ " data menor que " +toda )
} 

}

</script>

<div id="dialog" class="window">
<a href="#" class="close">Fechar [X]</a><br />
<?php 
$v_p_verifica =  mysql_query("SELECT `nome`,`status` FROM login WHERE `B` = '$senha'") or die(mysql_error());
while($v_p_array = mysql_fetch_array($v_p_verifica)){
	$v_grupo             = $v_p_array["nome"];
	$v_status_login      = $v_p_array["status"];
	
	};
if($v_grupo == "SEM GRUPO") {
	?>
    Selecione a loja:
<form action="<?php echo $PHP_SELF;?>?iniciarPedidos&ok=1&tipo=<?php echo $tipo ;?>&categoria=<?php echo $categoria;?>" method="post">
  <select name="codadidas">
    
<?php
$v_p_verifica_grupo =  mysql_query("SELECT * FROM login WHERE `B` = '$senha'") or die(mysql_error());

while($v_p_array_grupo = mysql_fetch_array($v_p_verifica_grupo)){	
	
	$v_codadidas  = $v_p_array_grupo["B"];
	$v_cliente    = $v_p_array_grupo["loja"];
	$v_cnpj       = $v_p_array_grupo["C"];
	$segmenta     = $v_p_array_grupo["segmento_2"];
			
				if($segmenta == "C03") {$v_segmento = "Especializada";}
			elseif($segmenta == "C04") {$v_segmento = "Generalista de Imagem";}
			elseif($segmenta == "C05") {$v_segmento = "Generalista Comercial";}
			elseif($segmenta == "C06") {$v_segmento = "Directional de Imagem";}
			elseif($segmenta == "C07") {$v_segmento = "Lifestyle de Imagem";}
			elseif($segmenta == "C08") {$v_segmento = "Lifestyle Comercial";}
			elseif($segmenta == "C09") {$v_segmento = "Fashion";}
			elseif($segmenta == "C10") {$v_segmento = "Loja Conceito";}
			$v_segmento = strtoupper($v_segmento); 
			
	echo "<option value=\"$v_codadidas\">$v_cnpj | $v_cliente | $v_segmento</option>";
	
};
?>
    </select>
  <input name="button" type="submit"  value="Começar Pedido">
</form>
	
	<?php
	;}
	
elseif($v_status_login == "2") {
	?>
    Selecione a loja:
<form action="<?php echo $PHP_SELF;?>?iniciarPedidos&ok=1&tipo=<?php echo $tipo ;?>&categoria=<?php echo $categoria;?>" method="post">
  <select name="codadidas">
    
<?php
$v_p_verifica_grupo =  mysql_query("SELECT * FROM login WHERE `B` = '$senha'") or die(mysql_error());

while($v_p_array_grupo = mysql_fetch_array($v_p_verifica_grupo)){	
	
	$v_codadidas  = $v_p_array_grupo["B"];
	$v_cliente    = $v_p_array_grupo["loja"];
	$v_cnpj       = $v_p_array_grupo["C"];
	$segmenta     = $v_p_array_grupo["segmento_2"];
			
				if($segmenta == "C03") {$v_segmento = "Especializada";}
			elseif($segmenta == "C04") {$v_segmento = "Generalista de Imagem";}
			elseif($segmenta == "C05") {$v_segmento = "Generalista Comercial";}
			elseif($segmenta == "C06") {$v_segmento = "Directional de Imagem";}
			elseif($segmenta == "C07") {$v_segmento = "Lifestyle de Imagem";}
			elseif($segmenta == "C08") {$v_segmento = "Lifestyle Comercial";}
			elseif($segmenta == "C09") {$v_segmento = "Fashion";}
			elseif($segmenta == "C10") {$v_segmento = "Loja Conceito";}
			$v_segmento = strtoupper($v_segmento); 
			
	echo "<option value=\"$v_codadidas\">$v_cnpj | $v_cliente | $v_segmento</option>";
	
};
?>
    </select>
  <input name="button" type="submit"  value="Começar Pedido">
</form>
	
	<?php
	;}

else {
	?>
Selecione a loja:
<form action="<?php echo $PHP_SELF;?>?iniciarPedidos&ok=1&tipo=<?php echo $tipo ;?>&categoria=<?php echo $categoria;?>" method="post">
  <select name="codadidas">
   
<?php
$v_p_verifica_grupo =  mysql_query("SELECT * FROM `login` WHERE `login`.`nome` = '$v_grupo'") or die(mysql_error());

while($v_p_array_grupo = mysql_fetch_array($v_p_verifica_grupo)){	
	
	$v_codadidas  = $v_p_array_grupo["B"];
	$v_cliente    = $v_p_array_grupo["loja"];
	$v_cnpj       = $v_p_array_grupo["C"];
	$segmenta     = $v_p_array_grupo["segmento_2"];
			
				if($segmenta == "C03") {$v_segmento = "Especializada";}
			elseif($segmenta == "C04") {$v_segmento = "Generalista de Imagem";}
			elseif($segmenta == "C05") {$v_segmento = "Generalista Comercial";}
			elseif($segmenta == "C06") {$v_segmento = "Directional de Imagem";}
			elseif($segmenta == "C07") {$v_segmento = "Lifestyle de Imagem";}
			elseif($segmenta == "C08") {$v_segmento = "Lifestyle Comercial";}
			elseif($segmenta == "C09") {$v_segmento = "Fashion";}
			elseif($segmenta == "C10") {$v_segmento = "Loja Conceito";}
			$v_segmento = strtoupper($v_segmento); 
			
	echo "<option value=\"$v_codadidas\">$v_cnpj | $v_cliente | $v_segmento</option>";
	
};
?>
   </select>
  <input name="button" type="submit" onclick="" value="Começar Pedido ">
</form>

<?php ;}?>
</div>

<div id="dialog_dp" class="window">

<a href="#" class="close">Fechar [X]</a><br />

<center><img src="http://adisul.com/thumb/<?php echo $artigo."_F.jpg";?>" /><br />

<?php
if($divisao == "Footwear") {echo "Atenção será somente aceitos pedidos com calçados acima de 12 pares.<br/>";}
else { echo "Quantidade miníma $clearence";}
?>
</center>

  <div id="dataport">
  <br />  

   <?php
	  $count = 1;
	  $counto = 1;
	  
	  $new_mes = date('m');
	  
	       if($outubro == 0) {$new_mes = date('m')+ 1;}
           if($novembro == 0) {$new_mes = date('m')+ 2;}
	  
	  $data_pedido = date('Y'.$new_mes.'d');
	  	
	 
    function addDayIntoDate($date,$days) {
     $thisyear = substr ( $date, 0, 4 );
     $thismonth = substr ( $date, 4, 2 );
     $thisday =  substr ( $date, 6, 2 );
	 
     $nextdate = mktime ( 0, 0, 0, $thismonth + $new_mes, $thisday + $days, $thisyear );
     return strftime("%d/%m/%Y", $nextdate);
}
	  
	  $data_pedido = addDayIntoDate($data_pedido,2);
	  
	  ?>
       <form action="<?php echo $PHP_SELF;?>?inserirArtigos" method="post" name="oi" >
       <input type="hidden" name="qual">
     <center><span class="dataport_1_1">Artigo</span><span class="dataport_2_2">Data</span><br />




	   <input type="text" class="dataport_1" name="artigo" value="<?php echo $s_artigo;?>" readonly ><input type="text" class="dataport_2" name="data" value="<?php echo $datadelancamento;?>"> <img src="../shop/img/data_dp.jpg"><br />
<br /></center>
		<span class="bloco"><span class="quanti">Tamanho</span><span class="tama">Quantidade</span></span>

       <?php
	  
	   
		   
	  $query_grade_dp = mysql_query("select * from  fw12  where  Artigo = '$s_artigo'") or die(mysql_error());
      while($array_grade_dp = mysql_fetch_array($query_grade_dp)){
      $tamanho_dp    = $array_grade_dp["Tamanho"];
	  $valor_dp   = $array_grade_dp["custo"];
	  
	  echo "
	  <span class=\"bloco\">
	  	<input type=\"text\" class=\"dataport_3_3\" name=\"tamanho[]\" value=\"$tamanho_dp\" readonly><br />

		<input type=\"text\" class=\"dataport_3\" name=\"quantidade[]\" id=\"el\" onkeypress=\"return SomenteNumero(event)\" TABINDEX=1></span>";
	  
	  }
      ?>
     	
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
            
	  <center><input type="hidden" value="<?php echo $valor_dp;?>" name="valor" /></center>
      <center><input type="hidden" value="<?php echo $descricao;?>" name="descricao" /></center>
      <center><input type="hidden" value="<?php echo $segmento;?>" name="segmento" /></center>
      <center><input type="submit" value="Adicionar" style="width:200px; height:50px;" onClick="return validaData(campos.data);"></center>
    </form>
  </div>
</div>
  
</div>
<div id="mask"></div>
<div id="painel_botton"><?php echo $rodape_fixo; ?></div> 
</body>
</html>