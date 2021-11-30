<?php 
$qnt = 25;
#------Config Tabela -------------
$barra_endereco = "../../";
$versao = "<p class=\"txt\">adisul.net </p><p class=\"versao\">V 8.0</p>";
$tile_shop = "<div id=\"ss16\"></div>";
$var_colecao = "ss16";
$tabela = "prevendass16";
$tabela_bd = "pedido_ss16";
$senha   =   $_SESSION["codigo"];
if($senha == "") {echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../../../fail_2.html'>";}


if(!(mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`$tabela`"))) { 
$status_banco = "<div id=\"status_banco\"><a href=\"../../principal.php\"><img src=\"img/gestao_icone.png\"></a></div>"; 
} else { 
$status_banco = ""; 

} 


#---------------------------------
$categoria = $_GET["categoria"];
$search    = $_GET["search"];
$tipo      = $_GET["tipo"];
$gender      = $_GET["gender"];

#---------- Daddos do Usuário ------------------------------------------------------------------------------------------------------
$user_carteira = $senha;
$segmentacao_sql = mysqli_query($con, "SELECT * FROM `$banco`.`login` WHERE `B` = '$senha'");
while($array_sS = mysqli_fetch_array($segmentacao_sql)){
		
	$nome_cliente       = $array_sS["loja"];
	$segmentacao        = $array_sS["segmento_2"];
	$segmentacao_2      = $array_sS["segmento_2"];
	$cnpj               = $array_sS["C"];
	$v_grupo            = $array_sS["nome"];
	$status_loja        = $array_sS["status"];
	$tipo_representante = $array_sS["represe"];
	$email_usuario      = $array_sS["email"];
	$e_represetante     = $array_sS["represe"];
	$e_min_c            = $array_sS["min_c"];
	$e_min_t            = $array_sS["min_t"];
	$e_min_e            = $array_sS["min_e"];
	}
	
#--------------- Valor do ICMS do representante ------------------------------------------------------------------------------------

$icms_query = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`usuarios` WHERE `id` = '$e_represetante'");
while($array_icms = mysqli_fetch_array($icms_query)){
	
	$sul      = $array_icms["icms"];
	$bd_repre = $array_icms["banco"];
	
	}
	
	
#------------------------------------------------------------------------------------------------------------------------------------
#------- Condição caso o e-mail do usuário este vazio--------------------------------------------------------------------------------
if($email_usuario == "") {$email_usuario = "<a href=\"../../info2.php\" style=\"color:#F00;\">POR FAVOR CADASTRE SEU E-MAIL ANTES DE INICIAR SEU PEDIDO! <u>clique aqui</u></a>";}


$p_verifica = mysqli_query($con, "SELECT * FROM  `pedido_ss16`  WHERE  `cliente` = '$senha' AND `status` = '1'");
while($array_pedido = mysqli_fetch_array($p_verifica)){
      $p_status = $array_pedido["status"];
	  $npedido  = $array_pedido["npedido"];
	  $p_pedido = $array_pedido["npedido"];
	  $p_hora_inicial  = $array_pedido["hora_1"];
	  $p_data_inicial  = $array_pedido["data_1"];
	  $obs_pedido      = $array_pedido["obs"];
	  
	  $p_data_inicial    = date('d/m/Y', strtotime(str_replace("-", "/", $p_data_inicial )));
	  
	  }
	  if($p_status == "1") {
		  
		  
		  #-----------------------------------------------------------------------------------------------------------------------------
				 $c_verifica = mysqli_query($con, "SELECT `segmento_2`,`loja` FROM  `login` WHERE  `B` = '$senha'");
					while($array_c = mysqli_fetch_array($c_verifica)){      				
					$segmentacao = $array_c["segmento_2"];						
					$nome_cliente_filho = $array_c["loja"];
					$user_carteira = $p_cliente_filho;
					}
	 				
	   #----------------------------------------------------------------------------------------------------------------------------		  
		  $_SESSION['npedido'] =  $p_pedido;
		  $p_menu = "<a  href=\"car.php?categoria=$categoria&tipo=$tipo&gender=$gender\">Enviar Pedido $npedido</a>
		  			 <a  href=\"car.php?categoria=$categoria&tipo=$tipo&gender=$gender\">Ver Carrinho $npedido </a>
					 <a  href=\"list.php\"  title=\"Ver lista de produtos marcados\">Lista</a>";
					
					$p_car = "<a href=\"list.php\" id=\"lista\" title=\"Ver lista de produtos marcados\">Lista</a>";
					}
		  
	  elseif($p_status == "2") {
		  $_SESSION['npedido'] =  $p_pedido;
		  $p_menu = "<a href=\"".$PHP_SELF."?iniciarPedidos&tipo=$tipo&categoria=$categoria&gender=$gender\" >Iniciar Compra</a>";}
		  
	 
		  
	  else {
		  $p_menu = "<a href=\"".$PHP_SELF."?iniciarPedidos&tipo=$tipo&categoria=$categoria&gender=$gender\" >Iniciar Compra</a>";}	  


 $id_seg = $segmentacao;
					$query_seg = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`segmento` WHERE `codigo` = '$id_seg'");
								while($row_seg = mysqli_fetch_array($query_seg)){	
								$segmentacao = $row_seg['rotulo'];
								if($data_seg == "") {$data_seg = "-";}
											        
								}


		 
	 $segmentacao = strtoupper($segmentacao);
	 



if (isset($_GET['iniciarPedidos'])){
	
iniciarPedidos($con);
}
if (isset($_GET['excluirartigos'])){
	
excluirartigos($con);
}

if (isset($_GET['fecharPedidos'])){
	
fecharPedidos($con);
}

if (isset($_GET['inserirArtigos'])){
	
inserirArtigos($con);
}

if (isset($_GET['excluirLista'])){
	
excluirLista($con);
}

#---------------------------Funções------------------------------------------------------------------------------------------------------------	
function excluirLista($con) {
	$id = $_GET["id"];


$resultado_npedido = mysqli_query($con, "DELETE  FROM `lista_ss16` WHERE `id` = '$id'") or die(mysql_error());


}
	
function fecharPedidos($con){	
	$tabela_bd = "pedido_ss16";      
	$p_status_pedido =  $_SESSION['npedido'];
	$senha = $_SESSION['codigo'];	
	$p_status = "2";
	$data_atua = date('Y-m-d');	
	$timestamp = mktime(date("H")+21, date("i"), date("s"),  0);		
	$hora = gmdate("H:i:s", $timestamp);
	
    $resultado_npedido = mysqli_query($con, "UPDATE `$tabela_bd` SET `status` = '$p_status' ,`data_2` = '$data_atua', `hora_2` = '$hora' WHERE  `npedido` = '$p_status_pedido'");
	$info_npedido = mysqli_query($con, "SELECT * FROM `$tabela_bd` WHERE  `npedido` = '$p_status_pedido'");	
	while($array_em = mysqli_fetch_array($info_npedido)){	  
	  $em_cliente              = $array_em["cliente"];	  
	  $em_data                 = $array_em["data_1"];
	  $em_data_2			   = $array_em["data_2"];
	  $em_hora_1               = $array_em["hora_1"];
	  $em_hora_2               = $array_em["hora_2"];
	  $em_total                = $array_em["total"];
	  
	  $em_data= date('d/m/Y', strtotime(str_replace("-", "/", $em_data)));
	  $em_data_2= date('d/m/Y', strtotime(str_replace("-", "/", $em_data_2)));	
	  $em_total =  number_format($em_total, 2, ',', '.');  
     }  
	 
	 $corpo_npedido = mysqli_query($con, "SELECT * FROM `login` WHERE `B` = '$em_cliente'"); 
	while($array_emp = mysqli_fetch_array($corpo_npedido)){		
	  $emp_loja       = $array_emp["loja"];			  
	  $e_comprador    = $array_emp["comprador"];
	  $e_senha        = $array_emp["D"];
	  $e_email        = $array_emp["email"];	
	  $e_represe      = $array_emp["represe"];	  
	  $e_email = str_replace(";", ",", $e_email);
	  
	    
     }
#--------------- Valor do ICMS do representante ------------------------------------------------------------------------------------

$icms_query = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`usuarios` WHERE `id` = '$e_represe'");
while($array_icms = mysqli_fetch_array($icms_query)){
	
	
	$repre_region = $array_icms["region"];
	$emailrepre   = $array_icms["email"];
	$repre_titulo = $array_icms["titulo"];
	$barrarepre   = $array_icms["endereco"];
	
	}
	
	
#------------------------------------------------------------------------------------------------------------------------------------
#----------Email 1 ------------------------------------------------------------------------------------------------------------------------------------------
	
	$assunto = "REEBOK - Notificação de Pedido - ADISUL";	

    $html = "
    <html>
    <body>
    <div bgcolor=\"#FFFFFF\" marginwidth=\"0\" marginheight=\"0\">

<div align=\"center\">
<table width=\"600\" height=\"622\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" background=\"http://adisul.net/img/email/Mensageiro_02.jpg\">
		<tbody><tr>
			<td height=\"169\">
			<img src=\"http://adisul.net/img/email/Mensageiro_01.jpg\" width=\"600\" height=\"169\" alt=\"\"></td>
		</tr>
		<tr>
			<td valign=\"top\" style=\"background-image:url(http://adisul.net/img/email/Mensageiro_02.jpg);background-repeat:repeat-y;padding-left:50px;padding-right:50px\">
			
			
    <table border=\"0\" width=\"100%\">
    	<tbody><tr>
    		<td><font face=\"Arial\" size=\"-1\">Olá $e_comprador !</font><p><br>
    		<font face=\"Arial\" size=\"-1\">
            Atenção este e-mail é somente uma <b>NOTIFICAÇÃO</b> que seu pedido <b>$p_status_pedido</b> feito no site adisul.net,
            lembrando que a disponibilidade contida no site é de nível Brasil podendo ocorrer termino de estoque ao qualquer momento.<br />
  		    Por tanto pedimos que fique atento ao Relatório de Carteira nos próximos dias, pois no mesmo estará a confirmação dos produtos solicitados.<br />
            <br>

            No menu Minha Loja > Meus Pedidos você vai opção de cópia deste pedido.<br /></font></p>
    		<p><b><font face=\"Arial\"><br><br>
            Número do pedido <b>$p_status_pedido</b><br />
   			Pedido feito por  <b>$emp_loja | $em_cliente </b><br />	
            Data inicio do pedido : $em_data <br/>
	        Data de envio do pedido : $em_data_2  <br />
            Total do Pedido <b> R$ $em_total </b><br/>
            </font></b></p><br>
    		<p> </p>
            
    		</td>
    	</tr>
    </tbody></table>
    
			<hr>
			</td>
		</tr>
		<tr>
			<td valign=\"top\" style=\"background-image:url(http://adisul.net/img/email/Mensageiro_02.jpg);background-repeat:repeat-y;padding-left:50px;padding-right:50px\" height=\"76\">
			
			<font face=\"Arial\" size=\"-5\"> Representante $repre_titulo<br />
			Região $repre_region - $emailrepre
            </font> 
            <br>

			<a href=\"http://www.adisul.net\" target=\"_blank\">www.adisul.net</a></font></p></td>
		</tr>
		<tr>
			<td height=\"66\">
			<img src=\"http://adisul.net/img/email/Mensageiro_03.jpg\" width=\"600\" height=\"66\" alt=\"\"></td>
		</tr>
	</tbody></table>
    </div>

   
   </body>
   </html>";  

   $html = utf8_decode($html);
   $assunto = utf8_decode($assunto);
   $headers  = 'MIME-Version: 1.0' . "\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $headers .= 'From: adisul@adisul.net' . "\r\n" .
               'Reply-To: adisul@adisul.net , '.$emailrepre .'' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
               $e_emailx = $e_email;

   mail($e_emailx, $assunto, $html, $headers);
   
#----------Email 2 ------------------------------------------------------------------------------------------------------------------------------------------

	
	$assunto = "REEBOK - PEDIDO N $p_status_pedido PRÉ-VENDA SS16 - ADISUL";	

    $html = "
    <html>
    <body>
    <img src=http://www.rbk.net.br/img/email/prevenda.jpg /> <BR/>
<font size=\"-1\">
    Caro usuário este e-mail acompanha o link para download do mesmo.<br />
	Qualquer dúvida para acesso a este link entre em contato.	
    
    <br/>
    <br/>
	
    Número do pedido <b>$p_status_pedido</b><br />
	Pedido feito por  <b>$emp_loja | $em_cliente </b><br /><br />
	
	Data inicio do pedido : $em_data  | $em_hora_1<br/>
	Data de envio do pedido : $em_data_2 |  $em_hora_2<br />
	Total do Pedido <b> R$ $em_total </b><br/>
	<br />
	
	<a href=\"".$barrarepre."/order/ordens/xls_pedido_ss16.php?npedido=$p_status_pedido&var=3\" >
	<img src=\"http://adisul.net/public/mail/ss12/dow.jpg\" title=\"Download do Pedido\" alt=\"Download do Pedido\" /></a>
	<br />
	<br />
	<i>Atenção: para garantir sucesso no download do pedido certifique-se que esteja usando o navegador Google Chrome e/ou Mozilla Firefox.</i><br />
	<a href=\"https://www.google.com/intl/pt-BR/chrome/browser/?hl=pt-br\" title=\"Download Google Chrome\"><img src=\"http://adisul.net/public/mail/ss12/google.jpg\" /></a> 
	<a href=\"http://www.mozilla.org/pt-BR/firefox/new/\" title=\"Download Mozilla Firefox\"><img src=\"http://adisul.net/public/mail/ss12/firefox.jpg\" /></a>
	<br />
    <br />
	<br />
	

	 <img src=http://www.rbk.net.br/img/email/prevendafooter.jpg /> <br/>
	 <font size=\"-5\"> Representante $repre_titulo<br />
	  Região $repre_region - $emailrepre
     </font> 
    <br/>
    <br/>
    <br/>
</font>
   <br/>
   $sql_html
   
   </body>
   </html>"; 

   $html = utf8_decode($html);
   $assunto = utf8_decode($assunto);
   $headers  = 'MIME-Version: 1.0' . "\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $headers .= 'From: adisul@adisul.net' . "\r\n" .
               'Reply-To: adisul@adisul.net , $emailrepre' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
               

   mail($emailrepre, $assunto, $html, $headers);
	
	echo "<meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = vouncher.php?tipo=dispo\">";
	}  
	
	
		
function iniciarPedidos($con){
	
	$tabela_bd = "pedido_ss16";
	$divisao = $_GET["tipo"];
	$categoria = $_GET["categoria"];
	$gender= $_GET["gender"];
	$numeros = 0;
	$shop = $_GET["shop"];
	$senha   =   $_SESSION["codigo"];
	#----------------Verifica ------------------------------
	$setem_mysql = mysqli_query($con, "SELECT * FROM pedido_ss16 WHERE cliente = '$senha' AND `status` = '1'");
	$reg_semtem = mysqli_fetch_row($setem_mysql);
	
	if($reg_semtem > 1) { echo "dispo.php?tipo=$divisao&categoria=$categoria&gender=$gender";}
	else {
	
    $reg[0] = 0;
    while($reg[0] == $numeros){
    $numeros = rand(100000, 999999);
    $resultado_npedido = mysqli_query($con, "SELECT npedido FROM pedido_ss16 WHERE npedido = '$numeros';");
    $reg = mysqli_fetch_row($resultado_npedido);
    }
	
	
	 $corpo_npedido = mysqli_query($con, "SELECT * FROM `login` WHERE `B` = '$senha'"); 
	while($array_emp = mysqli_fetch_array($corpo_npedido)){		
	  $razao       = $array_emp["loja"];		}
	#----------------------- dados iniciais -----------------------------------------------------------------------------------------------------
	
	$p_status = "1";
	$obs = "";
	$confirmado = "1";
	$data_1 = date('Y-m-d');
	$data_2 = date('Y-m-d');
	$p_nome = $_POST["codadidas"];
	$_SESSION['npedido'] = $numeros;
	$senha = $_SESSION["codigo"];
	$timestamp = mktime(date("H")+21, date("i"), date("s"),  0);
	$hora_1 = gmdate("H:i:s", $timestamp);
	$hora_2 = gmdate("H:i:s", $timestamp);	
	$total = "0";
	
	
	if($p_nome == "0") {$p_nome = $senha;}
	
	if($senha == "") { echo "<meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = dispo.php?tipo=$divisao&categoria=$categoria&gender=$gender\">";}
	
$resultado_npedido = mysqli_query($con, "INSERT INTO  pedido_ss16 (`id` ,
															`npedido` ,
															`cliente` ,
															`razao` ,
															`data_1` ,
															`data_2` ,
															`hora_1` ,
															`hora_2` , 
															`status`, 
															`total`,
															`obs`,
															`confirmado`) VALUES (NULL ,
															'$numeros', 
															'$senha', 
															'$razao',
															'$data_1', 
															'$data_2', 
															'$hora_1', 
															'$hora_2', 
															'$p_status', 
															'$total',
															'$obs',
															'$confirmado')");
 
 	if($shop <> "") {
		echo "<meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = shop.php?artigo=$shop\">";}
		else{
	echo "<meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = dispo.php?tipo=$divisao&categoria=$categoria&gender=$gender\">";
		}
	}
	}


#--------------------------- Adicionar artigos ao pedido -------------------------------------

function inserirArtigos($con){	
	      
	$li_npedido    = $_POST['npedido'];
	$li_artigo     = $_POST["artigo"];
	$li_data       = $_POST["data_6"];
	$li_quantidade = $_POST["quantidade"];
	$li_tamanho    = $_POST["tamanho"];
	$li_valor      = $_POST["valor"];	
	$li_descricao  = $_POST["descricao"];	
	$li_segmento   = $_POST["segmento"];
	$li_divisao    = $_POST["divisao"];
	$li_categoria  = $_POST["categoria"];	
	$li_loja       = $_POST["desta"];
	$li_multi      = $_POST["multi"];
	
	if($li_loja == ""){echo("<script>alert('Não foi possivel adicionar ao seu pedido, por favor selecione pelo menos uma loja');</script><meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = window.php?artigo=$li_artigo\">");
	exit;echo"<meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = window.php?artigo=$li_artigo\">"; }
	
	

	
	
		

	
		
	
	#-------------fim do Tratamento da data do artigo---------------------------
    if($li_data) {
    foreach($li_data as $key => $sli_data_2){	
	foreach($li_loja as $key => $sli_loja){
	
	foreach($li_quantidade as $key => $sli_quantidade) {
		
		$sli_quantidade = $sli_quantidade * $li_multi;
		
#----------------Multiplica quantidade por valor--------------------------------
		
	$li_valor = str_replace(",", ".", $li_valor );
	$li_total = $sli_quantidade * $li_valor;	
#-------------------------------------------------------------------------------

	
    $insert_artigo = mysqli_query($con, "INSERT INTO  `lista_artigo_pedido_ss16` (`id` ,`npedido` ,`loja`, `artigo` ,`descricao` ,`segmento` ,`divisao`, `categoria`,`data` ,`quantidade` ,`tamanho` ,`valor` ,`total`) VALUES (NULL , '$li_npedido', '$sli_loja', '$li_artigo','$li_descricao', '$li_segmento', '$li_divisao', '$li_categoria', '$sli_data_2', '$sli_quantidade', '$li_tamanho[$key]', '$li_valor', '$li_total')") or die(mysql_error());
	
	
	$data_atua = date('Y-m-d');	
	$timestamp = mktime(date("H")+21, date("i"), date("s"),  0);
	$hora = gmdate("H:i:s", $timestamp);
	
    $resultado_npedido = mysqli_query($con, "UPDATE `$tabela_bd` SET `data_2` = '$data_atua' , `hora_2` = '$hora'  WHERE  `npedido` = '$li_npedido'");
	
	
    }
	}
	}
    if($insert_artigo == true){
    echo("<script>alert('ADICIONADO COM SUCESSO');window.opener=self;self.close();</script>");
    }
    else{
    echo ("<script>alert('Não foi possível atender seu pedido');</script>");
    }
	$vazio = "";
	$zero = "0";
    //inicia a query para inserir 
#    $resultado_npedido = mysqli_query($con, "INSERT INTO  `lista_artigo_pedido` (`id` ,`npedido` ,`artigo` ,`data` ,`quantidade` ,`tamanho`) VALUES (NULL , '$li_npedido', '$li_artigo', '$li_data', '$li_quantidade', '$li_tamanho')") or die(mysql_error());
	$sql_limpa = mysqli_query($con, "DELETE  FROM `lista_artigo_pedido_ss16` WHERE `quantidade` = '$vazio' AND `npedido` = '$li_npedido'") ;
	$sql_limpa_2 = mysqli_query($con, "DELETE  FROM `lista_artigo_pedido_ss16` WHERE `quantidade` = '$zero' AND `npedido` = '$li_npedido'") ;
    // Faz loop pelo array do cliente
#    foreach($_POST["quantidade"] as $key => $value) {(NULL , '$li_npedido', '$li_artigo', '$li_data', '$li_quantidade', '$li_tamanho'") or die(mysql_error()";
	$somar_total_pedido = mysqli_query($con, "SELECT SUM(total) as soma FROM  `lista_artigo_pedido_ss16`  WHERE  `npedido` = '$p_pedido'") or die(mysql_error());
    while($linha_array_ee = mysqli_fetch_array($somar_total_pedido)){$linha_ee = $linha_array_ee["soma"];}
	
    $atua_total_pedido = mysqli_query($con, "UPDATE `$banco`.`pedido_ss16` SET `total` = '$linha_ee'  WHERE  `npedido` = '$p_pedido'"); 
    echo "<meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = window.php?artigo=$li_artigo\">";
	
}
}


function excluirartigos($con){
	$loja_ex            = $_GET["loja"];
	$li_artigo          = $_GET["artigo"];	
	$p_pedido           = $_GET["pedido"];
	$sqlpedido_data     = $_GET["data"];	
	$sql_limpa_artigo   = mysqli_query($con, "DELETE FROM `lista_artigo_pedido_ss16` WHERE `artigo` = '$li_artigo' AND `npedido` = '$p_pedido' AND `data` = '$sqlpedido_data' AND `loja` = '$loja_ex'") ;
	$data_atua = date('Y-m-d');	
	$timestamp = mktime(date("H")+21, date("i"), date("s"),  0);
	$hora = gmdate("H:i:s", $timestamp);
	
    $resultado_npedido = mysqli_query($con, "UPDATE `$tabela_bd` SET `data_2` = '$data_atua' , `hora_2` = '$hora'  WHERE  `npedido` = '$li_npedido'");
	$somar_total_pedido = mysqli_query($con, "SELECT SUM(total) as soma FROM  `lista_artigo_pedido_ss16`  WHERE  `npedido` = '$p_pedido'") or die(mysql_error());
    while($linha_array_ee = mysqli_fetch_array($somar_total_pedido)){$linha_ee = $linha_array_ee["soma"];}
	
    $atua_total_pedido = mysqli_query($con, "UPDATE `$banco`.`pedido_ss16` SET `total` = '$linha_ee'  WHERE  `npedido` = '$p_pedido'"); 
	echo "<meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = car.php\">";
	}

?>