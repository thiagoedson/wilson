<?php
session_start();
include'conexao.php';
$excluirUser = $_GET["excluirUser"];


function excluirUser($con) {
	
	$cd_cl = $_GET["id"];
	$ssql = mysqli_query($con,"DELETE FROM `login` WHERE `B` = '$cd_cl'");
	header("Location:home.php");
	
}

if(isset($excluirUser)){
excluirUser($con);
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
<style type="text/css" media="all">
@import url("menu.css");
</style>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<!--<script type="text/javascript" src="menu.js"></script>-->
<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs a").click(function() {
			$(this).parent().siblings().removeClass('active').end().addClass('active');
			$(this).parents('ul').next().children().hide().eq( $(this).parent().index() ).show();
		});
	});
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

</head>
<body>

<div id="container">
<?php echo $menu_adi;?>
<div id="totalconta">
<ul class="tabs vinte">
  <li class="active"><a href="#">Geral</a></li>
  <li><a href="#">Limite</a></li>
  <li><a href="#">Pedidos</a></li>
  <li><a href="#">Acessos/Logs</a></li>
  <li><a href="#">Avançado</a></li>

</ul>

<div class="tab_container">

  <div class="fin">

<table width="600" align="center">  
<?php
$cod_cliente = $_GET["login"];
$query_site = mysqli_query($con,"SELECT * FROM site") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site = mysqli_fetch_assoc($query_site)){	
	$situa = $array_site["situa"];}	
	$situa = date('d/m/Y', strtotime(str_replace("-", "/", $situa )));
$query_site2 = mysqli_query($con,"SELECT * FROM clientes WHERE `Codigo Cliente` = '$cod_cliente'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site2 = mysqli_fetch_assoc($query_site2)){	
	$adidas_cliente  = $array_site2["Cliente"];
	$adidas_grupo    = $array_site2["Descricao do Grupo"];
	$adidas_cnpj     = $array_site2["CNPJ"];
	$adidas_status   = $array_site2["Status do Credito"];	
}

?>
<h1 class="titil">Perfil do Cliente <?php echo $cod_cliente;?></h1><br />

<form action="atua_perfil_sql.php?cod_adidas=<?php echo $cod_cliente;?>" method="post">
<?php
$query_site3 = mysqli_query($con,"SELECT * FROM login WHERE `B` = '$cod_cliente'") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site3 = mysqli_fetch_assoc($query_site3)){	
	$adisul_cliente  = $array_site3["comprador"];
	$adisul_grupo    = $array_site3["nome"];
	$adisul_usuario  = $array_site3["C"];
	$adisul_senha    = $array_site3["D"];
	$adisul_codadi   = $array_site3["B"];
	$adisul_email    = $array_site3["email"];
	$adisul_cel1     = $array_site3["celular1"];
	$adisul_cel2     = $array_site3["celular2"];
	$adisul_tel1     = $array_site3["telefone"];
	$adisul_status   = $array_site3["status"];
	$adisul_segmento_1   = $array_site3["segmento_1"];
	$adisul_segmento_2   = $array_site3["segmento_2"];
	$adisul_statusx      = $array_site3["status"];
	$adisul_loja         = $array_site3["loja"];
	$adisul_cod_grupo    = $array_site3["cod_grupo"];
	$adisul_cod_referencia  = $array_site3["cod_referencia"];
	$adisul_cidade          = $array_site3["cidade"];
	$adisul_estado          = $array_site3["UF"];
	$adisul_data            = $array_site3["datanasc"];
	$adisul_min_c           = $array_site3["min_c"];
	$adisul_min_t           = $array_site3["min_t"];
	$adisul_min_e           = $array_site3["min_e"];
	
}
    if ($adisul_status == "1") {$adisul_status = "<b>Acesso Completo | 1 | Master List</b>";}
elseif ($adisul_status == "2") {$adisul_status = "<b style=\"color:blue\">Acesso Limitado &nbsp;&nbsp;&nbsp;  | 2</b>";}
elseif ($adisul_status == "3") {$adisul_status = "<b style=\"color:red\">Acesso Suspensa | 3 | MasterBlack List</b>";}
?>
<tr>
	<td>Código Adidas/Reebok </td>
    <td><input name="cod_adidas" type="text" readonly="readonly" value="<?php echo $adisul_codadi;?>" /><input name="cod_adidas" type="hidden"  value="<?php echo $adisul_codadi;?>" /></td>
</tr>
<tr>
	<td>Razão Social </td>
    <td><input name="loja" type="text" style="text-transform:uppercase;" value="<?php echo $adisul_loja;?>" size="50" /></td>
</tr>
<tr>
	<td>CNPJ "Login" </td>
    <td><input type="text" name="cnpj" maxlength="14"  value="<?php echo $adisul_usuario;?>"/></td>
</tr>
<tr>
	<td>Senha </td>
    <td><input type="text" name="senha" value="<?php echo $adisul_senha;?>" /></td>
</tr>
<tr>
	<td>Grupo no Site </td>
    <td><input type="text" name="grupodosite" style="text-transform:uppercase;" value="<?php echo $adisul_grupo;?>"  /></td>
</tr>
<tr>
	<td>Contato </td>
    <td><input name="comprador" type="text" value="<?php echo $adisul_cliente;?>" size="50" /></td>
</tr>
<tr>
	<td>Código do Grupo  </td>
    <td><input type="text" name="cod_grupo" value="<?php echo $adisul_cod_grupo;?>" /></td>
</tr>
<tr>
	<td>Identificação da loja no site <b>(NOVO!)</b> </td>
    <td><input name="cod_referencia" type="text" value="<?php echo $adisul_cod_referencia;?>" maxlength="10" /></td>
</tr>
<tr>
	<td>Estado Atual <b><?php echo $adisul_estado;?></b></td>
    <td><select id="estado" name="cod_estados"></select></td>
</tr>
<tr>
	<td>Cidade  atual <b><?php echo $adisul_cidade;?> </b></td>
	<td><select id="cidade" name="cod_cidades"></select></td>
</tr>
<tr>
	<td>Celular 1  </td>
    <td><input type="tel" name="celular1" id="campoTelefone" value="<?php echo $adisul_cel1;?>" maxlength="14"></td>
</tr>
<tr>
	<td>Celular 2  </td>
    <td><input type="tel" name="celular2" id="campoTelefone1" value="<?php echo $adisul_cel2;?>" maxlength="14"></td>
</tr>
<tr>
	<td>Telefone  </td>
    <td><input type="tel" name="telefone" id="campoTelefone2" value="<?php echo $adisul_tel1;?>" maxlength="14"></td>
</tr>
<tr>
	<td>E-mail  </td>
    <td><input type="email" name="email" value="<?php echo $adisul_email;?>" size="50"/></td>
</tr>
<tr>
	<td>Tipo de Conta </td>
    <td><select name="status" >
  <option value="1" <?php if($adisul_statusx == "1") {echo "selected=\"selected\" ";} ?>>Acesso Completo | 1</option>
  <option value="2" <?php if($adisul_statusx == "2") {echo "selected=\"selected\" ";} ?>>Acesso Individual | 2</option>
  <option value="3" <?php if($adisul_statusx == "3") {echo "selected=\"selected\" ";} ?>>Acesso Suspenso | 3</option>
</select></td>
</tr>
<tr>
	<td>Data de Nascimento do Contato </td>
    <td><input type="date" class="input" name="data" onKeyUp="formata(this);" maxlength="10" size="12" value="<?php echo $adisul_data;?>"></td>
</tr>
<tr>
	<td>Segmentação Antiga  </td>
    <td><input type="text" name="segmento_1" /></td>
</tr>
<tr>
	<td>Segmentação atual </td>
    <td><select name="segmento_2">
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
	<option value="C11" <?php if($adisul_segmento_2 == "C11"){echo "selected=\"selected\" ";}?> >C11 - ********</option>
	<option value="C12" <?php if($adisul_segmento_2 == "C12"){echo "selected=\"selected\" ";}?> >C12 - ********</option>
	<option value="C13" <?php if($adisul_segmento_2 == "C13"){echo "selected=\"selected\" ";}?> >C13 - CD Sports Directional</option>
</select> 



</td>
<tr>
	<td>Segmentação SAS   </td>
    <td>
    	<?php
			$query_site_sas = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`tcustsegments` WHERE `CustomerNo` = '$cod_cliente'") or die(mysql_error());
			#-----------------------------------------------------------------------------------------------
			while($array_sas = mysqli_fetch_assoc($query_site_sas)){	
			$segment_sas  = $array_sas["Segment"];
			echo "<input type=\"text\" name=\"segmento_1\" value=\"".$segment_sas."\" readonly=\"readonly\" />";
			}

?>
    
    </td>
</tr>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="Atualizar"  class="botao_perfil"/></td>
</tr>
</form>
</fieldset>
<tr>
	<td colspan="2">
    <fieldset style="padding:10px; font-size:8pt; border-width:thin;">
<b>
Acesso Completo<br />
 Tem acesso completo, inclusive a outras lojas do seu grupo |
<br /><br />

Acesso Individual<br />
 Tudo menos o que se refere a informações do grupo e outras lojas |
 <br /><br />

Acesso Suspenso <br />
 Não tem acesso ao adisul.net |
 </b>
    </fieldset>
</td>
</tr>
</table>

<?php 
if($adisul_grupo <> "SEM GRUPO") { ?>
  <div id="group">
    <fieldset style="width:100%;height:100%;padding:10px;">
      <legend style="margin:10px;"> Grupo no site </legend>
      <a href="pesquisa_grupo.php?search=<?php echo $adisul_grupo;?>" title="<?php echo $adisul_grupo;?>" style="color:#0C6;font-weight:bold; font-size:16px;" ><?php echo $adisul_grupo;?></a>
      <br />
      <br />
	

           <?php
           $query_total_grupo = mysqli_query($con,"SELECT * FROM `login` WHERE `nome` = '$adisul_grupo'");
		   $total_grupo = mysqli_num_rows($query_total_grupo);
		   
		   echo "<p style=\"font-size:18px;color:#F90\">Total  ".$total_grupo." usuários.</p>";           
		   ?>
  
    </fieldset>
  </div>
<?php } else {} ?>
 <div id="group2">
    <fieldset style="width:100%;height:100%;padding:10px;">
      <legend style="margin:10px;"> Permissão de Acessos  </legend>
      		
           <?php
		   $query_permission = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`loja_permission`");
		   while($array_permission = mysqli_fetch_assoc($query_permission)){		
	                 $tabela_permission    = $array_permission["tabela"];
					 $descri_permission    = $array_permission["descricao"];
					 $pagina_permission    = $array_permission["pagina"];
		   
           $query_cle = mysqli_query($con,"SELECT * FROM `$banco`.`$tabela_permission` WHERE `cliente` = '$cod_cliente'");
		   $arrax_cle = mysqli_num_rows($query_cle);
		   
		   if($arrax_cle == 0) {echo "$descri_permission :<br /> <span class=\"nlista\">NÃO CONSTA NA LISTA<br />
																						<a href=\"$pagina_permission\" >Adicionar ?</a></span>";}
		   else{
			   while($array_cle = mysqli_fetch_assoc($query_cle)){		
	                 $typt    = $array_cle["typt"];
					     if($typt == "")  { echo "$descri_permission :<br /><span class=\"liberado\">LIBERADO <a href=\"$pagina_permission\" >Remover ?</a></span><br /><br />";}
					 elseif($typt == "1") { echo "$descri_permission :<br /><span class=\"negado\">SEM ACESSO <a href=\"$pagina_permission\" >Liberar ?</a></span> <br /><br />";}
					  else { echo "<span class=\"erro408\"> ERRO 408 <br /> <br />";}
			   }
		   }	
		   }
		   ?>

  
    </fieldset>
  </div>


  </div>
  <div class="fin" style="display:none">
   <p class="titulo_aba">Limite de grade</p>
   <br />
   <br />
   <form action="atua_perfil_sql_grade.php?cod_adidas=<?php echo $cod_cliente;?>" method="post">
   <table>
	<tr>
		<td>Grade miníma para calçado</td>
    	<td><input type="number" name="min_c"  value="<?php echo $adisul_min_c;?>" maxlength="2" size="10"></td>
   	</tr>
    
    <tr>
		<td>Grade miníma para têxtil</td>
    	<td><input type="number" name="min_t"  value="<?php echo $adisul_min_t;?>" maxlength="2"></td>
    </tr>
    <tr>
		<td>Grade miníma para equipamento</td>
    	<td><input type="number" name="min_e"  value="<?php echo $adisul_min_e;?>" maxlength="2"></td>
	</tr>
    <tr>
    	<td colspan="2"><input type="submit" value="Atualizar" style="padding:3px;" /></td>
    
  </table>
  </form>
	<br />

   </div>

  <div class="fin" style="display:none">
  <p class="titulo_aba">Pedidos</p>
   <table align="center">
     <tr>
       <td>Descrição</td><td>Total</td><td>Status</td><td align="right">Quantidade de Pedidos</td>
     </tr>
     <?php
     $query_pedido = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`loja_table` ORDER BY `status`");
     while($array_pedido = mysqli_fetch_assoc($query_pedido)){		
	 $descricao_pedido    = $array_pedido["descricao"];
	 $loja_pedido         = $array_pedido["banco"];
	 $status_pedido       = $array_pedido["status"];
	 $cor = "style=\"color:#F00;\"";
	 
	 if($status_pedido == "2") {$cor = "style=\"color:#090;\""; $status_pedido = "ONLINE";} elseif($status_pedido == "1") {$status_pedido = "OFFLINE";} else {$status_pedido = "ERRO 145";}
	 
	 $query_pedido_total = mysqli_query($con,"SELECT SUM(total) as soma FROM `$loja_pedido` WHERE `cliente` = '$cod_cliente' AND `status` != '5' ");
	 $query_pedido_total_num = mysqli_query($con,"SELECT * FROM `$loja_pedido` WHERE `cliente` = '$cod_cliente'");
	 $lin = mysqli_num_rows($query_pedido_total_num);
     while($array_pedido_total = mysqli_fetch_assoc($query_pedido_total)){		
	 $total_pedido    = $array_pedido_total["soma"];


	 
	 
	 }
	 
	 $total += $total_pedido ;
	 
	 if (preg_match("/promo/", $loja_pedido))        { $total_promo   += $total_pedido;} 
	 if (preg_match("/entrega/", $loja_pedido))      { $total_entrega += $total_pedido;} 
	 
	 $total_pedido          =  number_format($total_pedido, 2, ',', '.');
	 $total_promo_g          =  number_format($total_promo, 2, ',', '.');
	 echo "<tr>
	         <td>$descricao_pedido</td><td>R$ $total_pedido</td><td $cor >$status_pedido </td><td align=\"right\">  $lin</td>
		  </tr>";
	 }
	 
	 
	 
	 ?>
     <tr>
       <td><b>Total</b></td><td colspan="3" ><b>R$ <?php $total    =  number_format($total, 2, ',', '.'); echo $total ;?></b></td>
     </tr>
   
   
   </table>
   <br />
   <!-------------Gráfico --->
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
		 ["Loja", "Total em R$"],
     <?php
     $query_pedido = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`loja_table` ORDER BY `status`");
     while($array_pedido = mysqli_fetch_assoc($query_pedido)){		
	 $descricao_pedido    = $array_pedido["descricao"];
	 $loja_pedido         = $array_pedido["banco"];
	 $status_pedido       = $array_pedido["status"];
	 $cor = "style=\"color:#F00;\"";
	 
	 if($status_pedido == "2") {$cor = "style=\"color:#090;\""; $status_pedido = "ONLINE";} elseif($status_pedido == "1") {$status_pedido = "OFFLINE";} else {$status_pedido = "ERRO 145";}
	 
	 $query_pedido_total = mysqli_query($con,"SELECT SUM(total) as soma FROM `$loja_pedido` WHERE `cliente` = '$cod_cliente' AND `status` != '5'");
	 $query_pedido_total_num = mysqli_query($con,"SELECT * FROM `$loja_pedido` WHERE `cliente` = '$cod_cliente'");
	 $lin = mysqli_num_rows($query_pedido_total_num);
     while($array_pedido_total = mysqli_fetch_assoc($query_pedido_total)){		
	 $total_pedido    = $array_pedido_total["soma"];
	 }
	 
	 $total += $total_pedido ;
	 
	 if($total_pedido == 0 && $total_pedido == "") {$total_pedido = "0";}
	 
	 #if (preg_match("/promo/", $loja_pedido))        { $total_promo   += $total_pedido;} 
	 #if (preg_match("/entrega/", $loja_pedido))      { $total_entrega += $total_pedido;} 
	 
	 #$total_pedido          =  number_format($total_pedido, 2, ',', '.');
	 #$total_promo_g          =  number_format($total_promo, 2, ',', '.');
	 echo "[\"$descricao_pedido\",$total_pedido],\n";
	 }
	 
	 
	 
	 ?>		
		
        ["Total", 1]   ]);
    var options = {

        title: 'Total em %',
        pieStartAngle:120,
		'width':800,
		'height':600

      };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
    <div id="piechart" style="width: 100%; height: 500px; float:inherit; display:block;"></div>
 

  </div>

  <div class="fin" style="display:none">
   <p class="titulo_aba">Acessos e Logs</p>
     <table align="center" width="100%">
     <tr>
       <td>Cidade</td><td>Estado</td><td>País</td><td>Data/Hora</td>
     </tr>
<?php

$mysql_location = mysqli_query($con,"SELECT * FROM `location_user` WHERE `codigo` = '$cod_cliente' ORDER BY `data` DESC LIMIT 50")or die(mysql_error());
while($array_location = mysqli_fetch_assoc($mysql_location)){	
	$lo_codigo    = $array_location["codigo"];
	$lo_latitude  = $array_location["latitude"];
	$lo_longitude = $array_location["longitude"];
	$lo_data      = $array_location["data"];
	$lo_custon    = $array_location["custon"];
	$lo_city      = $array_location["city"];
	$lo_state     = $array_location["state"];
	$lo_code3     = $array_location["code3"];
	
	$lo_data = date('d/m/Y H:i:s', strtotime(str_replace("-", "/", $lo_data )));
#-----------------------------------------------------------------------------------------------

$lo_uf = trim($lo_uf);
$lo_state = trim($lo_state);
$lo_city = strtoupper($lo_city);
$lo_cidade = strtoupper($lo_cidade);

if($lo_state != $adisul_estado) {$variavel_cor = "suspeito";} else {$variavel_cor = "normal";}
	
echo "
<tr class=\"$variavel_cor\">
	<td >$lo_city</td>
	<td >$lo_state</td>
	<td >$lo_code3</td>
	<td >$lo_data</td>

</tr>";	
	}	
?>
     
     </table>
  </div>
    <div class="fin" style="display:none">
   <p class="titulo_aba">Ações Avançadas</p>
   <br />
   <br />
	Atenção ao excluir este usuário somente seu registro será apagado , pedidos continuaram no site.<br />
	<br />

   <a href="?excluirUser&id=<?php echo $cod_cliente;?>" title="Excluir Cliente" style="padding:8px;background-color:#F00;color:#FFF;margin:10px;">Excluir Usuário</a>
   </div>


</div>
</div>

</div>



</body>
</html>
<?php
$mensagem = "Perfil Cliente $cod_cliente";
salvaLog($con,$mensagem);
?>