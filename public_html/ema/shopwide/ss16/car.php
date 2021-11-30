<?php
session_start();
include"../../conexao.php";
include"sql_pedido/p_pedido.php";
if($p_status <> "1") {echo "<meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = dispo.php\">";}


$search = $_POST["obs"];
if($search <> "") {
	
	$cd_cl = $_POST["obs"];
    $resultado_npedido = mysqli_query($con, "UPDATE  `pedido_ss16` SET `obs` = '$cd_cl'
	 WHERE  `npedido` = '$npedido'");
	
	 $obs_pedido = $cd_cl;
}


#-------------------Alterar o mês do pedido do cliente----------------------------------------------
if (isset($_GET['AlteraData'])){
	
AlteraData();
}

function AlteraData() {
	
		$new_data = $_GET["data_new"];
		$data 	  = $_GET["data"];
		$pedido   = $_GET["pedido"];
		$artigo   = $_GET["artigo"];
		$loja     = $_GET["loja"];
		
		
		$resultado_npedido = mysqli_query($con, "UPDATE  `lista_artigo_pedido_ss16` SET `data` = '$new_data' WHERE  `npedido` = '$pedido' AND `loja` = '$loja' AND `data` = '$data' ");
		
		header("location:car.php?id=1");
	
	
	
	
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<title>adisul.net</title>
<link type="text/css" href="../../menu.css" rel="stylesheet" />
<style type="text/css" media="all">
@import url("estilo_shop.css");
</style>
<script type="text/javascript" src="../../jquery.js"></script>
<script type="text/javascript" src="../../menu.js"></script>
<script>
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
function click() {
if (event.button==2||event.button==3) {
oncontextmenu='return false';
}
}
document.onmousedown=click
document.oncontextmenu = new Function("return false;")
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
		$(id).fadeIn(2000); 	});	
	$('.window .close').click(function (e) {
		e.preventDefault();		
		$('#mask').hide();
		$('.window').hide();	});	
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();	});	
});
</script>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.20.custom.min.js"></script>
		<script type="text/javascript">
			$(function(){
				// Accordion
				$("#accordion").accordion({ header: "h3",
				autoHeight: false,
				collapsible: true });
				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); },
					function() { $(this).removeClass('ui-state-hover'); }
				);
			});
		</script>
<script language="javascript" src="flot/excanvas.min.js"></script>
<script language="javascript" src="flot/jquery.flot.js"></script>
<script language="javascript" src="flot/jquery.flot.pie.js"></script>
<script type="text/javascript">
<!-- 
function goto_URL(object) {
window.location.href = object.options[object.selectedIndex].value; }
//-->
</script>
</head>
<body>
<div id="conta">
<?php 
include"top.php";
?>

<div id="car">
<img src="img/carrinho.png"  />
<hr />
<hr />
<hr />
<br />
<div id="dados">Pedido Nº <b><?php echo $npedido;?></b> <br />
Feito por <b><?php echo $nome_cliente ;?></b> <br />
Iniciado no dia <b><?php echo $p_data_inicial;?></b> às <b><?php echo $p_hora_inicial ?> .</b>

</div>
<div id="campo_obs">
	<form action="<?php echo $PHP_SELF; ?>" method="post">
	Observação:<br />
	<textarea name="obs" cols="60" rows="3" id="msg"><?php echo $obs_pedido;?></textarea>
	<br />

    <input type="submit" value="Salvar" style="padding:3px;margin:2px;"/>
    </form>
</div>
<div class="demo">

<div id="accordion">
<?php
$tora = 0;
$query_car = mysqli_query($con, "SELECT DISTINCT `loja` FROM  `lista_artigo_pedido_ss16`  WHERE `npedido` = '$npedido'");
while($car_array_2 = mysqli_fetch_array($query_car)){		
    $car_loja      = $car_array_2["loja"];
	
$car_loja_lista = mysqli_query($con, "SELECT `loja`,`cod_referencia` FROM `$banco`.`login` WHERE `B` = '$car_loja'") or die(mysql_error());
while($array_xx = mysqli_fetch_array($car_loja_lista)){
		
	$car_nome_loja       = $array_xx["loja"];
	$car_refere			 = $array_xx["cod_referencia"];
	
$somar_total_pedido_1 = mysqli_query($con, "SELECT SUM(total) as soma FROM  `lista_artigo_pedido_ss16`  WHERE  `npedido` = '$p_pedido' AND `loja` = '$car_loja'") or die(mysql_error());
while($linha_array_eee = mysqli_fetch_array($somar_total_pedido_1)){$linha_eee = $linha_array_eee["soma"];}
$linha_eee          =  number_format($linha_eee, 2, ',', '.');
}
	
	echo "
	
	<h3>
	<a href=\"\">$car_loja - <b>$car_nome_loja</b> | <b class=\"refere\">$car_refere</b> | Total desta loja* R$ $linha_eee</a></h3>
	<div class=\"bloco_car\">
	<table class=\"car_classe\">
	  <tr>
	    <td></td>
		<td>Tamanho/Quantidade</td>
		<td>Artigo</td>
		<td>Descrição</td>
		<td>Quantidade Total</td>		
		<td>Preço Unitário</td>
		<td>Preço Total</td>
		<td>Data Solicitada</td>
		<td></td>
		<td>Ações</td>
	  </tr>
	  ";
	
$query_pedido_aberto = mysqli_query($con, "SELECT DISTINCT `artigo`, `data` FROM  `lista_artigo_pedido_ss16`  WHERE `npedido` = '$npedido' AND `loja` = '$car_loja' ORDER BY `data`") or die(mysql_error());	
	$lin = mysqli_num_rows($query_pedido_aberto);
    if($lin==0) // verifica se retornou algum registro
    {
		$atua_total_pedido_zero = mysqli_query($con, "UPDATE `pedido_ss16` SET `total` = '$zero'  WHERE  `npedido` = '$p_pedido'"); 
    echo "<center class=\"car_vazio\">Carrinho Vazio</center>";     }	
    while($array_pedido_aberto = mysqli_fetch_array($query_pedido_aberto)){		
    $sqlpedido_artigo      = $array_pedido_aberto["artigo"];
    $sqlpedido_data        = $array_pedido_aberto["data"];
	$sqlpedido_datax       = $array_pedido_aberto["data"];
#------conta a quantidade de produtos------------------------
$query_total = mysqli_query($con, "SELECT SUM(quantidade) as soma FROM  `lista_artigo_pedido_ss16`  WHERE `artigo` = '$sqlpedido_artigo' AND `npedido` = '$p_pedido' AND `data` = '$sqlpedido_data' AND `loja` = '$car_loja'") or die(mysql_error());
while($linha_array = mysqli_fetch_array($query_total)){$linha = $linha_array["soma"];}
#------------------------------------------------------------
#----------------------Soma Pedido---------------------------
$query_total_pe = mysqli_query($con, "SELECT SUM(total) as soma FROM  `lista_artigo_pedido_ss16`  WHERE  `npedido` = '$p_pedido' AND `loja` = '$car_loja'") or die(mysql_error());
while($linha_array_pe = mysqli_fetch_array($query_total_pe)){$linha_pe = $linha_array_pe["soma"];}
#------------------------------------------------------------
#----------------------Recolhendo Informações-----------------
$query_total_info = mysqli_query($con, "SELECT * FROM  `lista_artigo_pedido_ss16`  WHERE  `npedido` = '$p_pedido' AND `artigo` = '$sqlpedido_artigo' AND `loja` = '$car_loja' AND `data` = '$sqlpedido_datax'") or die(mysql_error());
while($linha_array_info = mysqli_fetch_array($query_total_info)){
	$info_valor_unite = $linha_array_info["valor"];
	$info_descricao_unite = $linha_array_info["descricao"];
	$info_segmento_unite = $linha_array_info["segmento"];
	$info_categoria_unite = $linha_array_info["categoria"];
	$sqlpedido_total = $linha_array_info["valor"];}
#------------------------------------------------------------
#-----------Tratanto valores e fazendo conta -------------------  	
	$sqlpedido_data    = date('d/m/Y', strtotime(str_replace("-", "/", $sqlpedido_data )));
	$info_valor_unitex = number_format($info_valor_unite, 2, ',', '.');
	$total_item        = $sqlpedido_total * $linha;	
	$total_item        = $total_item;
	$linha_pe          = $linha_pe;
	$total_pedido      = $linha_pe;	
	$total_item        =  number_format($total_item, 2, ',', '.');	
	$info_valor_unite  =  str_replace(",", ".", $info_valor_unite);	
	$info_valor_unite  = $info_valor_unite;
	$info_valor_unite  =  number_format($info_valor_unite, 2, ',', '.');
	$linha_pe          =  number_format($linha_pe, 2, ',', '.');	
	$query_tam_sql = mysqli_query($con, "SELECT `tamanho`,`quantidade` FROM `lista_artigo_pedido_ss16` WHERE `npedido` = '$p_pedido' AND `artigo` = '$sqlpedido_artigo' AND `loja` = '$car_loja' AND `data` = '$sqlpedido_datax'")or die(mysql_error());
	 while($linha_query = mysqli_fetch_array($query_tam_sql))
   {
	$tamanho_query    = $linha_query["tamanho"];
	$quantidade_query = $linha_query["quantidade"]; 
	
	$tudo .= "<b class=\"tm\">$tamanho_query <br /><span  class=\"qt\">$quantidade_query</b> ";
	};
#------------------------------------------------------------------	
#-------------Tratamento datas disponiveis para mudança------------

$query_grade_data = mysqli_query($con, "SELECT `Data de Lancamento`,`Data de Encerramento` FROM  `rbkne024_reebok`.`$tabela`  WHERE  Artigo = '$sqlpedido_artigo'") or die(mysql_error());
while($array_data_swifth = mysqli_fetch_array($query_grade_data)){

$datadelancamento    = $array_data_swifth["Data de Lancamento"];
$datadeencerramento  = $array_data_swifth["Data de Encerramento"];


$data_lancamento = $datadelancamento;
}
while( $datadelancamento < $datadeencerramento ) {
	
	
	
	$data_new = date('m/Y', strtotime(str_replace("-", "/", $datadelancamento )));
	
	$data_swifth .=  "<option value=\"?AlteraData&artigo=$sqlpedido_artigo&pedido=$p_pedido&data=$sqlpedido_datax&data_new=$datadelancamento&loja=$car_loja\">$data_new</option>" .PHP_EOL;
	
	$datadelancamento = date('Y-m-d', strtotime("+1 month", strtotime($datadelancamento)));


		}


#------------------------------------------------------------------
	echo "
	<tr class=\"car_tr_hover\">
	  <td><img src=\"http://adisul.net/demandimage/rbk/thumb/".$sqlpedido_artigo."_F.jpg\"  class=\"timg\" /></td>
	  <td>$tudo</td>
	  <td>$sqlpedido_artigo</td>
	  <td>$info_descricao_unite</td>
	  <td>$linha</td>	  
	  <td>R$ $info_valor_unite</td>
	  <td>R$ $total_item</td>
	  <td>$sqlpedido_data</td>
	  <td><form action=\"".$PHP_SELF."\" onsubmit=\"return false;\">
	  		<select name=\"selectName\" onchange=\"goto_URL(this.form.selectName)\">
	  			$data_swifth			
		   </select>
		   </form>
	  
	  </td>
	  <td>
	  <span class=\"bloco_123	\">
	  <a href=\"shop.php?artigo=$sqlpedido_artigo\" >
	  <img src=\"img/info.png\" title=\"Ver produto na Loja\" /></a>
	  <a href=\"?excluirartigos&artigo=$sqlpedido_artigo&pedido=$p_pedido&data=$sqlpedido_datax&loja=$car_loja\">
	  <img src=\"img/excluir.png\" title=\"Excluir Artigo do pedido\"/></a></span> 
	  </td>
	</tr>";	
	$data_swifth = "";
	$tudo = "";}
	
	echo "
	</table>
	</div>";
}
?>
</div>	
</div><!-- End demo -->
<div id="caixa_cars">
<?php

if($e_represetante == "18") {$valor_minimo = 2500;} else {$valor_minimo = $bd_minimo;}
	
$somar_total_pedido = mysqli_query($con, "SELECT SUM(total) as soma FROM  `lista_artigo_pedido_ss16`  WHERE  `npedido` = '$p_pedido'") or die(mysql_error());
while($linha_array_ee = mysqli_fetch_array($somar_total_pedido)){$linha_ee = $linha_array_ee["soma"];}
	
$atua_total_pedido = mysqli_query($con, "UPDATE `$banco`.`pedido_ss16` SET `total` = '$linha_ee'  WHERE  `npedido` = '$p_pedido'"); 
if($linha_ee <= $valor_minimo) { $condicao = "menor";												
							$ver_total = "<b class=\"$condicao\">Total do Pedido Nº $p_pedido R$ ".$linha_ee =  number_format($linha_ee, 2, ',', '.') ."</b>
							<br /> Somente será aceito pedido com valor mínimo de R$ $valor_minimo,00<br />
									<a href=\"dispo.php\"> Voltar a loja e continuar a comprar</a>";} 
					else {
						$condicao = "maior";
						$ver_total = "<b class=\"$condicao\">Total do Pedido Nº $p_pedido R$ ".$linha_ee =  number_format($linha_ee, 2, ',', '.') ."</b><br /><br />
						<a href=\"?fecharPedidos\" class=\"finalizar\" name=\"vertotal\">Enviar pedido</a>  <a href=\"dispo.php\" class=\"finalizar\"> Voltar a loja e continuar a comprar</a> ";}
?>
<tr><td colspan="9" align="center" style="height:40px;"><?php echo $ver_total;?></td></tr>
</tbody>	
	
</div>
<div id="detal">
<p class="titulo">Informações detalhadas/Mensal</p>
<br />
<?php
$del_query = mysqli_query($con, "SELECT DISTINCT `loja` FROM `$banco`.`lista_artigo_pedido_ss16` WHERE `npedido` = '$p_pedido'")or die(mysql_error());
while($array_del = mysqli_fetch_array($del_query)){
	$linha_ee = $array_del["loja"];
	
		
	$del_name = mysqli_query($con, "SELECT * FROM `$banco`.`login` WHERE `B` = '$linha_ee'")or die(mysql_error());
while($array_name = mysqli_fetch_array($del_name)){
	$linha_eee = $array_name["loja"];
	$linha_ref = $array_name["cod_referencia"];
}
if(strlen($linha_eee) > 15){
$linha_eee = substr($linha_eee, 0, 15) . "...";
}
	
	
	
	echo "<div id=\"del_meses\">$linha_ee - ".$linha_eee." | $linha_ref<br />";
$query_mes06 = mysqli_query($con, "SELECT SUM(total) FROM `$banco`.`lista_artigo_pedido_ss16` 
WHERE `npedido` = '$p_pedido' AND MONTH(data) = '12' AND `loja` = '$linha_ee'" )or die(mysql_error());
	while($row = mysqli_fetch_array($query_mes06)){
		$row06          =  number_format($row['SUM(total)'], 2, ',', '.');
	echo "Total mês 12 = R$ ". $row06;
	echo "<br />";
}
$query_mes07 = mysqli_query($con, "SELECT SUM(total) FROM `$banco`.`lista_artigo_pedido_ss16` 
WHERE `npedido` = '$p_pedido' AND MONTH(data) = '01' AND `loja` = '$linha_ee'" )or die(mysql_error());
	while($row = mysqli_fetch_array($query_mes07)){
		$row07          =  number_format($row['SUM(total)'], 2, ',', '.');
	echo "Total mês 01 = R$ ". $row07;
	echo "<br />";
}
$query_mes08 = mysqli_query($con, "SELECT SUM(total) FROM `$banco`.`lista_artigo_pedido_ss16` 
WHERE `npedido` = '$p_pedido' AND MONTH(data) = '02' AND `loja` = '$linha_ee'" )or die(mysql_error());
	while($row = mysqli_fetch_array($query_mes08)){
	$row08          =  number_format($row['SUM(total)'], 2, ',', '.');
	echo "Total mês 02 = R$ ". $row08;
	echo "<br />";
}
$query_mes09 = mysqli_query($con, "SELECT SUM(total) FROM `$banco`.`lista_artigo_pedido_ss16` 
WHERE `npedido` = '$p_pedido' AND MONTH(data) = '03' AND `loja` = '$linha_ee'" )or die(mysql_error());
	while($row = mysqli_fetch_array($query_mes09)){
	$row09          =  number_format($row['SUM(total)'], 2, ',', '.');
	echo "Total mês 03 = R$ ". $row09;
	echo "<br />";
}
$query_mes010 = mysqli_query($con, "SELECT SUM(total) FROM `$banco`.`lista_artigo_pedido_ss16` 
WHERE `npedido` = '$p_pedido' AND MONTH(data) = '04' AND `loja` = '$linha_ee'" )or die(mysql_error());
	while($row = mysqli_fetch_array($query_mes010)){
    $row10          =  number_format($row['SUM(total)'], 2, ',', '.');
	echo "Total mês 04 = R$ ". $row10;
	echo "<br />";
}
$query_mes011 = mysqli_query($con, "SELECT SUM(total) FROM `$banco`.`lista_artigo_pedido_ss16` 
WHERE `npedido` = '$p_pedido' AND MONTH(data) = '05' AND `loja` = '$linha_ee'" )or die(mysql_error());
	while($row = mysqli_fetch_array($query_mes011)){
    $row11          =  number_format($row['SUM(total)'], 2, ',', '.');
	echo "Total mês 05 = R$ ". $row11;
	echo "<br />";
}
$query_mes012 = mysqli_query($con, "SELECT SUM(total) FROM `$banco`.`lista_artigo_pedido_ss16` 
WHERE `npedido` = '$p_pedido' AND MONTH(data) = '06' AND `loja` = '$linha_ee'" )or die(mysql_error());
	while($row = mysqli_fetch_array($query_mes012)){
    $row12          =  number_format($row['SUM(total)'], 2, ',', '.');
	echo "Total mês 06 = R$ ". $row12;
	echo "";
}
	echo "</div>";
	
	}
?>
</div>
<div id="detale">
<p class="titulo">Informações detalhadas/Divisão</p>
<br />
<?php
$del_query = mysqli_query($con, "SELECT DISTINCT `Divisao` FROM `$banco`.`lista_artigo_pedido_ss16` WHERE `npedido` = '$p_pedido'")or die(mysql_error());
while($array_div = mysqli_fetch_array($del_query)){
	$linha_iii= $array_div["Divisao"];
		
	echo "<div id=\"#\">$linha_iii = ";
$query_divisao07 = mysqli_query($con, "SELECT SUM(total) FROM `$banco`.`lista_artigo_pedido_ss16` 
WHERE `npedido` = '$p_pedido' AND `Divisao` = '$linha_iii'" )or die(mysql_error());
while($ro = mysqli_fetch_array($query_divisao07)){
}
$query_divisao24 = mysqli_query($con, "SELECT SUM(quantidade) FROM `$banco`.`lista_artigo_pedido_ss16` 
WHERE `npedido` = '$p_pedido' AND `Divisao` = '$linha_iii'" )or die(mysql_error());
	while($rooo = mysqli_fetch_array($query_divisao24)){
		$roooo = $rooo['SUM(quantidade)'];
		
		$ro07          =  number_format($ro['SUM(total)'], 2, ',', '.');
	echo " R$ ". $ro07. " /Quantidade = ".$roooo;
	echo "<br />";
}
	echo "</div>";
	
	
	
	
	
	}
?>
</div>
<div id="detale" >
<p class="titulo">Informações detalhadas/Categoria</p>
<br />
<?php
$del_query = mysqli_query($con, "SELECT DISTINCT `categoria` FROM `$banco`.`lista_artigo_pedido_ss16` WHERE `npedido` = '$p_pedido'")or die(mysql_error());
while($array_del = mysqli_fetch_array($del_query)){
	$linha_eee = $array_del["categoria"];
	
		
	$del_name = mysqli_query($con, "SELECT * FROM `$banco`.`login` WHERE `B` = '$linha_eee'")or die(mysql_error());
while($array_name = mysqli_fetch_array($del_name)){
	$linha_eeee = $array_name["loja"];
	$linha_ref = $array_name["cod_referencia"];
}
	
	
	
	echo "<div id=\"#\">$linha_eee = ";
$query_categoria07 = mysqli_query($con, "SELECT SUM(total) FROM `$banco`.`lista_artigo_pedido_ss16` 
WHERE `npedido` = '$p_pedido' AND `categoria` = '$linha_eee'" )or die(mysql_error());
	while($roww = mysqli_fetch_array($query_categoria07)){
		$query_divisao25 = mysqli_query($con, "SELECT SUM(quantidade) FROM `$banco`.`lista_artigo_pedido_ss16` 
WHERE `npedido` = '$p_pedido' AND `categoria` = '$linha_eee'" )or die(mysql_error());
	while($roox = mysqli_fetch_array($query_divisao25)){
		$rooox = $roox['SUM(quantidade)'];
	}
		$roww07          =  number_format($roww['SUM(total)'], 2, ',', '.');
	echo " R$ ". $roww07." /Quantidade = ".$rooox;
	echo "<br />";
}
	echo "</div>";
	
	
	
	
	
	}
?>
</div>
</div>
<a href="../../xls/xls_pedido_ss16.php?npedido=<?php echo $p_pedido;?>&style=3&tipo=SS14" title="Download"><div id="campo_dow">Cópia do pedido</div></a>
<div id="bt_nlista"><?php echo $p_car;?></div>
</div>
</div>

</body>
</html>