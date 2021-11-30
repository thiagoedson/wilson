<?php
include"conexao.php";

$status = "";
$loja_status = "1";
$barra_endereco = "";
$senha = $_SESSION["codigo"];
$ver_ifica = $_SESSION["valida"];
$var_status = $_SESSION["status_login"];
$sul = 1;
if($status == "3") {echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$barra_endereco."fail_2.html'>";}

#-------------------------------- Seleciona o banco do representante-------------------------------------------------

$query_cliente = mysqli_query($con, "SELECT `represe` FROM `$banco`.`login` WHERE `B` = '$senha'");
while($array_cl = mysqli_fetch_assoc($query_cliente))
{	
	$id_repre         = $array_cl["represe"];
	
}


$query_bd_represetante = mysqli_query($con, "SELECT `banco` FROM `rbkne024_reebok`.`usuarios` WHERE `id` = '$id_repre'");
while($array_bd = mysqli_fetch_assoc($query_bd_represetante))
{	
	$banco_representante         = $array_bd["banco"];
	
}	
	
#--------------------------------------------------------------------------------------------------------------------	


#-------------------------------------------------------

if ($ver_ifica == "") {echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php?erro=1'>";}
	
$site1 = mysqli_query($con, "SELECT * FROM `$banco`.`site`");
while($array_site = mysqli_fetch_assoc($site1)){	
	$colecao         = $array_site["colecao"];
	$data_atua       = $array_site["data_atua"];
	$titulo          = $array_site["titulo"];
	$carteira        = $array_site["carteira"];
	$faturamento     = $array_site["faturamento"];
	$situa_site      = $array_site["situa"];
	$cancelamento    = $array_site["cancelamento"];
	$loja_status     = $array_site["loja"];
}


$carteira    = date('d/m/Y', strtotime(str_replace("-", "/", $carteira )));
$faturamento    = date('d/m/Y', strtotime(str_replace("-", "/", $faturamento )));
$situa_site    = date('d/m/Y', strtotime(str_replace("-", "/", $situa_site )));
$cancelamento    = date('d/m/Y', strtotime(str_replace("-", "/", $cancelamento )));



#----------------------Dados do Usuario--------------------------------------------
$query_artigo = mysqli_query($con, "SELECT * FROM login WHERE `B` = '$senha'");
while($array_Artigo = mysqli_fetch_assoc($query_artigo)){	
	  $grupo        = $array_Artigo["nome"];
	  $nome_cliente = $array_Artigo["loja"];
	  $var_status   = $array_Artigo["status"];
	  $cnpj         = $array_Artigo["C"];
	  $segmentacao  = $array_Artigo["segmento_2"];
	  $email_senha  = $array_Artigo["email"];
	 
};

if($email_senha == "") {$email_senha = "<font color=\"#FF0000\">POR FAVOR CADASTRE SEU E-MAIL <a href=\"".$barra_endereco."info2.php\">AQUI</a></font> ";}

    if($segmentacao == "C01"){ $img_logo = "<img src=\"../favicon_1.ico\" title=\"Reebok\" />";}
elseif($segmentacao == "C02"){ $img_logo = "<img src=\"../favicon_1.ico\" title=\"Reebok\" />";}
elseif($segmentacao == "C03"){ $img_logo = "<img src=\"../favicon_1.ico\" title=\"Reebok\" />";}
elseif($segmentacao == "C04"){ $img_logo = "<img src=\"../favicon_1.ico\" title=\"Reebok\" />";}
elseif($segmentacao == "C05"){ $img_logo = "<img src=\"../favicon_1.ico\" title=\"Reebok\" />";}
elseif($segmentacao == "C06"){ $img_logo = "<img src=\"../favicon_1.ico\" title=\"Reebok\" />";}
elseif($segmentacao == "C07"){ $img_logo = "<img src=\"../favicon_1.ico\" title=\"Reebok\" />";}
elseif($segmentacao == "C08"){ $img_logo = "<img src=\"../favicon_1.ico\" title=\"Reebok\" />";}
elseif($segmentacao == "C09"){ $img_logo = "<img src=\"../favicon_1.ico\" title=\"Reebok\" />";}
elseif($segmentacao == "C10"){ $img_logo = "<img src=\"../favicon_1.ico\" title=\"Reebok\" />";}



 $id_seg = $segmentacao;
					$query_seg = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`segmento` WHERE `codigo` = '$id_seg'");
								while($row_seg = mysqli_fetch_assoc($query_seg)){	
								$segmentacao = $row_seg['rotulo'];
							
											        
								}


		 
	 $segmentacao = strtoupper($segmentacao);
	  

     if ($grupo == "SEM GRUPO") {$red = "#FFF000"; $text_msg = "";}
  
  elseif($grupo <> "SEM GRUPO" && $var_status == "2") {$red = "#FFF000"; $text_msg = "";}
		
  elseif($grupo <> "SEM GRUPO" && $var_status == "1") {
	  $text_msg ="
	<a href=\"#\" class=\"parent\" ><span>Ver carteira do grupo</span></a>
	<div>
	  <ul>           
                <li><a href=\"".$barra_endereco."carteira_grupo_ss.php\"><span>Ver Carteira </span></a></li>
                <li><a href=\"".$barra_endereco."xls/gera_carteira_grupo_ss.php\"><span>Exportar Excel </span></a></li>               
          </ul>
        </div>
        
	";}





?>