<?php
session_start();
include"../conexao.php";
include"sql_prevenda/pedreativo.php";
$s_artigo = $_GET["artigo"];
$artigo =   $_GET["artigo"];
$search =   $_GET["search"];
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="m2br.dialog.css" />
<script type="text/javascript" src="../jquery.js"></script>
<script type="text/javascript" src="javascript.js"></script>
<script type="text/javascript" src="money.js"></script>
<script src="m2br.dialog.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.m2brdialog-pergunta').m2brDialog({
        tipo: 		'pergunta',
        titulo:		'Confirme',
        texto:		'Tem certeza que deseja excluir todos os produtos do carrinho ? ',
        draggable: true,
        botoes: {
            1: {
                label: 'confirmar',
                tipo: 'link',
                endereco: '?limpa&pedido=<?php echo $p_pedido;?>'
            },
            2: {
                label: 'cancelar',
                tipo: 'fechar'
            }
        }
    });	
});  
</script>	

<script type="text/javascript">
$(document).ready(function(){
    $('.m2brdialogpedido').m2brDialog({
        tipo: 		'pergunta',
        titulo:		'Confirme',
        texto:		'Tem certeza que deseja excluir o pedido?',
        draggable: true,
        botoes: {
            1: {
                label: 'confirmar',
                tipo: 'link',
                endereco: 'www.adisul.com'
            },
            2: {
                label: 'cancelar',
                tipo: 'fechar'
            }
        }
    });	
});  

$(function () {
  $('.bubbleInfo').each(function () {
    // options
    var distance = 10;
    var time = 250;
    var hideDelay = 500;

    var hideDelayTimer = null;

    // tracker
    var beingShown = false;
    var shown = false;
    
    var trigger = $('.trigger', this);
    var popup = $('.popup', this).css('opacity', 0);

    // set the mouseover and mouseout on both element
    $([trigger.get(0), popup.get(0)]).mouseover(function () {
      // stops the hide event if we move from the trigger to the popup element
      if (hideDelayTimer) clearTimeout(hideDelayTimer);

      // don't trigger the animation again if we're being shown, or already visible
      if (beingShown || shown) {
        return;
      } else {
        beingShown = true;

        // reset position of popup box
        popup.css({
          top: -100,
          left: -33,
          display: 'block' // brings the popup back in to view
        })

        // (we're using chaining on the popup) now animate it's opacity and position
        .animate({
          top: '-=' + distance + 'px',
          opacity: 1
        }, time, 'swing', function() {
          // once the animation is complete, set the tracker variables
          beingShown = false;
          shown = true;
        });
      }
    }).mouseout(function () {
      // reset the timer if we get fired again - avoids double animations
      if (hideDelayTimer) clearTimeout(hideDelayTimer);
      
      // store the timer so that it can be cleared in the mouseover if required
      hideDelayTimer = setTimeout(function () {
        hideDelayTimer = null;
        popup.animate({
          top: '-=' + distance + 'px',
          opacity: 0
        }, time, 'swing', function () {
          // once the animate is complete, set the tracker variables
          shown = false;
          // hide the popup entirely after the effect (opacity alone doesn't do the job)
          popup.css('display', 'none');
        });
      }, hideDelay);
    });
  });
});


function calcValor(){
  // zerando total
  document.getElementById("total").value = '0';
  document.getElementById("desc01").value = '0';
  
  // valor líquido
  var VTOTALLIQUIDO = parseFloat(document.getElementById("valor1").value);
  // desconto 1 - porcentagem
  var DESCONTO1 = parseFloat(document.getElementById("desconto1").value);
  var PDESCONTO = parseFloat(100 - DESCONTO1);
  var PDESCONTO = '0.' + PDESCONTO;

  // desconto 2 - valor
  var VDESCONTO = parseFloat(document.getElementById("desconto2").value);
  var EDESCONTO = parseFloat(100 - VDESCONTO);
  var EDESCONTO = '0.' + EDESCONTO;
 
  var TOTAL = parseFloat(VTOTALLIQUIDO) * parseFloat(PDESCONTO);
  var TOTAL = parseFloat(TOTAL) * parseFloat(EDESCONTO);
  
  
  var desc01   = parseFloat(document.getElementById("desc11").value);
  var desc01_1 = parseFloat(desc01) * parseFloat(PDESCONTO);
  var desc01_1 = parseFloat(desc01_1) * parseFloat(EDESCONTO);
  
  var desc02   = parseFloat(document.getElementById("desc22").value);
  var desc02_2 = parseFloat(desc02) * parseFloat(PDESCONTO);
  var desc02_2 = parseFloat(desc02_2) * parseFloat(EDESCONTO);
  
  var desc03   = parseFloat(document.getElementById("desc33").value);
  var desc03_3 = parseFloat(desc03) * parseFloat(PDESCONTO);
  var desc03_3 = parseFloat(desc03_3) * parseFloat(EDESCONTO);
  
  var desc04   = parseFloat(document.getElementById("desc44").value);
  var desc04_4 = parseFloat(desc04) * parseFloat(PDESCONTO);
  var desc04_4 = parseFloat(desc04_4) * parseFloat(EDESCONTO);
  
  var desc05   = parseFloat(document.getElementById("desc55").value);
  var desc05_5 = parseFloat(desc05) * parseFloat(PDESCONTO);
  var desc05_5 = parseFloat(desc05_5) * parseFloat(EDESCONTO);
  
  var desc06   = parseFloat(document.getElementById("desc66").value);
  var desc06_6 = parseFloat(desc06) * parseFloat(PDESCONTO);
  var desc06_6 = parseFloat(desc06_6) * parseFloat(EDESCONTO);
  
  var desc07   = parseFloat(document.getElementById("desc77").value);
  var desc07_7 = parseFloat(desc07) * parseFloat(PDESCONTO);
  var desc07_7 = parseFloat(desc07_7) * parseFloat(EDESCONTO);
 
  //document.getElementById("h1").value = 'R$ ' + PDESCONTO.toFixed(2);
  //document.getElementById("h2").value = 'R$ ' + VDESCONTO.toFixed(2);
 
  document.getElementById("total").value =  TOTAL.toFixed(2);
  document.getElementById("desc01").value =  desc01_1.toFixed(2);
  document.getElementById("desc02").value =  desc02_2.toFixed(2);
  document.getElementById("desc03").value =  desc03_3.toFixed(2);
  document.getElementById("desc04").value =  desc04_4.toFixed(2);
  document.getElementById("desc05").value =  desc05_5.toFixed(2);
  document.getElementById("desc06").value =  desc06_6.toFixed(2);
  document.getElementById("desc07").value =  desc07_7.toFixed(2);
}	

jQuery(function () {
  $('input.money').priceFormat({ centsSeparator: ',', thousandsSeparator: '.' });         
 
            $('#total').priceFormat({
                prefix: 'R$ ',
                centsSeparator: ',',
                thousandsSeparator: '.'
            });
			
			$('#desc01').priceFormat({
                prefix: 'R$ ',
                centsSeparator: ',',
                thousandsSeparator: '.'
            });
			
	
 
           
        });
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pré Venda</title>
<style type="text/css">
@import url("estilo_car.css");
</style>
</head>
<body>
<div id="painel_botton"><span class="email"><?php echo $rodape_fixo; ?></span></div>
<a name="topo"></a>
<div class="global-div">
<h1><a href="#topo"><img src="../images/header.png" /></a>Pré venda FW12 Jul - Dez</h1>
<br />
<br />
<a href="index.php" title="Voltar a Loja" class="link3"><<< Voltar</a>  <a href="#" class="m2brdialog-pergunta"> Remover todos os produtos do Carrinho</a>
<br />
<br />
<h3>Seu Carrinho está divido em meses , assim se torna mais fácil fazer a distribuição e entrega de seus produtos ao longo do ano.</h3><br />
<ul class="abas">
    <li><a href="#noticia1">Junho 2012</a></li>
    <li><a href="#noticia2">Julho 2012</a></li>
    <li><a href="#noticia3">Agosto 2012</a></li>
    <li><a href="#noticia4">Setembro 2012</a></li>
    <li><a href="#noticia5">Outubro 2012</a></li>
    <li><a href="#noticia6">Novembro 2012</a></li>
    <li><a href="#noticia7">Dezembro 2012</a></li>
    <li style="background:#F90;"><a href="#noticia8">Totalizar Pedido</a></li>
</ul>
<div id="noticia"></div>
<div id="conteudo">
    <div id="noticia1">
    <h2>Junho 2012</h2>
    <p align="center">
<table class="car_table"> 
<thead> 
  <tr>
    <th></th><th>Artigo</th><th>Descrição</th><th>Quantidade</th><th>Valor Unitário</th><th>Valor Total</th><th>Data</th><th></th></tr>
</thead>
<tbody>
<?php
#----------------------Soma Pedido---------------------------
$query_total_pe = mysql_query("SELECT SUM(total) as soma FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido'") or die(mysql_error());
while($linha_array_pe = mysql_fetch_array($query_total_pe)){$linha_pe = $linha_array_pe["soma"];
$linha_pe          = $linha_pe * $sul;
$total_pedido      = $linha_pe;
	}
#------------------------------------------------------------
$query_pedido_aberto = mysql_query("SELECT DISTINCT artigo, data FROM  lista_artigo_pedido_fw12  WHERE npedido = '$p_pedido' AND `data` BETWEEN '2012-06-01' AND '2012-06-31'") or die(mysql_error());	
	$lin = mysql_num_rows($query_pedido_aberto);
    if($lin==0) // verifica se retornou algum registro
    {
		
    echo "<center class=\"car_vazio\">Mês Vazio</center>";     }	
    while($array_pedido_aberto = mysql_fetch_array($query_pedido_aberto)){		
    $sqlpedido_artigo      = $array_pedido_aberto["artigo"];
    $sqlpedido_data        = $array_pedido_aberto["data"];
	$sqlpedido_datax       = $array_pedido_aberto["data"];
#------conta a quantidade de produtos------------------------
$query_total = mysql_query("SELECT SUM(quantidade) as soma FROM  lista_artigo_pedido_fw12  WHERE `artigo` = '$sqlpedido_artigo' AND `npedido` = '$p_pedido' AND `data` = '$sqlpedido_data'") or die(mysql_error());
while($linha_array = mysql_fetch_array($query_total)){$linha = $linha_array["soma"];}
#------------------------------------------------------------

#----------------------Soma Pedido---------------------------
$query_total_pe_mes = mysql_query("SELECT SUM(total) as soma FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido' AND `data` BETWEEN '2012-06-01' AND '2012-06-31'") or die(mysql_error());
while($linha_array_pe_mes = mysql_fetch_array($query_total_pe_mes)){$linha_pe_mes = $linha_array_pe_mes["soma"];}
#------------------------------------------------------------
#----------------------Recolhendo Informações-----------------
$query_total_info = mysql_query("SELECT * FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido' AND `artigo` = '$sqlpedido_artigo'") or die(mysql_error());
while($linha_array_info = mysql_fetch_array($query_total_info)){$info_valor_unite = $linha_array_info["valor"];$info_descricao_unite = $linha_array_info["descricao"];$sqlpedido_total = $linha_array_info["valor"];}
#------------------------------------------------------------
#-----------Tratanto valores e fazendo conta -------------------  	
	$sqlpedido_data    = date('d/m/Y', strtotime(str_replace("-", "/", $sqlpedido_data )));
	$info_valor_unitex = number_format($info_valor_unite, 2, ',', '.');
	$total_item        = $sqlpedido_total * $linha;	
	$total_item        = $total_item * $sul;	
	$total_mes         = $linha_pe_mes * $sul;
	$total_item        =  number_format($total_item, 2, ',', '.');	
	$info_valor_unite  = str_replace(",", ".", $info_valor_unite);	
	$info_valor_unite  = $info_valor_unite * $sul;	
	$info_valor_unite  =  number_format($info_valor_unite, 2, ',', '.');
	$linha_pe          =  number_format($linha_pe, 2, ',', '.');
	$total_mes_jun     = $total_mes;
	$total_mes         =  number_format($total_mes, 2, ',', '.');	
#------------------------------------------------------------------	
	echo "<tr><td><img src=\"http://adisul.com/thumb/".$sqlpedido_artigo."_F.jpg\" width=\"60px\" class=\"estilo_img\" /></td><td>$sqlpedido_artigo</td><td>$info_descricao_unite</td><td>$linha</td><td>R$ $info_valor_unite</td><td>R$ $total_item</td><td>$sqlpedido_data</td><td><a href=\"shop.php?artigo=$sqlpedido_artigo\" >Info</a> | <a href=\"?excluirartigos&artigo=$sqlpedido_artigo&pedido=$p_pedido&data=$sqlpedido_datax\">Excluir</a></td></tr>";	
	}

if($total_pedido <= 1000) { $condicao = "menor";												
							$ver_total = "<b class=\"$condicao\">Total do mês $total_mes | Total do Pedido Nº $p_pedido R$ ".number_format($total_pedido, 2, ',', '.') ."</b>
							<br /> Somente será aceito pedido com valor mínimo de R$ 1.000,00<br />
									<a href=\"index.php\"> Voltar a loja e continuar a comprar</a>";} 
					else {
						$condicao = "maior";
						$ver_total = "<b class=\"$condicao\">Total do mês $total_mes | Total do Pedido Nº $p_pedido R$ ".number_format($total_pedido, 2, ',', '.') ." | <a href=\"#topo\">Topo da Página</a></b><br /><br />
						";$total_mes = "0";}
?>
<tr><td colspan="9" align="center" style="height:40px;"><?php echo $ver_total;?> </td></tr>
</tbody>
</table>
    
    </p>
    </div>    
    <div id="noticia2">
    <h2>Julho 2012</h2>
    <p>
<table class="car_table"> 
<thead> 
  <tr>
    <th></th><th>Artigo</th><th>Descrição</th><th>Quantidade</th><th>Valor Unitário</th><th>Valor Total</th><th>Data</th><th></th></tr>
</thead>
<tbody>
<?php

#------------------------------------------------------------
$query_pedido_aberto = mysql_query("SELECT DISTINCT artigo, data FROM  lista_artigo_pedido_fw12  WHERE npedido = '$p_pedido' AND `data` BETWEEN '2012-07-01' AND '2012-07-31'") or die(mysql_error());	
	$lin = mysql_num_rows($query_pedido_aberto);
    if($lin==0) // verifica se retornou algum registro
    {
		
    echo "<center class=\"car_vazio\">Mês Vazio</center>";     }	
    while($array_pedido_aberto = mysql_fetch_array($query_pedido_aberto)){		
    $sqlpedido_artigo      = $array_pedido_aberto["artigo"];
    $sqlpedido_data        = $array_pedido_aberto["data"];
	$sqlpedido_datax       = $array_pedido_aberto["data"];
#------conta a quantidade de produtos------------------------
$query_total = mysql_query("SELECT SUM(quantidade) as soma FROM  lista_artigo_pedido_fw12  WHERE `artigo` = '$sqlpedido_artigo' AND `npedido` = '$p_pedido' AND `data` = '$sqlpedido_data'") or die(mysql_error());
while($linha_array = mysql_fetch_array($query_total)){$linha = $linha_array["soma"];}
#------------------------------------------------------------

#----------------------Soma Pedido---------------------------
$query_total_pe_mes = mysql_query("SELECT SUM(total) as soma FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido' AND `data` BETWEEN '2012-07-01' AND '2012-07-31'") or die(mysql_error());
while($linha_array_pe_mes = mysql_fetch_array($query_total_pe_mes)){$linha_pe_mes = $linha_array_pe_mes["soma"];}
#------------------------------------------------------------
#----------------------Recolhendo Informações-----------------
$query_total_info = mysql_query("SELECT * FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido' AND `artigo` = '$sqlpedido_artigo'") or die(mysql_error());
while($linha_array_info = mysql_fetch_array($query_total_info)){$info_valor_unite = $linha_array_info["valor"];$info_descricao_unite = $linha_array_info["descricao"];$sqlpedido_total = $linha_array_info["valor"];}
#------------------------------------------------------------
#-----------Tratanto valores e fazendo conta -------------------  	
	$sqlpedido_data    = date('d/m/Y', strtotime(str_replace("-", "/", $sqlpedido_data )));
	$info_valor_unitex = number_format($info_valor_unite, 2, ',', '.');
	$total_item        = $sqlpedido_total * $linha;	
	$total_item        = $total_item * $sul;
	$linha_pe          = $linha_pe * $sul;	
	$total_mes         = $linha_pe_mes * $sul;
	$total_mes_jul     = $total_mes;
	$total_item        =  number_format($total_item, 2, ',', '.');	
	$info_valor_unite  = str_replace(",", ".", $info_valor_unite);	
	$info_valor_unite  = $info_valor_unite * $sul;	
	$info_valor_unite  =  number_format($info_valor_unite, 2, ',', '.');
	$linha_pe          =  number_format($linha_pe, 2, ',', '.');
	$total_mes         =  number_format($total_mes, 2, ',', '.');	
#------------------------------------------------------------------	
	echo "<tr><td><img src=\"http://adisul.com/thumb/".$sqlpedido_artigo."_F.jpg\" width=\"60px\" class=\"estilo_img\" /></td><td>$sqlpedido_artigo</td><td>$info_descricao_unite</td><td>$linha</td><td>R$ $info_valor_unite</td><td>R$ $total_item</td><td>$sqlpedido_data</td><td><a href=\"shop.php?artigo=$sqlpedido_artigo\" >Info</a> | <a href=\"?excluirartigos&artigo=$sqlpedido_artigo&pedido=$p_pedido&data=$sqlpedido_datax\">Excluir</a></td></tr>";	
	}

if($total_pedido <= 1000) { $condicao = "menor";												
							$ver_total = "<b class=\"$condicao\">Total do mês $total_mes | Total do Pedido Nº $p_pedido R$ ".number_format($total_pedido, 2, ',', '.') ."</b>
							<br /> Somente será aceito pedido com valor mínimo de R$ 1.000,00<br />
									<a href=\"index.php\"> Voltar a loja e continuar a comprar</a>";} 
					else {
						$condicao = "maior";
						$ver_total = "<b class=\"$condicao\">Total do mês $total_mes | Total do Pedido Nº $p_pedido R$ ".number_format($total_pedido, 2, ',', '.') ."</b><br /><br />
						";$total_mes = "0";}
?>
<tr><td colspan="9" align="center" style="height:40px;"><?php echo $ver_total;?></td></tr>
</tbody>
</table>
    
    </p></div>      
    <div id="noticia3">
    <h2>Agosto 2012</h2>
    <p>
    <table class="car_table"> 
<thead> 
  <tr>
    <th></th><th>Artigo</th><th>Descrição</th><th>Quantidade</th><th>Valor Unitário</th><th>Valor Total</th><th>Data</th><th></th></tr>
</thead>
<tbody>
<?php

#------------------------------------------------------------
$query_pedido_aberto = mysql_query("SELECT DISTINCT artigo, data FROM  lista_artigo_pedido_fw12  WHERE npedido = '$p_pedido' AND `data` BETWEEN '2012-08-01' AND '2012-08-31'") or die(mysql_error());	
	$lin = mysql_num_rows($query_pedido_aberto);
    if($lin==0) // verifica se retornou algum registro
    {
		
    echo "<center class=\"car_vazio\">Mês Vazio</center>";     }	
    while($array_pedido_aberto = mysql_fetch_array($query_pedido_aberto)){		
    $sqlpedido_artigo      = $array_pedido_aberto["artigo"];
    $sqlpedido_data        = $array_pedido_aberto["data"];
	$sqlpedido_datax       = $array_pedido_aberto["data"];
#------conta a quantidade de produtos------------------------
$query_total = mysql_query("SELECT SUM(quantidade) as soma FROM  lista_artigo_pedido_fw12  WHERE `artigo` = '$sqlpedido_artigo' AND `npedido` = '$p_pedido' AND `data` = '$sqlpedido_data'") or die(mysql_error());
while($linha_array = mysql_fetch_array($query_total)){$linha = $linha_array["soma"];}
#------------------------------------------------------------

#----------------------Soma Pedido---------------------------
$query_total_pe_mes = mysql_query("SELECT SUM(total) as soma FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido' AND `data` BETWEEN '2012-08-01' AND '2012-08-31'") or die(mysql_error());
while($linha_array_pe_mes = mysql_fetch_array($query_total_pe_mes)){$linha_pe_mes = $linha_array_pe_mes["soma"];}
#------------------------------------------------------------
#----------------------Recolhendo Informações-----------------
$query_total_info = mysql_query("SELECT * FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido' AND `artigo` = '$sqlpedido_artigo'") or die(mysql_error());
while($linha_array_info = mysql_fetch_array($query_total_info)){$info_valor_unite = $linha_array_info["valor"];$info_descricao_unite = $linha_array_info["descricao"];$sqlpedido_total = $linha_array_info["valor"];}
#------------------------------------------------------------
#-----------Tratanto valores e fazendo conta -------------------  	
	$sqlpedido_data    = date('d/m/Y', strtotime(str_replace("-", "/", $sqlpedido_data )));
	$info_valor_unitex = number_format($info_valor_unite, 2, ',', '.');
	$total_item        = $sqlpedido_total * $linha;	
	$total_item        = $total_item * $sul;
	$linha_pe          = $linha_pe * $sul;	
	$total_mes         = $linha_pe_mes * $sul;
	$total_mes_ago     = $total_mes;
	$total_item        =  number_format($total_item, 2, ',', '.');	
	$info_valor_unite  = str_replace(",", ".", $info_valor_unite);	
	$info_valor_unite  = $info_valor_unite * $sul;	
	$info_valor_unite  =  number_format($info_valor_unite, 2, ',', '.');
	$linha_pe          =  number_format($linha_pe, 2, ',', '.');
	$total_mes         =  number_format($total_mes, 2, ',', '.');	
#------------------------------------------------------------------	
	echo "<tr><td><img src=\"http://adisul.com/thumb/".$sqlpedido_artigo."_F.jpg\" width=\"60px\" class=\"estilo_img\" /></td><td>$sqlpedido_artigo</td><td>$info_descricao_unite</td><td>$linha</td><td>R$ $info_valor_unite</td><td>R$ $total_item</td><td>$sqlpedido_data</td><td><a href=\"shop.php?artigo=$sqlpedido_artigo\" >Info</a> | <a href=\"?excluirartigos&artigo=$sqlpedido_artigo&pedido=$p_pedido&data=$sqlpedido_datax\">Excluir</a></td></tr>";	
	}

if($total_pedido <= 1000) { $condicao = "menor";												
							$ver_total = "<b class=\"$condicao\">Total do mês $total_mes | Total do Pedido Nº $p_pedido R$ ".number_format($total_pedido, 2, ',', '.') ."</b>
							<br /> Somente será aceito pedido com valor mínimo de R$ 1.000,00<br />
									<a href=\"index.php\"> Voltar a loja e continuar a comprar</a>";} 
					else {
						$condicao = "maior";
						$ver_total = "<b class=\"$condicao\">Total do mês $total_mes | Total do Pedido Nº $p_pedido R$ ".number_format($total_pedido, 2, ',', '.') ."</b><br /><br />
						";$total_mes = "0";}
?>
<tr><td colspan="9" align="center" style="height:40px;"><?php echo $ver_total;?></td></tr>
</tbody>
</table>
    </p></div>    
    <div id="noticia4">
    <h2>Setembro 2012</h2>
    <p>
     <table class="car_table"> 
<thead> 
  <tr>
    <th></th><th>Artigo</th><th>Descrição</th><th>Quantidade</th><th>Valor Unitário</th><th>Valor Total</th><th>Data</th><th></th></tr>
</thead>
<tbody>
<?php

#------------------------------------------------------------
$query_pedido_aberto = mysql_query("SELECT DISTINCT artigo, data FROM  lista_artigo_pedido_fw12  WHERE npedido = '$p_pedido' AND `data` BETWEEN '2012-09-01' AND '2012-09-31'") or die(mysql_error());	
	$lin = mysql_num_rows($query_pedido_aberto);
    if($lin==0) // verifica se retornou algum registro
    {
		
    echo "<center class=\"car_vazio\">Mês Vazio</center>";     }	
    while($array_pedido_aberto = mysql_fetch_array($query_pedido_aberto)){		
    $sqlpedido_artigo      = $array_pedido_aberto["artigo"];
    $sqlpedido_data        = $array_pedido_aberto["data"];
	$sqlpedido_datax       = $array_pedido_aberto["data"];
#------conta a quantidade de produtos------------------------
$query_total = mysql_query("SELECT SUM(quantidade) as soma FROM  lista_artigo_pedido_fw12  WHERE `artigo` = '$sqlpedido_artigo' AND `npedido` = '$p_pedido' AND `data` = '$sqlpedido_data'") or die(mysql_error());
while($linha_array = mysql_fetch_array($query_total)){$linha = $linha_array["soma"];}
#------------------------------------------------------------

#----------------------Soma Pedido---------------------------
$query_total_pe_mes = mysql_query("SELECT SUM(total) as soma FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido' AND `data` BETWEEN '2012-09-01' AND '2012-09-31'") or die(mysql_error());
while($linha_array_pe_mes = mysql_fetch_array($query_total_pe_mes)){$linha_pe_mes = $linha_array_pe_mes["soma"];}
#------------------------------------------------------------
#----------------------Recolhendo Informações-----------------
$query_total_info = mysql_query("SELECT * FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido' AND `artigo` = '$sqlpedido_artigo'") or die(mysql_error());
while($linha_array_info = mysql_fetch_array($query_total_info)){$info_valor_unite = $linha_array_info["valor"];$info_descricao_unite = $linha_array_info["descricao"];$sqlpedido_total = $linha_array_info["valor"];}
#------------------------------------------------------------
#-----------Tratanto valores e fazendo conta -------------------  	
	$sqlpedido_data    = date('d/m/Y', strtotime(str_replace("-", "/", $sqlpedido_data )));
	$info_valor_unitex = number_format($info_valor_unite, 2, ',', '.');
	$total_item        = $sqlpedido_total * $linha;	
	$total_item        = $total_item * $sul;
	$linha_pe          = $linha_pe * $sul;	
	$total_mes         = $linha_pe_mes * $sul;
	$total_mes_set     = $total_mes;
	$total_item        =  number_format($total_item, 2, ',', '.');	
	$info_valor_unite  = str_replace(",", ".", $info_valor_unite);	
	$info_valor_unite  = $info_valor_unite * $sul;	
	$info_valor_unite  =  number_format($info_valor_unite, 2, ',', '.');
	$linha_pe          =  number_format($linha_pe, 2, ',', '.');
	$total_mes         =  number_format($total_mes, 2, ',', '.');	
#------------------------------------------------------------------	
	echo "<tr><td><img src=\"http://adisul.com/thumb/".$sqlpedido_artigo."_F.jpg\" width=\"60px\" class=\"estilo_img\" /></td><td>$sqlpedido_artigo</td><td>$info_descricao_unite</td><td>$linha</td><td>R$ $info_valor_unite</td><td>R$ $total_item</td><td>$sqlpedido_data</td><td><a href=\"shop.php?artigo=$sqlpedido_artigo\" >Info</a> | <a href=\"?excluirartigos&artigo=$sqlpedido_artigo&pedido=$p_pedido&data=$sqlpedido_datax\">Excluir</a></td></tr>";	
	}

if($total_pedido <= 1000) { $condicao = "menor";												
							$ver_total = "<b class=\"$condicao\">Total do mês $total_mes | Total do Pedido Nº $p_pedido R$ ".number_format($total_pedido, 2, ',', '.') ."</b>
							<br /> Somente será aceito pedido com valor mínimo de R$ 1.000,00<br />
									<a href=\"index.php\"> Voltar a loja e continuar a comprar</a>";} 
					else {
						$condicao = "maior";
						$ver_total = "<b class=\"$condicao\">Total do mês $total_mes | Total do Pedido Nº $p_pedido R$ ".number_format($total_pedido, 2, ',', '.') ."</b><br /><br />
						";$total_mes = "0";}
?>
<tr><td colspan="9" align="center" style="height:40px;"><?php echo $ver_total;?></td></tr>
</tbody>
</table>
    </p></div>
   <div id="noticia5">
    <h2>Outubro 2012</h2>
    <p>
     <table class="car_table"> 
<thead> 
  <tr>
    <th></th><th>Artigo</th><th>Descrição</th><th>Quantidade</th><th>Valor Unitário</th><th>Valor Total</th><th>Data</th><th></th></tr>
</thead>
<tbody>
<?php

#------------------------------------------------------------
$query_pedido_aberto = mysql_query("SELECT DISTINCT artigo, data FROM  lista_artigo_pedido_fw12  WHERE npedido = '$p_pedido' AND `data` BETWEEN '2012-10-01' AND '2012-10-31'") or die(mysql_error());	
	$lin = mysql_num_rows($query_pedido_aberto);
    if($lin==0) // verifica se retornou algum registro
    {
		
    echo "<center class=\"car_vazio\">Mês Vazio</center>";     }	
    while($array_pedido_aberto = mysql_fetch_array($query_pedido_aberto)){		
    $sqlpedido_artigo      = $array_pedido_aberto["artigo"];
    $sqlpedido_data        = $array_pedido_aberto["data"];
	$sqlpedido_datax       = $array_pedido_aberto["data"];
#------conta a quantidade de produtos------------------------
$query_total = mysql_query("SELECT SUM(quantidade) as soma FROM  lista_artigo_pedido_fw12  WHERE `artigo` = '$sqlpedido_artigo' AND `npedido` = '$p_pedido' AND `data` = '$sqlpedido_data'") or die(mysql_error());
while($linha_array = mysql_fetch_array($query_total)){$linha = $linha_array["soma"];}
#------------------------------------------------------------

#----------------------Soma Pedido---------------------------
$query_total_pe_mes = mysql_query("SELECT SUM(total) as soma FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido' AND `data` BETWEEN '2012-10-01' AND '2012-10-31'") or die(mysql_error());
while($linha_array_pe_mes = mysql_fetch_array($query_total_pe_mes)){$linha_pe_mes = $linha_array_pe_mes["soma"];}
#------------------------------------------------------------
#----------------------Recolhendo Informações-----------------
$query_total_info = mysql_query("SELECT * FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido' AND `artigo` = '$sqlpedido_artigo'") or die(mysql_error());
while($linha_array_info = mysql_fetch_array($query_total_info)){$info_valor_unite = $linha_array_info["valor"];$info_descricao_unite = $linha_array_info["descricao"];$sqlpedido_total = $linha_array_info["valor"];}
#------------------------------------------------------------
#-----------Tratanto valores e fazendo conta -------------------  	
	$sqlpedido_data    = date('d/m/Y', strtotime(str_replace("-", "/", $sqlpedido_data )));
	$info_valor_unitex = number_format($info_valor_unite, 2, ',', '.');
	$total_item        = $sqlpedido_total * $linha;	
	$total_item        = $total_item * $sul;
	$linha_pe          = $linha_pe * $sul;	
	$total_mes         = $linha_pe_mes * $sul;
	$total_mes_out     = $total_mes;
	$total_item        =  number_format($total_item, 2, ',', '.');	
	$info_valor_unite  = str_replace(",", ".", $info_valor_unite);	
	$info_valor_unite  = $info_valor_unite * $sul;	
	$info_valor_unite  =  number_format($info_valor_unite, 2, ',', '.');
	$linha_pe          =  number_format($linha_pe, 2, ',', '.');
	$total_mes         =  number_format($total_mes, 2, ',', '.');	
#------------------------------------------------------------------	
	echo "<tr><td><img src=\"http://adisul.com/thumb/".$sqlpedido_artigo."_F.jpg\" width=\"60px\" class=\"estilo_img\" /></td><td>$sqlpedido_artigo</td><td>$info_descricao_unite</td><td>$linha</td><td>R$ $info_valor_unite</td><td>R$ $total_item</td><td>$sqlpedido_data</td><td><a href=\"shop.php?artigo=$sqlpedido_artigo\" >Info</a> | <a href=\"?excluirartigos&artigo=$sqlpedido_artigo&pedido=$p_pedido&data=$sqlpedido_datax\">Excluir</a></td></tr>";	
	}

if($total_pedido <= 1000) { $condicao = "menor";												
							$ver_total = "<b class=\"$condicao\">Total do mês $total_mes | Total do Pedido Nº $p_pedido R$ ".number_format($total_pedido, 2, ',', '.') ."</b>
							<br /> Somente será aceito pedido com valor mínimo de R$ 1.000,00<br />
									<a href=\"index.php\"> Voltar a loja e continuar a comprar</a>";} 
					else {
						$condicao = "maior";
						$ver_total = "<b class=\"$condicao\">Total do mês $total_mes | Total do Pedido Nº $p_pedido R$ ".number_format($total_pedido, 2, ',', '.') ."</b><br /><br />
						";$total_mes = "0";}
?>
<tr><td colspan="9" align="center" style="height:40px;"><?php echo $ver_total;?></td></tr>
</tbody>
</table>
    
    </p></div>
    <div id="noticia6">
    <h2>Novembro 2012</h2>
    <p>
     <table class="car_table"> 
<thead> 
  <tr>
    <th></th><th>Artigo</th><th>Descrição</th><th>Quantidade</th><th>Valor Unitário</th><th>Valor Total</th><th>Data</th><th></th></tr>
</thead>
<tbody>
<?php

#------------------------------------------------------------
$query_pedido_aberto = mysql_query("SELECT DISTINCT artigo, data FROM  lista_artigo_pedido_fw12  WHERE npedido = '$p_pedido' AND `data` BETWEEN '2012-11-01' AND '2012-11-31'") or die(mysql_error());	
	$lin = mysql_num_rows($query_pedido_aberto);
    if($lin==0) // verifica se retornou algum registro
    {
		
    echo "<center class=\"car_vazio\">Mês Vazio</center>";     }	
    while($array_pedido_aberto = mysql_fetch_array($query_pedido_aberto)){		
    $sqlpedido_artigo      = $array_pedido_aberto["artigo"];
    $sqlpedido_data        = $array_pedido_aberto["data"];
	$sqlpedido_datax       = $array_pedido_aberto["data"];
#------conta a quantidade de produtos------------------------
$query_total = mysql_query("SELECT SUM(quantidade) as soma FROM  lista_artigo_pedido_fw12  WHERE `artigo` = '$sqlpedido_artigo' AND `npedido` = '$p_pedido' AND `data` = '$sqlpedido_data'") or die(mysql_error());
while($linha_array = mysql_fetch_array($query_total)){$linha = $linha_array["soma"];}
#------------------------------------------------------------

#----------------------Soma Pedido---------------------------
$query_total_pe_mes = mysql_query("SELECT SUM(total) as soma FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido' AND `data` BETWEEN '2012-11-01' AND '2012-11-31'") or die(mysql_error());
while($linha_array_pe_mes = mysql_fetch_array($query_total_pe_mes)){$linha_pe_mes = $linha_array_pe_mes["soma"];}
#------------------------------------------------------------
#----------------------Recolhendo Informações-----------------
$query_total_info = mysql_query("SELECT * FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido' AND `artigo` = '$sqlpedido_artigo'") or die(mysql_error());
while($linha_array_info = mysql_fetch_array($query_total_info)){$info_valor_unite = $linha_array_info["valor"];$info_descricao_unite = $linha_array_info["descricao"];$sqlpedido_total = $linha_array_info["valor"];}
#------------------------------------------------------------
#-----------Tratanto valores e fazendo conta -------------------  	
	$sqlpedido_data    = date('d/m/Y', strtotime(str_replace("-", "/", $sqlpedido_data )));
	$info_valor_unitex = number_format($info_valor_unite, 2, ',', '.');
	$total_item        = $sqlpedido_total * $linha;	
	$total_item        = $total_item * $sul;
	$linha_pe          = $linha_pe * $sul;	
	$total_mes         = $linha_pe_mes * $sul;
	$total_mes_nov     = $total_mes;
	$total_item        =  number_format($total_item, 2, ',', '.');	
	$info_valor_unite  = str_replace(",", ".", $info_valor_unite);	
	$info_valor_unite  = $info_valor_unite * $sul;	
	$info_valor_unite  =  number_format($info_valor_unite, 2, ',', '.');
	$linha_pe          =  number_format($linha_pe, 2, ',', '.');
	$total_mes         =  number_format($total_mes, 2, ',', '.');	
#------------------------------------------------------------------	
	echo "<tr><td><img src=\"http://adisul.com/thumb/".$sqlpedido_artigo."_F.jpg\" width=\"60px\" class=\"estilo_img\" /></td><td>$sqlpedido_artigo</td><td>$info_descricao_unite</td><td>$linha</td><td>R$ $info_valor_unite</td><td>R$ $total_item</td><td>$sqlpedido_data</td><td><a href=\"shop.php?artigo=$sqlpedido_artigo\" >Info</a> | <a href=\"?excluirartigos&artigo=$sqlpedido_artigo&pedido=$p_pedido&data=$sqlpedido_datax\">Excluir</a></td></tr>";	
	}

if($total_pedido <= 1000) { $condicao = "menor";												
							$ver_total = "<b class=\"$condicao\">Total do mês $total_mes | Total do Pedido Nº $p_pedido R$ ".number_format($total_pedido, 2, ',', '.') ."</b>
							<br /> Somente será aceito pedido com valor mínimo de R$ 1.000,00<br />
									<a href=\"index.php\"> Voltar a loja e continuar a comprar</a>";} 
					else {
						$condicao = "maior";
						$ver_total = "<b class=\"$condicao\">Total do mês $total_mes | Total do Pedido Nº $p_pedido R$ ".number_format($total_pedido, 2, ',', '.') ."</b><br /><br />
						";$total_mes = "0";}
?>
<tr><td colspan="9" align="center" style="height:40px;"><?php echo $ver_total;?></td></tr>
</tbody>
</table>
    </p></div>    
     <div id="noticia7">
    <h2>Dezembro 2012</h2>
    <p>
     <table class="car_table"> 
<thead> 
  <tr>
    <th></th><th>Artigo</th><th>Descrição</th><th>Quantidade</th><th>Valor Unitário</th><th>Valor Total</th><th>Data</th><th></th></tr>
</thead>
<tbody>
<?php

#------------------------------------------------------------
$query_pedido_aberto = mysql_query("SELECT DISTINCT artigo, data FROM  lista_artigo_pedido_fw12  WHERE npedido = '$p_pedido' AND `data` BETWEEN '2012-12-01' AND '2012-12-31'") or die(mysql_error());	
	$lin = mysql_num_rows($query_pedido_aberto);
    if($lin==0) // verifica se retornou algum registro
    {
		
    echo "<center class=\"car_vazio\">Mês Vazio</center>";     }	
    while($array_pedido_aberto = mysql_fetch_array($query_pedido_aberto)){		
    $sqlpedido_artigo      = $array_pedido_aberto["artigo"];
    $sqlpedido_data        = $array_pedido_aberto["data"];
	$sqlpedido_datax       = $array_pedido_aberto["data"];
#------conta a quantidade de produtos------------------------
$query_total = mysql_query("SELECT SUM(quantidade) as soma FROM  lista_artigo_pedido_fw12  WHERE `artigo` = '$sqlpedido_artigo' AND `npedido` = '$p_pedido' AND `data` = '$sqlpedido_data'") or die(mysql_error());
while($linha_array = mysql_fetch_array($query_total)){$linha = $linha_array["soma"];}
#------------------------------------------------------------

#----------------------Soma Pedido---------------------------
$query_total_pe_mes = mysql_query("SELECT SUM(total) as soma FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido' AND `data` BETWEEN '2012-12-01' AND '2012-12-31'") or die(mysql_error());
while($linha_array_pe_mes = mysql_fetch_array($query_total_pe_mes)){$linha_pe_mes = $linha_array_pe_mes["soma"];}
#------------------------------------------------------------
#----------------------Recolhendo Informações-----------------
$query_total_info = mysql_query("SELECT * FROM  lista_artigo_pedido_fw12  WHERE  `npedido` = '$p_pedido' AND `artigo` = '$sqlpedido_artigo'") or die(mysql_error());
while($linha_array_info = mysql_fetch_array($query_total_info)){$info_valor_unite = $linha_array_info["valor"];$info_descricao_unite = $linha_array_info["descricao"];$sqlpedido_total = $linha_array_info["valor"];}
#------------------------------------------------------------
#-----------Tratanto valores e fazendo conta -------------------  	
	$sqlpedido_data    = date('d/m/Y', strtotime(str_replace("-", "/", $sqlpedido_data )));
	$info_valor_unitex = number_format($info_valor_unite, 2, ',', '.');
	$total_item        = $sqlpedido_total * $linha;	
	$total_item        = $total_item * $sul;
	$linha_pe          = $linha_pe * $sul;		
	$total_mes         = $linha_pe_mes * $sul;
	$total_mes_dez     = $total_mes;
	$total_item        =  number_format($total_item, 2, ',', '.');	
	$info_valor_unite  = str_replace(",", ".", $info_valor_unite);	
	$info_valor_unite  = $info_valor_unite * $sul;	
	$info_valor_unite  =  number_format($info_valor_unite, 2, ',', '.');
	$linha_pe          =  number_format($linha_pe, 2, ',', '.');
	$total_mes         =  number_format($total_mes, 2, ',', '.');	
#------------------------------------------------------------------	
	echo "<tr><td><img src=\"http://adisul.com/thumb/".$sqlpedido_artigo."_F.jpg\" width=\"60px\" class=\"estilo_img\" /></td><td>$sqlpedido_artigo</td><td>$info_descricao_unite</td><td>$linha</td><td>R$ $info_valor_unite</td><td>R$ $total_item</td><td>$sqlpedido_data</td><td><a href=\"shop.php?artigo=$sqlpedido_artigo\" >Info</a> | <a href=\"?excluirartigos&artigo=$sqlpedido_artigo&pedido=$p_pedido&data=$sqlpedido_datax\">Excluir</a></td></tr>";	
	}
$atua_total_pedido = mysql_query("UPDATE prevendafw12 SET `total` = '$total_pedido'  WHERE  `npedido` = '$p_pedido'");
if($total_pedido <= 1000) { $condicao = "menor";												
							$ver_total = "<b class=\"$condicao\">Total do mês $total_mes | Total do Pedido Nº $p_pedido R$ ".number_format($total_pedido, 2, ',', '.') ."</b>
							<br /> Somente será aceito pedido com valor mínimo de R$ 1.000,00<br />
									<a href=\"index.php\"> Voltar a loja e continuar a comprar</a>";} 
					else {
						$condicao = "maior";
						$ver_total = "<b class=\"$condicao\">Total do mês $total_mes | Total do Pedido Nº $p_pedido R$ ".number_format($total_pedido, 2, ',', '.') ."</b><br /><br />
						";$total_mes = "0";}
?>
<tr><td colspan="9" align="center" style="height:40px; color:#090"><?php echo $ver_total;?></td></tr>
</tbody>
</table>    
    </p></div>   
<div class="bubbleInfo">
  <img class="trigger" src="http://mysite.com/path/to/image.png" />
  <div class="popup">
    <!-- your information content -->
  </div>
</div>
   <div id="noticia8">
 
   
   
   
   <br />
    <h2>Finalizando Pedido Nº <?php echo $p_pedido; ?></h2><br /><br />
    <p>Pedido Elaborado por <i><b><?php echo $nome_cliente_pai;?></b></i> para  <i><b><?php echo $nome_cliente_filho;?></b></i> iniciado às <?php echo $p_hora ;?> no dia <?php echo $p_data ;?>.<br />
	Ao enviar este pedido você estará concordando com os preços e quantidadades solicitadas.<br />
  <div id="bruto"> 
  
  <b>Pedido | Preços Geral \ Brasil</b>
  
  <br />
  <br />

    <?php
	
	    if($total_mes_jun == 0)    {$var_jun = "<img src=\"imagens/ann.png\" title=\"Valor Mínimo por mês é de R$ 1.000,00 \" />"; $cor_jun = "#F00";}
	elseif($total_mes_jun <= 1000) {$var_jun = "<img src=\"imagens/enn.png\" title=\"Valor Mínimo por mês é de R$ 1.000,00\" />"; $cor_jun = "#F00"; }
	else                           {$var_jun = "<img src=\"imagens/inn.png\" title=\"Acima do Mínimo\" />"; $cor_jun = "#000";}
	
	 if($total_mes_jul == 0)    {$var_jul = "<img src=\"imagens/ann.png\" title=\"Valor Mínimo por mês é de R$ 1.000,00\" />";    $cor_jul = "#F00";}
	elseif($total_mes_jul <= 1000) {$var_jul = "<img src=\"imagens/enn.png\" title=\"Valor Mínimo por mês é de R$ 1.000,00\" />"; $cor_jul = "#F00"; }
	else                           {$var_jul = "<img src=\"imagens/inn.png\" title=\"Acima do Mínimo\" />"; $cor_jul = "#000";}
	
	 if($total_mes_ago == 0)    {$var_ago = "<img src=\"imagens/ann.png\" title=\"Valor Mínimo por mês é de R$ 1.000,00\" />";    $cor_ago = "#F00";}
	elseif($total_mes_ago <= 1000) {$var_ago = "<img src=\"imagens/enn.png\" title=\"Valor Mínimo por mês é de R$ 1.000,00\" />"; $cor_ago = "#F00"; }
	else                           {$var_ago = "<img src=\"imagens/inn.png\" title=\"Acima do Mínimo\" />"; $cor_ago = "#000";}
	
	 if($total_mes_set == 0)    {$var_set = "<img src=\"imagens/ann.png\" title=\"Valor Mínimo por mês é de R$ 1.000,00\" />";    $cor_set = "#F00";}
	elseif($total_mes_set <= 1000) {$var_set = "<img src=\"imagens/enn.png\" title=\"Valor Mínimo por mês é de R$ 1.000,00\" />"; $cor_set = "#F00"; }
	else                           {$var_set = "<img src=\"imagens/inn.png\" title=\"Acima do Mínimo\" />"; $cor_set = "#000";}
	
	 if($total_mes_out == 0)    {$var_out = "<img src=\"imagens/ann.png\" title=\"Valor Mínimo por mês é de R$ 1.000,00\" />";    $cor_out = "#F00";}
	elseif($total_mes_out <= 1000) {$var_out = "<img src=\"imagens/enn.png\" title=\"Valor Mínimo por mês é de R$ 1.000,00\" />"; $cor_out = "#F00"; }
	else                           {$var_out = "<img src=\"imagens/inn.png\" title=\"Acima do Mínimo\" />"; $cor_out = "#000";}
	
	 if($total_mes_nov == 0)    {$var_nov = "<img src=\"imagens/ann.png\" title=\"Valor Mínimo por mês é de R$ 1.000,00\" />";    $cor_nov = "#F00";}
	elseif($total_mes_nov <= 1000) {$var_nov = "<img src=\"imagens/enn.png\" title=\"Valor Mínimo por mês é de R$ 1.000,00\" />"; $cor_nov = "#F00"; }
	else                           {$var_nov = "<img src=\"imagens/inn.png\" title=\"Acima do Mínimo\" />"; $cor_nov = "#000";}
	
	 if($total_mes_dez == 0)    {$var_dez = "<img src=\"imagens/ann.png\" title=\"Valor Mínimo por mês é de R$ 1.000,00\" />";    $cor_dez = "#F00";}
	elseif($total_mes_dez <= 1000) {$var_dez = "<img src=\"imagens/enn.png\" title=\"Valor Mínimo por mês é de R$ 1.000,00\" />"; $cor_dez = "#F00"; }
	else                           {$var_dez = "<img src=\"imagens/inn.png\" title=\"Acima do Mínimo\" />"; $cor_dez = "#000";}
	
	$total_mes_junx		    =  $total_mes_jun;
	$total_mes_julx         =  $total_mes_jul;
	$total_mes_agox         =  $total_mes_ago;
	$total_mes_setx         =  $total_mes_set;
	$total_mes_outx         =  $total_mes_out;
	$total_mes_novx         =  $total_mes_nov;
	$total_mes_dezx         =  $total_mes_dez;
	
	
	$total_mes_jun         =  number_format($total_mes_jun, 2, ',', '.');
	$total_mes_jul         =  number_format($total_mes_jul, 2, ',', '.');
	$total_mes_ago         =  number_format($total_mes_ago, 2, ',', '.');
	$total_mes_set         =  number_format($total_mes_set, 2, ',', '.');
	$total_mes_out         =  number_format($total_mes_out, 2, ',', '.');
	$total_mes_nov         =  number_format($total_mes_nov, 2, ',', '.');
	$total_mes_dez         =  number_format($total_mes_dez, 2, ',', '.');
	#$total_pedido          =  number_format($total_pedido, 2, ',', '.');
	
			
	echo "<label class=\"gerall\">Junho</label>     <label class=\"geral\" style=\"color:$cor_jun;\">$var_jun R$ $total_mes_jun </label><br />";
	echo "<label class=\"gerall\">Julho</label>     <label class=\"geral\" style=\"color:$cor_jul;\">$var_jul R$ $total_mes_jul </label><br />";
	echo "<label class=\"gerall\">Agosto</label>    <label class=\"geral\" style=\"color:$cor_ago;\">$var_ago R$ $total_mes_ago </label><br />";
	echo "<label class=\"gerall\">Setembro</label>  <label class=\"geral\" style=\"color:$cor_set;\">$var_set R$ $total_mes_set </label><br />";
	echo "<label class=\"gerall\">Outubro</label>   <label class=\"geral\" style=\"color:$cor_out;\">$var_out R$ $total_mes_out </label><br />";
	echo "<label class=\"gerall\">Novembro</label>  <label class=\"geral\" style=\"color:$cor_nov;\">$var_nov R$ $total_mes_nov </label><br />";
	echo "<label class=\"gerall\">Dezembro</label>  <label class=\"geral\" style=\"color:$cor_dez;\">$var_dez R$ $total_mes_dez </label><br />"; 
	echo "<label class=\"gerall\"><hr/><br /><b>Total</b></label><label class=\"geral\"><hr/><br /><img src=\"imagens/ann.png\" /> R$ <b> ".number_format($total_pedido, 2, ',', '.') ." </b> </label><br />"; 
	
	
	
	?>
<br />
</div>
    <div id="texto_desc">Os descontos tem como referência a pré-venda de SS12 "Jan-Jun".<br />
Os valores da pré-venda FW12 "Jul - Dez" serão computados e confirmados dia 15 de fevereiro quando a pré-venda estará finalizada.</div>
    <div id="texto_desc_esp"><b>Descontos Regionais</b>, <b>Descontos de Pré-Venda</b>, e <b>Prazos Especiais</b> consulte seu <b>Represetante.</b></div>
<br />
<br />

<form action="#" style="font-size:10pt; background-color:#FCC; padding:5px; width:600px; border-radius:6px;"  >
<b>Simulação de Desconto</b><br />
<br />

R$ <?php echo number_format($total_pedido, 2, ',', '.') ;?> - 
<input type="text" value="<?php echo $total_pedido ;?>" name="valor1" id="valor1" style="border:hidden;width:75px;display:none;"  /> ICMS % 
<input type="text"  style="border:inset; width:25px;" name="desconto1" id="desconto1" /> - 
Desconto Pré Venda % <input type="text" style="border:inset; width:25px;" id="desconto2" onblur="calcValor()" />  = 
<input type="text" name="total" id="total" />
<br />
<br />

<?php 
$total_mes_jun_st = str_replace('.', '', $total_mes_jun);
$total_mes_jun_st = str_replace(',', '.', $total_mes_jun_st);

$total_mes_jul_st = str_replace('.', '', $total_mes_jul);
$total_mes_jul_st = str_replace(',', '.', $total_mes_jul_st);

$total_mes_ago_st = str_replace('.', '', $total_mes_ago);
$total_mes_ago_st = str_replace(',', '.', $total_mes_ago_st);

$total_mes_set_st = str_replace('.', '', $total_mes_set);
$total_mes_set_st = str_replace(',', '.', $total_mes_set_st);

$total_mes_out_st = str_replace('.', '', $total_mes_out);
$total_mes_out_st = str_replace(',', '.', $total_mes_out_st);

$total_mes_nov_st = str_replace('.', '', $total_mes_nov);
$total_mes_nov_st = str_replace(',', '.', $total_mes_nov_st);

$total_mes_dez_st = str_replace('.', '', $total_mes_dez);
$total_mes_dez_st = str_replace(',', '.', $total_mes_dez_st);

?>

<label class="gerall">Junho    </label><input type="text" value="<?php echo $total_mes_jun_st;?>" size="10" name="desc11" id="desc11" style="display:none;"  /><input type="text" name="desc01" id="desc01" class="tama"  /><br />
<label class="gerall">Julho    </label><input type="text" value="<?php echo $total_mes_jul_st;?>" size="10" name="desc22" id="desc22" style="display:none;"  /><input type="text" name="desc02" id="desc02" class="tama"  /><br />
<label class="gerall">Agosto   </label><input type="text" value="<?php echo $total_mes_ago_st;?>" size="10" name="desc33" id="desc33" style="display:none;"  /><input type="text" name="desc03" id="desc03" class="tama"  /><br />
<label class="gerall">Setembro </label><input type="text" value="<?php echo $total_mes_set_st;?>" size="10" name="desc44" id="desc44" style="display:none;"  /><input type="text" name="desc04" id="desc04" class="tama"  /><br />
<label class="gerall">Outubro  </label><input type="text" value="<?php echo $total_mes_out_st;?>" size="10" name="desc55" id="desc55" style="display:none;"  /><input type="text" name="desc05" id="desc05" class="tama"  /><br />
<label class="gerall">Novembro </label><input type="text" value="<?php echo $total_mes_nov_st;?>" size="10" name="desc66" id="desc66" style="display:none;"  /><input type="text" name="desc06" id="desc06" class="tama"  /><br />
<label class="gerall">Dezembro </label><input type="text" value="<?php echo $total_mes_dez_st;?>" size="10" name="desc77" id="desc77" style="display:none;"  /><input type="text" name="desc07" id="desc07" class="tama"  /><br />
 

</form>

<span class="menos">*Descontos de Pré vendas não estão calculados.</span>
<br />
<br />
<br />

    <a href="?fecharPedidos" class="link1">Enviar Pedido</a> 
 
   
   
   
   <br /><br />
<br />
<br />

   
   <center><span class="geral">www.adisul.com | adisul@adisul.com</span> </center>

    </p></div>
</div>
</div>
</body>
</html>