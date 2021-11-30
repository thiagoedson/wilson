<?php
session_start();
include'conexao.php';
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"relatorio.xls\"" );
header ("Content-Description: adisul.com" );

?>
<style type="text/css">
.TEXTO {
color:#000FFF;
}

table {
font-size:8pt;}

.var {
 background-color:#FC6;
 }
</style>

<?php

$texto = "
<font size=\"-1\">
<table>
   <tr>
    <td  class=\"var\">Código Cliente</td>
    <td  class=\"var\">Código de Referência</td>
    <td  class=\"var\">Cliente</td>
    <td  class=\"var\">Telefone</td>
    <td  class=\"var\">Celular</td>
    <td  class=\"var\">Celular</td>
    <td  class=\"var\">E-mail</td>
    <td  class=\"var\">Grupo na Adidas</td>
    <td  class=\"var\">Grupo do Site</td>
    <td  class=\"var\">Usuario</td>
    <td  class=\"var\">Senha do Site</td>
    <td  class=\"var\">Status Crédito</td>
    <td  class=\"var\">Status no site</td>
    <td  class=\"var\">Segmentação</td>
    <td  class=\"var\">Código Segmentação</td>
    <td  class=\"var\">Cidade</td>
    <td  class=\"var\">Estado</td>
    <td  class=\"var\">Total SS13</td>
    <td  class=\"var\">Total FW13</td> 
    <td  class=\"var\">Último Acesso/Tentativa</td>  
  </tr>";
  
$texto = utf8_decode($texto);

echo $texto;

$query_site2 = mysqli_query($con,"SELECT * FROM login ORDER BY nome") or die(mysql_error());
#-----------------------------------------------------------------------------------------------
while($array_site2      = mysqli_fetch_assoc($query_site2)){	
	$rela_status    = $array_site2["status"];
	$rela_cliente   = $array_site2["B"];
	$rela_comprador = $array_site2["comprador"];
	$rela_email     = $array_site2["email"];
	$rela_login     = $array_site2["C"];
	$rela_pass      = $array_site2["D"];
	$rela_telefone  = $array_site2["telefone"];
	$rela_celular1  = $array_site2["celular1"];
	$rela_celular2  = $array_site2["celular2"];
	$over_cliente   = $array_site2["nome"];
	$segme_cliente  = $array_site2["segmento_2"];
	$over_cliente   = $array_site2["nome"];
	$nome_clientex  = $array_site2["loja"];
	$nome_cidade    = $array_site2["cidade"];
	$nome_estado    = $array_site2["UF"];
	$nome_refere    = $array_site2["cod_referencia"];
	
	$nome_cidade    = utf8_decode($nome_cidade);
	
	$segmenta = $segme_cliente;
	
	
	if($rela_status == "1") { $rela_status = "<font color=\"#000033\">Acesso Completo</font>";}
	elseif($rela_status == "2") { $rela_status = "<font color=\"#336600\">Acesso Limitado";}
	elseif($rela_status == "3") { $rela_status = "<font color=\"#FF0000\">Acesso Suspenso";}
	else  {$rela_status = "<font color=\"#FF0000\">Status Alterado infome este erro";}
	
	if($segmenta == "C03") {$v_segmento = "Especializada";}
	                elseif($segmenta == "C01") {$v_segmento = "Multi-Especialista de Imagem";}
			elseif($segmenta == "C02") {$v_segmento = "Multi-Especialista Comercial";}
			elseif($segmenta == "C04") {$v_segmento = "Generalista de Imagem";}
			elseif($segmenta == "C05") {$v_segmento = "Generalista Comercial";}
			elseif($segmenta == "C06") {$v_segmento = "Directional de Imagem";}
			elseif($segmenta == "C07") {$v_segmento = "Lifestyle de Imagem";}
			elseif($segmenta == "C08") {$v_segmento = "Lifestyle Comercial";}
			elseif($segmenta == "C09") {$v_segmento = "Fashion";}
			elseif($segmenta == "C10") {$v_segmento = "Loja Conceito";}
			$v_segmento = strtoupper($v_segmento);
			
			
			
			$query_site4 = mysqli_query($con,"SELECT * FROM clientes WHERE `Codigo Cliente` = '$rela_cliente'") or die(mysql_error());
                        #-----------------------------------------------------------------------------------------------
                        while($array_site4      = mysqli_fetch_assoc($query_site4)){	
	                $nome_cliente    = $array_site4["Cliente"]; 
					$nome_grupo      = $array_site4["Descricao do Grupo"];
					$nome_status     = $array_site4["Status do Credito"];}
					
			$query_site5 = mysqli_query($con,"SELECT * FROM `location_user` WHERE `codigo` = '$rela_cliente' ORDER BY `data` DESC LIMIT 1") or die(mysql_error());
                        #-----------------------------------------------------------------------------------------------
                        while($array_site5      = mysqli_fetch_assoc($query_site5)){	
	                $horaedata    = $array_site5["data"]; 
	                }
	 
	
	echo "
	<tr>
    <td>$rela_cliente</td>
    <td>$nome_refere</td>
    <td>$nome_clientex</td>
    <td>$rela_telefone</td>
    <td>$rela_celular1</td>
    <td>$rela_celular2</td>
    <td>$rela_email</td>
    <td>$nome_grupo</td>
    <td>$over_cliente</td>
    <td class=\"TEXTO\"> $rela_login </td>
    <td>$rela_pass</td>
    <td>$nome_status</td>
    <td>$rela_status</td>
    <td>$v_segmento</td>
    <td>$segme_cliente</td>
    <td>$nome_cidade</td>
    <td>$nome_estado</td>
    <td>X</td>
    <td>X</td>
    <td>$horaedata<td>
        </tr>";
    
    $nome_status = "";
    $v_segmento = "";
    $segmenta = "";
    $nome_grupo = "";
    $horaedata = "";
}

echo "</table></font>";