<?php
session_start();
include "conexao.php";
$type = $_GET["type"];


#------------------Consulta o banco do representante---------------------------------------------------------
$query_repre_pedido = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`usuarios` WHERE `nome` = '$userx'");        
		while($array_repre_pedido = mysqli_fetch_assoc($query_repre_pedido)){			
			$xxxend = $array_repre_pedido["endereco"];
			$banco_rew = $array_repre_pedido["id"];		
			
}

#------------------Consulta o tipo de bando de pedidos---------------------------------------------------------
$query_pedidos = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`loja_table` WHERE `tipo` = '$type'");        
		while($array_pedido = mysqli_fetch_assoc($query_pedidos)){			
			$bd_banco = $array_pedido["banco"];
			$pagina   = $array_pedido["xls"];
			$type = $type;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="images/iso.png" rel="shortcut icon"  type="image/png"/>
<link href="images/iso.png" rel="apple-touch-icon" type="image/png"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADISUL- Controle Administrativo</title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<style type="text/css">

* {
	margin: 0px;
	padding: 0px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 8pt;
}
#p_painel {
	position:absolute;
	left:0;
	top:50px;
	width:860px;
	height:auto;
	background-color:#FFFFFF;
	padding: 20px;
}
#lista_pedidos {
	background-color:#FFF;}
#container {
	position:relative;
	margin:auto;
	width:900px;}


</style>
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="menu.js"></script>
<script type="text/javascript">
<!-- 
function goto_URL(object) {
window.location.href = object.options[object.selectedIndex].value; }
//-->
</script>
<style type="text/css" >
@import url("menu.css");

</style>
</head>

<body>
<div id="faixa"></div>
<div id="container">
<?php echo $menu_adi;?>
</div>
  <div id="lista_pedidos">
  <center>
  <a href="motor_xls_pedido.php?var=<?php echo $type ;?>" alt="Relatório de pedido" class="bt_xls"><img src="images/gear3.png" alt="XLS" />Exportar Relatório</a>
  	<table width="100%" >
      <tr bgcolor="#66FF66">
      <td>Pedido</td>
      <td>Cliente</td>
      <td>Grupo</td>
      <td>Comprador</td>
      <td>Email para Contato</td>
      <td>Data/Hora Inicio</td>
      <td>Data/Hora Atualizado</td>
      <td>Status do Pedido</td>
      <td>Total Pedido</td>
      <td>Ações</td>
     
      </tr>
      <?php
	  $pedido_sql = mysqli_query($con,"SELECT DISTINCT `loja` FROM `lista_artigo_pedido_fw14` ORDER BY id DESC");
	  while ($pedido_array    = mysqli_fetch_assoc($pedido_sql)){
		$pedido_npedido       = $pedido_array["npedido"];
		$pedido_clientepai    = $pedido_array["loja"];
		$pedido_data          = $pedido_array["data_1"]; 
		$pedido_hora          = $pedido_array["hora_1"];
		$pedido_data_2        = $pedido_array["data_2"]; 
		$pedido_hora_2        = $pedido_array["hora_2"];
		$pedido_status        = $pedido_array["status"];
		$pedido_total         = $pedido_array["total"];  
		
		$cliente_sql = mysqli_query($con,"SELECT * FROM login WHERE `B` = '$pedido_clientepai'");while($cliente_array  = mysqli_fetch_assoc($cliente_sql)){
			
			$nome_clientepai = $cliente_array["loja"];
			$email           = $cliente_array["email"];
			$nomedogrupo     = $cliente_array["nome"];
			$telefone        = $cliente_array["telefone"];
			$comprador       = $cliente_array["comprador"];}	
					
		#------ Tratamento de dados---------------------------------
		if($pedido_total == "") {$pedido_total = "0";}
		$pedido_total =  number_format($pedido_total, 2, ',', '.');		
		$pedido_data = date('d/m/Y', strtotime(str_replace("-", "/", $pedido_data ))); 
		$pedido_data_2 = date('d/m/Y', strtotime(str_replace("-", "/", $pedido_data_2 ))); 
		if($pedido_status  == "1")   {$pedido_status = "<b class=\"laranja\">Aberto</b>";}
		elseif($pedido_status == "2"){$pedido_status = "<b class=\"vermelho\">Pedido Enviado</b> ";}
		elseif($pedido_status == "3"){$pedido_status = "<b class=\"azul\">Pedido Conferido</b> ";}
		elseif($pedido_status == "4"){$pedido_status = "<b class=\"verde_e\">Finalizado</b> ";}
		
		 $pedido_soma = mysqli_query($con,"SELECT SUM(total) as soma FROM `lista_artigo_pedido_fw14` WHERE `loja` = '$pedido_clientepai'");
	       while ($pedido_somaa    = mysqli_fetch_assoc($pedido_soma)){
						$soma       = $pedido_somaa["soma"];
								   }
								   
								   $soma =  number_format($soma, 2, ',', '.');	
	  
	  echo "<tr class=\"hoverrer\">
	                  <td>$pedido_clientepai</td>
			  <td><a href=\"perfil.php?login=$pedido_clientepai\">$nome_clientepai | $pedido_clientepai</a></td>
			  <td>$nomedogrupo</td>
			  <td>$comprador</td>			  
			  <td><a href=\"mailto:$email?Subject=ADIDAS - Pedido Pré-venda Nº $pedido_npedido - ADISUL\"><img src=\"images/mail.gif\"  title=\"$email\"/></a> $telefone</td>
			  <td>$pedido_data | $pedido_hora</td>
			  <td>$pedido_data_2 | $pedido_hora_2</td>			  
			  <td>$pedido_status</td>
			  <td>R$ $soma</td>

			 <td>
			     	<form action=\"".$PHP_SELF."\" onsubmit=\"return false;\">
		               <select name=\"selectName\" onchange=\"goto_URL(this.form.selectName)\">
		 			   <option>Mudar para</option>
					   <option value=\"?npedido=$pedido_npedido&var=2&tipo=$type&user=$banco_rew&&upDate\">Sem disponibilidade</option>
					   <option value=\"$xxxend/order/ordens/$pagina?npedido=$pedido_npedido&tipo=$type\">Download DP</option>
					   <option value=\"".$xxxend."/xls/".$pagina."?npedido=".$pedido_npedido."\">Ver pedido</option>					   
				       <option value=\"?npedido=$pedido_npedido&var=4&tipo=$type&user=$banco_rew&upDate\">Finalizado</option>
				       <option value=\"?npedido=$pedido_npedido&var=5&tipo=$type&user=$banco_rew&upDate\">Lixeira</option>
					   <option value=\"?npedido=$pedido_npedido&var=2&tipo=$type&user=$banco_rew&&upDate\">Pedido Enviado</option>


       				  </select> 
		           </form>
			 </td>
		 </tr>";
	};
      ?>
    </table>

    </center>
  </div>
<?php

$mensagem = "Pagina de Pedidos $type";
salvaLog($con,$mensagem);

?>
</body>
</html>