<?php
session_start();
include "conexao.php";
$type = $_GET["type"];
#-----------------------------------------------------------------------------------------------------------
$limite = 50;
// Captura os dados da variável 'pag' vindo da url, onde contém o número da página atual
$pagina = $_GET['pag'];
/* Se a variável $pagina não conter nenhum valor,
então por padrão ela será posta com o valor 1 (primeira página) */
if(!$pagina)
{
    $pagina = 1;
}
/* Operação matemática que resulta no registro inicial
a ser selecionado no banco de dados baseado na página atual */
$inicio = ($pagina * $limite) - $limite;
#-----------------------------------------------------------------------------------------------------------
#--------------Atualizar Status no pedido e baixa em estoque -----------------------------------------------

if (isset($_GET['upDate'])){
	
upDate($con);
}

function upDate($con) {

$p_pedido = $_GET["npedido"];
$p_tipo   = $_GET["tipo"];
$p_var    = $_GET["var"];
$p_representante = $_GET["user"];
$query_repre_pedido = mysqli_query($con,"SELECT `banco` FROM `rbkne024_reebok`.`usuarios` WHERE `id` = '$p_representante'") or die (mysql_error());     
		while($array_repre_pedido = mysqli_fetch_assoc($query_repre_pedido)){			
			$banco_repre = $array_repre_pedido["banco"];	}
$query_pedidos = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`loja_table` WHERE `tipo` = '$p_tipo'") or die (mysql_error());      
		while($array_pedido = mysqli_fetch_assoc($query_pedidos)){
		
			$table 			= $array_pedido["banco"];
			$table_artigo	        = $array_pedido["banco_artigo"];
			$dispo 			= $array_pedido["dispo"];
			
			
			
			}
			if($table == "pedido_promoxx") {
		#--------------------Verifica e abaixa o estoque-----------------------------------------------------
		if($p_var == "4" || $p_var == "5" || $p_var == "7") {
			$quey_dow_pedido = mysqli_query($con,"SELECT `artigo`,`tamanho`,`quantidade`,`data` FROM `$banco_repre`.`$table_artigo` WHERE `npedido` = '$p_pedido'") or die (mysql_error());
			while($array_dow = mysqli_fetch_assoc($quey_dow_pedido)){	
			$e_artigo     = $array_dow["artigo"];
			$e_tamanho    = $array_dow["tamanho"];
			$e_quantidade = $array_dow["quantidade"];
			$e_data       = $array_dow["data"];
			
			$query_up_pedido = 
			mysqli_query($con,"SELECT `Tamanho`,`mes_11`,`mes_22`,`mes_33`,`mes_44`,`mes_55`,`mes_66` FROM `rbkne024_reebok`.`$dispo` WHERE `Artigo` = '$e_artigo' AND `Tamanho` = '$e_tamanho'") or die (mysql_error());
			while($array_up = mysqli_fetch_assoc($query_up_pedido)){
			$u_tamanho = $array_up["Tamanho"];
			$u_mes_11  = $array_up["mes_11"];
			
			$qt_mes_11 = $u_mes_11-$e_quantidade;
		    if($qt_mes_11 < 0) { 
			
			$query_dispo_update = mysqli_query($con,"DELETE FROM `rbkne024_reebok`.`$dispo`  WHERE  `Artigo` = '$e_artigo' AND `Tamanho` = '$e_tamanho'") or die (mysql_error());
			 }
		    if($qt_mes_11 == 0) { 
			
			$query_dispo_update = mysqli_query($con,"DELETE FROM `rbkne024_reebok`.`$dispo`  WHERE  `Artigo` = '$e_artigo' AND `Tamanho` = '$e_tamanho'") or die (mysql_error());
			 }
			
			#-----------------Atualizando a disponibilidade-------------------------
			$query_dispo_update = mysqli_query($con,"UPDATE `rbkne024_reebok`.`$dispo` SET `mes_11` = '$qt_mes_11'  WHERE  `Artigo` = '$e_artigo' AND `Tamanho` = '$e_tamanho'") or die (mysql_error());
			
			}
			}
		}
		
		}
		elseif($table == "pedido_promocional") {
		#--------------------Verifica e abaixa o estoque-----------------------------------------------------
		if($p_var == "4" || $p_var == "5" || $p_var == "7") {
			$quey_dow_pedido = mysqli_query($con,"SELECT `artigo`,`tamanho`,`quantidade`,`data` FROM `$banco_repre`.`$table_artigo` WHERE `npedido` = '$p_pedido'") or die (mysql_error());
			while($array_dow = mysqli_fetch_assoc($quey_dow_pedido)){	
			$e_artigo     = $array_dow["artigo"];
			$e_tamanho    = $array_dow["tamanho"];
			$e_quantidade = $array_dow["quantidade"];
			$e_data       = $array_dow["data"];
			
			$query_up_pedido = 
			mysqli_query($con,"SELECT `Tamanho`,`mes_11`,`mes_22`,`mes_33`,`mes_44`,`mes_55`,`mes_66` FROM `rbkne024_reebok`.`$dispo` WHERE `Artigo` = '$e_artigo' AND `Tamanho` = '$e_tamanho'") or die (mysql_error());
			while($array_up = mysqli_fetch_assoc($query_up_pedido)){
			$u_tamanho = $array_up["Tamanho"];
			$u_mes_11  = $array_up["mes_11"];
			
			$qt_mes_11 = $u_mes_11-$e_quantidade;
		    if($qt_mes_11 < 0) { 
			
			$query_dispo_update = mysqli_query($con,"DELETE FROM `rbkne024_reebok`.`$dispo`  WHERE  `Artigo` = '$e_artigo' AND `Tamanho` = '$e_tamanho'") or die (mysql_error());
			 }
		    if($qt_mes_11 == 0) { 
			
			$query_dispo_update = mysqli_query($con,"DELETE FROM `rbkne024_reebok`.`$dispo`  WHERE  `Artigo` = '$e_artigo' AND `Tamanho` = '$e_tamanho'") or die (mysql_error());
			 }
			
			#-----------------Atualizando a disponibilidade-------------------------
			$query_dispo_update = mysqli_query($con,"UPDATE `rbkne024_reebok`.`$dispo` SET `mes_11` = '$qt_mes_11'  WHERE  `Artigo` = '$e_artigo' AND `Tamanho` = '$e_tamanho'") or die (mysql_error());
			
			}
			}
		}
		
		}
			elseif($table == "pedido_acesso") {
		#--------------------Verifica e abaixa o estoque-----------------------------------------------------
		if($p_var == "4" || $p_var == "5" || $p_var == "7") {
			$quey_dow_pedido = mysqli_query($con,"SELECT `artigo`,`tamanho`,`quantidade`,`data` FROM `$banco_repre`.`$table_artigo` WHERE `npedido` = '$p_pedido'") or die (mysql_error());
			while($array_dow = mysqli_fetch_assoc($quey_dow_pedido)){	
			$e_artigo     = $array_dow["artigo"];
			$e_tamanho    = $array_dow["tamanho"];
			$e_quantidade = $array_dow["quantidade"];
			$e_data       = $array_dow["data"];
			
			$query_up_pedido = 
			mysqli_query($con,"SELECT `Tamanho`,`mes_11`,`mes_22`,`mes_33`,`mes_44`,`mes_55`,`mes_66` FROM `rbkne024_reebok`.`$dispo` WHERE `Artigo` = '$e_artigo' AND `Tamanho` = '$e_tamanho'") or die (mysql_error());
			while($array_up = mysqli_fetch_assoc($query_up_pedido)){
			$u_tamanho = $array_up["Tamanho"];
			$u_mes_11  = $array_up["mes_11"];
			
			$qt_mes_11 = $u_mes_11-$e_quantidade;
		    if($qt_mes_11 < 0) { 
			
			$query_dispo_update = mysqli_query($con,"DELETE FROM `rbkne024_reebok`.`$dispo`  WHERE  `Artigo` = '$e_artigo' AND `Tamanho` = '$e_tamanho'") or die (mysql_error());
			 }
		   if($qt_mes_11 == 0) { 
			
			$query_dispo_update = mysqli_query($con,"DELETE FROM `rbkne024_reebok`.`$dispo`  WHERE  `Artigo` = '$e_artigo' AND `Tamanho` = '$e_tamanho'") or die (mysql_error());
			 }
			
			#-----------------Atualizando a disponibilidade-------------------------
			$query_dispo_update = mysqli_query($con,"UPDATE `rbkne024_reebok`.`$dispo` SET `mes_11` = '$qt_mes_11'  WHERE  `Artigo` = '$e_artigo' AND `Tamanho` = '$e_tamanho'") or die (mysql_error());
			
			}
			}
		}
		
		}
		
		
		
		#----------------------------------------------------------------------------------------------------
$atua_total_pedido = mysqli_query($con,"UPDATE `$banco_repre`.`$table` SET `status` = '$p_var'  WHERE  `npedido` = '$p_pedido'") or die (mysql_error());


$mensagem = "Atualizou Status do Pedido $p_pedido para status $p_var - $p_tipo";
salvaLog($con,$mensagem);

	header("location:pedido_2.php?type=$p_tipo&msg=231&npedido=$p_pedido&tipo=$p_tipo&var=$p_var");
}

#-----------------------------------------------------------------------------------------------------------
#-----------------------------------------------------------------------------------------------------------
#-----------------------------------------------------------------------------------------------------------
#-----------------------------------------------------------------------------------------------------------
#-----------------------------------------------------------------------------------------------------------

#------------------Consulta o banco do representante---------------------------------------------------------
$query_repre_pedido = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`usuarios` WHERE `nome` = '$userx'");        
		while($array_repre_pedido = mysqli_fetch_assoc($query_repre_pedido)){			
			$xxxend = $array_repre_pedido["endereco"];
			$banco_rew = $array_repre_pedido["id"];		
			
}

#------------------Consulta o tipo de bando de pedidos---------------------------------------------------------
$query_pedidos = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`loja_table` WHERE `tipo` = '$type'");        
		while($array_pedido = mysqli_fetch_assoc($query_pedidos)){			
			$bd_banco	        = $array_pedido["banco"];
			$pagina   		= $array_pedido["xls"];
			$loja_name_descricao 	= $array_pedido["descricao"];
			$type 			= $type;
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
<script type="text/javascript">
function mudar_cor(linha)
{
	var chk = linha.getElementsByTagName("input");

	chk[0].checked = !chk[0].checked;

	if(chk[0].checked)
	{
		linha.style.backgroundColor = "#C0C0C0";
	}
	else
	{
		linha.style.backgroundColor = "#FFFFFF";
	}
}
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
      <tr class="pri_linha">
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
	  $pedido_sql = mysqli_query($con,"SELECT * FROM `$bd_banco` WHERE `status` != '5' ORDER BY id DESC LIMIT $inicio,$limite");
	  $consulta = mysqli_query($con,"SELECT * FROM `$bd_banco` WHERE `status` != '5'"); // Seleciona o campo id da nossa tabela produtos
	  // Captura o número do total de registros no nosso banco a partir da nossa consulta
	  $total_registros = mysqli_num_rows($consulta);
	  
	  /* Define o total de páginas a serem mostradas baseada na divisão do total de registros pelo limite de registros a serem mostrados */
	  $total_paginas = Ceil($total_registros / $limite);
	  
	  while ($pedido_array    = mysqli_fetch_assoc($pedido_sql)){
		$pedido_npedido       = $pedido_array["npedido"];
		$pedido_clientepai    = $pedido_array["cliente"];
		$pedido_data          = $pedido_array["data_1"]; 
		$pedido_hora          = $pedido_array["hora_1"];
		$pedido_data_2        = $pedido_array["data_2"]; 
		$pedido_hora_2        = $pedido_array["hora_2"];
		$pedido_status        = $pedido_array["status"];
		$pedido_total         = $pedido_array["total"];  
		$nome_clientepai      = $pedido_array["razao"];
		
		$cliente_sql = mysqli_query($con,"SELECT * FROM login WHERE `B` = '$pedido_clientepai'");while($cliente_array  = mysqli_fetch_assoc($cliente_sql)){
			
			
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
		elseif($pedido_status == "6"){$pedido_status = "<b class=\"sem\">Sem estoque</b> ";}
		elseif($pedido_status == "7"){$pedido_status = "<b class=\"sem\">Atendido Parcial</b> ";}
	  
	  echo "<tr class=\"hoverrer\" obgcolor=\"#E8E8E8\" onClick=\"bgColor='#33FF66'\">
	          <td><a href=\"#\" class=\"pediso_ss13\" title=\"Abrir o pedido\" />$pedido_npedido</a></td>
			  <td><a href=\"perfil.php?login=$pedido_clientepai\">$nome_clientepai | $pedido_clientepai</a></td>
			  <td>$nomedogrupo</td>
			  <td>$comprador</td>			  
			  <td><a href=\"mailto:$email?Subject=ADIDAS - Pedido ".$loja_name_descricao." Nº $pedido_npedido - ADISUL\"><img src=\"images/mail.gif\"  title=\"$email\"/></a> $telefone</td>
			  <td>$pedido_data | $pedido_hora</td>
			  <td>$pedido_data_2 | $pedido_hora_2</td>			  
			  <td>$pedido_status</td>
			  <td>R$ $pedido_total</td>
			  <td>
			     	<form action=\"".$PHP_SELF."\" onsubmit=\"return false;\">
		               <select name=\"selectName\" onchange=\"goto_URL(this.form.selectName)\">
		 			   <option>Mudar para</option>					   
					   <option value=\"$xxxend/order/ordens/$pagina?npedido=$pedido_npedido&tipo=$type\">Download DP</option>
					   <option value=\"".$xxxend."/xls/".$pagina."?npedido=".$pedido_npedido."\">Ver pedido</option>					   
				       <option value=\"?npedido=$pedido_npedido&var=4&tipo=$type&user=$banco_rew&upDate\">Finalizado</option>
					   <option value=\"?npedido=$pedido_npedido&var=7&tipo=$type&user=$banco_rew&&upDate\">Atendido Parcial</option>
					   <option value=\"?npedido=$pedido_npedido&var=6&tipo=$type&user=$banco_rew&&upDate\">Sem estoque</option>
				       <option value=\"?npedido=$pedido_npedido&var=5&tipo=$type&user=$banco_rew&upDate\">Lixeira</option>	
       				   </select> 
		           </form>
			  </td>
		 </tr>";
		 
		 
			$nome_clientepai = "||------------SEM CADASTRO";
			$email           = "SEM CADASTRO";
			$nomedogrupo     = "||-- SEM CADASTRO -- ||";
			$telefone        = "SEM CADASTRO";
			$comprador       = "SEM CADASTRO";
	};
      ?>
    </table>
    <div id="caixa_pag">
<?php
echo '<a href="pedido_2.php?pag=1&type='.$type.'" class="pagi">'.'Primeira página'.'</a>';
    for($i=1; $i <= $total_paginas; $i++)
    {
         if($pagina == $i)
         {
             echo " ".$i." ";
         }
         else
         {
             echo '<a href="pedido_2.php?pag='.$i.'&type='.$type.'" class="pagi"> '.$i.'</a>';
 
         }
    }
echo '<a href="pedido_2.php?pag='.$total_paginas.'&type='.$type.'" class="pagi"> Última página</a>';



?>
    
    </center>
  </div>
  
  
  
  
<?php
$mensagem = "Pagina de Pedidos $type";
salvaLog($con,$mensagem);
?>
</body>
</html>