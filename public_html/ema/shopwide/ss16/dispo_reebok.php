<?php
session_start();
header("Pragma: no-cache");
header("Cache: no-cache");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");	
$barra_endereco = "../../";
$categoria = $_GET["categoria"];
$search    = $_GET["search"];
$star_get  = $_GET["star_get"];
$tipo      = $_GET["tipo"];
$price     = $_GET["price"];
$order     = $_GET["order"];
$order_pag = $order;
$categoria_tipo = "";
include"../../conexao.php";
include"sql_pedido/p_pedido.php";

#-----------------------------------------------------------------------------------------------------------
$limite = 30;
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


#-----------paginação------------------------------------------------------------------------
#--------------------------------------------------compra----------------------------------------------
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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript" src="../../menu.js"></script>
<script language="JavaScript">
function abrir(URL) { 
  var width = 950;
  var height = 550; 
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
<body>
<div id="conta">
<?php 
include"top.php";

if($status_banco == "<div id=\"status_banco\"><a href=\"../../principal.php\"><img src=\"img/gestao_icone.png\"></a></div>")  {echo $status_banco; exit;}?>

<div id="barra_pedido">
  <!--Shop --- ADidas---->
  <?php echo $p_menu;?>
</div>
<div id="campo1">
<?php
function verifica($tabela) { 
if(!(mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`$tabela`"))) { 
echo "<p class=\"msg_3\"><img src=\"img/gestao_icone.png\"><br />
Estamos atualizando o banco de dados , dentro de instantes estaremos de volta.</p>"; 
exit;
} else { 
echo $msg_4; 
} 
} 
include"campo_pesquiza.php";	
?>

<?php if($tipo_re <> 0) { ?>
	<label class="modulo1">
    	<a href="dispo.php?star_get=N2" title="#">FUTEBOL</a>
        <a href="dispo.php?star_get=N1" title="#">AGASALHO MASCULINO</a>
        <a href="dispo.php?star_get=N3" title="#">AGASALHO FEMENINO</a>   
        <a href="dispo.php?star_get=N4" title="#">AGASALHO INFANTIL</a>    
    
    </label>
    
<?php };?>
<div id="resultado">
<center>
<br />
<br />
<?php
	 
 if($_GET["search"] == "" && $_GET["tipo"] == ""  && $_GET["categoria"] == ""){;}
 
  elseif($_GET["search"] == "" && $_GET["tipo"] == "X" && $_GET["categoria"] <> "") {?> <span class="msgalert">Escolha primeiro a Divisão!</span><?php ;}  
  elseif($_GET["search"] == "" && $_GET["tipo"] <> ""  && $_GET["categoria"] == "X"){?> <span class="msgalert">Escolha a Categoria!</span><?php ;}  
  elseif($_GET["search"] == "" && $_GET["tipo"] <> ""  && $_GET["categoria"] <> "") {?>Resultado para <span class="pesquisa"><?php 	echo $tipo." e ".$categoria."</span>";} 
  
  else                                                                              {?>Resultado para <span class="pesquisa"><?php 	echo $search."</span>";} ?>
</center>
<br />
<?php 
$sinal = "=";
if($order == "")                       {$order = "ORDER BY `Descricao` ASC";}
elseif($order == "vitrine")            {$order = "ORDER BY  CAST(vitrine as SIGNED), Descricao ASC";}
elseif($order == "Descricao")          {$order = "ORDER BY `Descricao` ASC";}	
elseif($order == "Data de Lancamento") {$order = "ORDER BY `Data de Lancamento` ASC";}
elseif($order == "pag")                {$order = "ORDER BY  CAST(`pag` as SIGNED)";}
     
      
     if($price <> "")          {$regra_price = " AND `vitrine` < '$price' AND ";}
                           else{$regra_price = " AND `Categoria` = '$categoria'  AND ";}
if($tipo <> "") { 	
$gender = $_GET["gender"];
$query = mysqli_query($con, "SELECT DISTINCT `Artigo`, `Descricao`, `Segmentacao`, `Usage`, `Gender`, `vitrine` FROM  `rbkne024_reebok`.`$tabela` WHERE 
Divisao = '$tipo' AND `Gender` $sinal_x '$gender' $regra_price `Usage` LIKE '%".$segmentacao_2."%' $order LIMIT $inicio,$limite ") or die(mysql_error());
$consulta = mysqli_query($con, "SELECT DISTINCT `Artigo`, `Descricao`, `custo`, `Segmentacao`, `Usage`, `Gender`, `vitrine` FROM `rbkne024_reebok`.`$tabela` WHERE 
Divisao = '$tipo' AND `Gender` $sinal_x '$gender' $regra_price `Usage` LIKE '%".$segmentacao_2."%'"); // Seleciona o campo id da nossa tabela produtos
}

if($search <> "") { 

if($tipo_re == "O") { 
  $sinal = "="; 
  $categoria_originals = "ORIGINALS";
  $categoria_action    = "ACTION SPORTS";
  
$query =    mysqli_query($con, "SELECT DISTINCT `Artigo`, `Descricao`, `Segmentacao`, `Usage`, `Gender`, `vitrine` FROM  `rbkne024_reebok`.`$tabela` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."')  AND (`Categoria` = '$categoria_action' OR `Categoria` = '$categoria_originals')  ORDER BY `Descricao` LIMIT $inicio,$limite") or die(mysql_error());
$consulta = mysqli_query($con, "SELECT DISTINCT `Artigo`, `Descricao`, `Segmentacao`, `Usage`, `Gender`, `vitrine` FROM  `rbkne024_reebok`.`$tabela` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."') AND (`Categoria` = '$categoria_action' OR `Categoria` = '$categoria_originals') ORDER BY `Descricao`"); // Seleciona o campo id da nossa tabela produtos
 					  }
else {

$sinal = "="; 					   
$query = mysqli_query($con, "SELECT DISTINCT `Artigo`, `Descricao`, `Segmentacao`, `Usage`, `Gender`, `vitrine` FROM  `rbkne024_reebok`.`$tabela` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."')  AND (`Usage` LIKE '%".$segmentacao_2."%') $categoria_tipo ORDER BY `Descricao`  LIMIT $inicio,$limite") or die(mysql_error());
$consulta = mysqli_query($con, "SELECT DISTINCT `Artigo`, `Descricao`, `custo`, `Segmentacao`, `Usage`, `Gender`, `vitrine` FROM `rbkne024_reebok`.`$tabela` WHERE (`Descricao` LIKE '%".$search."%' or Artigo = '".$search."') AND (`Usage` LIKE '%".$segmentacao_2."%') $categoria_tipo ORDER BY `Descricao`"); // Seleciona o campo id da nossa tabela produtos
}
}

#-------------------------------------------------------------------------------------------------------------------------------------------------
#-------------------------------------------------------------------------------------------------------------------------------------------------
#---------------------------------------Total de visitas BETA TESTE-------------------------------------------------------------------------------
#-------------------------------------------------------------------------------------------------------------------------------------------------
#-------------------------------------------------------------------------------------------------------------------------------------------------

if($star_get <> "") 
 {
if($star_get == "N1")  {$varial = "Agasalho";			$tipo_campo = "Descricao"; 			   $n_campo = "Gender"; 		$n_gender = "M";} 
if($star_get == "N2")  {$varial = "FOOTBALL/SOCCER";	$tipo_campo = "Categoria";			   $n_campo = "Gender"; 		$n_gender = "M";} 
if($star_get == "N3")  {$varial = "Agasalho";			$tipo_campo = "Descricao"; 			   $n_campo = "Gender"; 		$n_gender = "W";} 
if($star_get == "N4")  {$varial = "Agasalho";			$tipo_campo = "Descricao"; 			   $n_campo = "Categoria"; 		$n_gender = "INFANTIL";} 



 	

	
$query    = mysqli_query($con, "SELECT DISTINCT `Artigo`, `Descricao`, `Segmentacao`, `Usage`, `Gender`, `vitrine` FROM  `rbkne024_reebok`.`$tabela` WHERE (`$tipo_campo` LIKE '%".$varial."%') AND (`$n_campo` = '".$n_gender."') AND (`Usage` LIKE '%".$segmentacao_2."%'  ) ORDER BY `Descricao`  LIMIT $inicio,$limite") or die(mysql_error());
$consulta = mysqli_query($con, "SELECT DISTINCT `Artigo`, `Descricao`, `Segmentacao`, `Usage`, `Gender`, `vitrine` FROM  `rbkne024_reebok`.`$tabela` WHERE (`$tipo_campo` LIKE '%".$varial."%') AND (`$n_campo` = '".$n_gender."') AND (`Usage` LIKE '%".$segmentacao_2."%'  ) ORDER BY `Descricao`")or die(mysql_error()); // Seleciona o campo id da nossa tabela produtos
}


#-------------------------------------------------------------------------------------------------------------------------------------------------
#-------------------------------------------------------------------------------------------------------------------------------------------------
#-------------------------------------------------------------------------------------------------------------------------------------------------
#-------------------------------------------------------------------------------------------------------------------------------------------------

if($query == "") {} 

else {
// Captura o número do total de registros no nosso banco a partir da nossa consulta
$total_registros = mysqli_num_rows($consulta);
/* Define o total de páginas a serem mostradas baseada na divisão do total de registros pelo limite de registros a serem mostrados */
$total_paginas = Ceil($total_registros / $limite);
include"paginacao.php";	 
$lin = mysqli_num_rows($query);
    if($lin==0) // verifica se retornou algum registro
    {
   echo '<center><span  class="msgalert" > Nada encontrado ou fora de sua segmentação </span></center>';
     }


	 
while($array = mysqli_fetch_array($query)){
$s_artigo  = $array["Artigo"];
$s_descri  = $array["Descricao"];
$s_vitrine = $array["vitrine"];
$s_segment = $array["Segmentacao"];
$s_usage   = $array["Usage"];
$s_gender  = $array["Gender"];
$s_status  = $array["status"];
$s_segment = strtoupper($s_segment);
$s_usage = strtoupper($s_usage);
 
if(strstr($s_segment,"CORE"))    {  $s_segment = "<font color=\"#009900\">$s_segment</font>"; }
if(strstr($s_segment,"ENHANCED")){  $s_segment = "<font color=\"#FF9900\">$s_segment</font>"; }
if(strstr($s_segment,"TOP"))     {  $s_segment = "<font color=\"#FF3300\">$s_segment</font>"; }
if(strstr($s_segment,"TRAFFIC")) {  $s_segment = "<font color=\"#0000FF\">$s_segment</font>"; }
#----------------------------------------------------------------------------------
$query_cont = mysqli_query($con, "SELECT Artigo FROM `rbkne024_reebok`.`$tabela` WHERE Artigo = '$s_artigo'");
$cont_artigo = mysqli_num_rows($query_cont);
#--------------------------------------Formula----------------------
$s_vitrine = str_replace(",", ".", $s_vitrine);
$s_vitrine =  number_format($s_vitrine, 2, ',', '.'); 	
#--------------------------------------------------------------------

$s_origem = "";
#------------------------Tamanhos------------------------------------
$query_tam_sql = mysqli_query($con, "SELECT `tamanho`,`Categoria`,`Divisao`,`status`,`Origem`,`pag` FROM `rbkne024_reebok`.`$tabela` WHERE `Artigo` = '$s_artigo'")or die(mysql_error());
	 while($linha_query = mysqli_fetch_array($query_tam_sql))
   {
	$tamanho_query      = $linha_query["tamanho"];
	$categoria_query    = $linha_query["Categoria"];
	$s_tipo             = $linha_query["Divisao"];
	$s_status 		    = $linha_query["status"];
	$s_origem 		    = $linha_query["Origem"];
	$pag     		    = $linha_query["pag"];
	

if($s_origem == "Brasil" or $s_origem == "brasil" or $s_origem == "Brazil" or $s_origem == "brazil" ) {$s_origem = "<img src=\"../body/brasil.png\" class=\"bandeira\" />";}
else {$s_origem = "";}
	
#------------ Tamanhos diferentes dos nacionais------------------------------------------------ -------------------------------------
	
	$tudo .= "<span class=\"tmb\">$tamanho_query</span>";
	};
#------------ Novo filtro se quantidade por tamamho "somente acima de 4 tamanhos serão exibidos -------------------------------------
$lin_filtro = mysqli_num_rows($query_tam_sql);
    if($lin_filtro < 1 && $tipo == "Footwear" && $categoria_query <> "Swim") // verifica se retornou algum registro
	  { $filtro_tamanho = "style=\"display:none;\"";  }
	  else { $filtro_tamanho = ""; }
#------------------------------------------------------------------------------------------------------------------------------------	
		$s_colecao = "new_collection";
		$img_logo = "../../../favicon_1.ico";
#---------------------------------------------------------------------
#------------------Regra na procura da imagem------------------------------
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
#--------------------------------------------------------------------------

#------------Verifica se está na lista de produtos -------------------------------------
	$query_monst = mysqli_query($con, "SELECT `artigo` FROM `$banco`.`prevenda_monst_ss16` WHERE `artigo` = '$s_artigo'")or die(mysql_error());
	$filtro_monst = mysqli_num_rows($query_monst);
		if($filtro_monst == 0 ) {						
			$link_monst = "";}
		else {
 			$link_monst = "<span class=\"monst\">!</span>";}
               
#--------------------------------------------------------------------------
$img = "<img src=\"http://demandware.edgesuite.net/sits_pod27/dw/image/v2/AAJP_PRD/on/demandware.static/Sites-Reebok-ES-Site/Sites-reebok-products/es_ES/v1435338219819/zoom/".$s_artigo."_01.jpg\" style=\"max-height:120px;padding-top:10px;\"  />";
include"../body/artigo_pre.php";	
}
}

include"paginacao.php";	 
?>



</div>
</div>

</div>

</body>
</html>