<?php
session_cache_limiter( 'nocache' );
session_start();
include"conexao.php";
$chamar = $_GET["chamar"];


function addCliente() {
	
	$cd_cl = $_GET["cod_cl"];
	$sql_limpa = mysqli_query($con,"DELETE  FROM `rbkne024_reebok`.`lista_negra` WHERE `artigo` = '$cd_cl'") ;
		echo "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\">
			alert (\"Artigo removido com sucesso!\")
		 </SCRIPT>";
}

if(isset($chamar)){
addCliente();
}



$search = $_POST["artigo"];
if($search <> "") {
	
	$cd_cl = $_POST["artigo"];
	
	$cd_cl = strtoupper($cd_cl);
	
	
  #  $resultado_npedido = mysqli_query($con,"INSERT INTO `rbkne024_reebok`.`lista_negra` (`id`, `artigo`) VALUES (NULL, '$cd_cl')");
	echo "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\">
			alert (\"Artigo adicionado com sucesso!\")
		 </SCRIPT>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="images/iso.png" rel="shortcut icon"  type="image/png"/>
<link href="images/iso.png" rel="apple-touch-icon" type="image/png"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="visualize.jQuery.css"/>
<script type="text/javascript" src="visualize.jQuery.js"></script>
<script src="mint.js" type="text/javascript"></script>
<title>ADISUL- Controle Administrativo</title>
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<style type="text/css">
#p_painel {
	position:absolute;
	left:0;
	top:50px;
	width:860px;
	height:auto;
	background-color: #CCCCCC;
	padding: 20px;
}

#container {
	position:relative;
	margin:auto;
	width:900px;}



.efeito {
	text-decoration:blink;
	}
</style>
<script type="text/javascript" src="jquery.js">    </script>
<script src="jquery-blink.js" language="javscript" type="text/javascript"></script>
 
<script type="text/javascript" language="javascript">
 
$(document).ready(function()
{
        $('.blink').blink(); // default is 500ms blink interval.
        //$('.blink').blink({delay:100}); // causes a 100ms blink interval.
});
 
</script>

<link type="text/css" href="menu.css" rel="stylesheet" />

<script type="text/javascript" src="menu.js"></script>
<style type="text/css" media="all">
@import url("menu.css");
#location {
	position: absolute;
	left: 561px;
	top: 249px;
	width: 148px;
	height: 111px;
	background-color: #FFFFFF;
	
	background-image: url(images/logo_location.jpg);
}

#lix {
	position: absolute;
	left: 561px;
	top: 400px;
	width: 148px;
	height: 111px;
	background-color: #FFFFFF;
	
	background-image: url(images/logo_pedidos.jpg);
}
#lista_negra {
	position: absolute;
	left: 561px;
	top: 100px;
	width: 148px;
	height: 111px;
	background-color: #FFFFFF;
	
	.verm {
	color:#BD0909;
	}
}
</style>
<script type="text/javascript">
			$(function(){
				//make some charts
				// mais detalhes em http://www.filamentgroup.com/lab/jquery_visualize_plugin_accessible_charts_graphs_from_tables_html5_canvas/
				//$('table').visualize({type: 'pie', pieMargin: 10, title: 'asdqwe'});	
				//$('table').visualize({type: 'line'});
				//$('table').visualize({type: 'area'});
				$('table').visualize();
			});
		</script>

</head>
<body>


<div id="container">
<?php echo $menu_adi;?>
<div id="blando">

<br />
<br />
<br />
<br />
<br />
<p style="color:#FFF; font-size:14pt;">Lista de produtos não exibidos na loja "Pronta-Entrega" e "Promocional".</p>
<br />
<br />
<div style="background-color:#FFF;padding:20px;">
<form action="<?php echo $PHP_SELF; ?>" method="post">Adicionar ARTIGO/REFERÊNCIA <input name="artigo" maxlength="6"  /> <input type="submit" value="Cadastrar" style="padding:4px;" /><br />
</form>
</div>
<br />
<br />


<?php
$mysql_black_list = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`lista_negra` ORDER BY `artigo`");
while($array = mysqli_fetch_assoc($mysql_black_list)){
$s_artigo  = $array["artigo"];


$query_tabela = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`loja_table`  WHERE `status` = '2' ORDER BY `id` DESC");
while($array_tale = mysqli_fetch_assoc($query_tabela)){
	$tx_banco = $array_tale["dispo"];
	$tx_tipo  = $array_tale["tipo"];
	$tx_desc  = $array_tale["descricao"];
	
	
	$query_total_1000 = mysqli_query($con,"SELECT `Artigo`  FROM  `rbkne024_reebok`.`$tx_banco` WHERE  `Artigo` = '$s_artigo' LIMIT 1") or die(mysql_error());
		while($array_1000 = mysqli_fetch_assoc($query_total_1000)){
			$descri_loja = $array_1000["Artigo"];
			
			if($descri_loja) { $descri_loja = "<label class=\"verm\" > Loja $descri_loja</label>";}
			
	}
	}



$img = "";
$resultado_index = "


<label class=\"rotulo\">
$img<br />$descri_loja
<font class=\"lang\" >$s_artigo</font><br/>
</font><br />
<img src=\"img/bar.jpg\" /><br />
<a href='?chamar&cod_cl=$s_artigo' title=\"Retirar da lista \" style=\"padding:8px;\">REMOVER</a>
</label>
";
echo $resultado_index;	
$tudo = "";
$total_star = "";
}

?>
</div>
</div>


</div>


<?php
$mensagem = "Lista Negra";
salvaLog($con,$mensagem);
?>
<script type="text/javascript">
	$(function(){
		$("#stats").charts();
	})
</script>
</body>
</html>