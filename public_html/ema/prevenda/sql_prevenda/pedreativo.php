<?php
$senha = $_SESSION['codigo'];

if($senha == "") {header("location:../index.php?erro=22");}
$user_carteira = $senha;
$sul = 1;

$segmentacao_sql = mysql_query("SELECT `segmento_2`, `loja` FROM login WHERE `B` = '$senha'");
while($array_s = mysql_fetch_array($segmentacao_sql)){
	$segmentacao = $array_s["segmento_2"];
	$nome_cliente_pai = $array_s["loja"];
	}


$p_verifica = mysql_query("SELECT * FROM  prevendafw12  WHERE  cliente = '$senha' AND status = '1'");
while($array_pedido = mysql_fetch_array($p_verifica)){
      $p_status        = $array_pedido["status"];
	  $p_pedido        = $array_pedido["npedido"];
	  $p_cliente_filho = $array_pedido["cliente_filho"];
	  $p_hora          = $array_pedido["hora"];
	  $p_data          = $array_pedido["data_pedido"];
	  $p_data          = date('d/m/Y', strtotime(str_replace("-", "/", $p_data )));
	  }
	  if($p_status == "1") {
	   #-----------------------------------------------------------------------------------------------------------------------------
				 $c_verifica = mysql_query("SELECT * FROM  login  WHERE  `B` = '$p_cliente_filho'");
					while($array_c = mysql_fetch_array($c_verifica)){
      				$segmentacao        = $array_c["segmento_2"];	
					$nome_cliente_filho = $array_c["loja"];
					$user_carteira      = $p_cliente_filho; 					
					
	   #----------------------------------------------------------------------------------------------------------------------------
		 
		  $_SESSION['npedido'] =  $p_pedido;
		  $p_menu = "<a  href=\"car.php\" class=\"link3\">Enviar Pedido</a>
		 
		  
	                 <a  href=\"car.php\" class=\"link4\">Ver Carrinho Nº $p_pedido</a>";}
		   }
	  elseif($p_status == "2") {
		  $_SESSION['npedido'] =  $p_pedido;
		  $p_menu = "<a href=\"#dialog\" name=\"modal\" class=\"link3\">Iniciar Compra</a>";}
		  
	 
		  
	  else {
		  $p_menu = "<a href=\"#dialog\" name=\"modal\" class=\"link3\">Iniciar Compra</a>";}
		  
	
if    ($segmentacao == "C01") { $segmentacao = "Multi-Especialista de Imagem";}
elseif($segmentacao == "C02") { $segmentacao = "Multi-Especialista Comercial";}
elseif($segmentacao == "C03") { $segmentacao = "Especializada";}
elseif($segmentacao == "C04") { $segmentacao = "Generalista Esportivo de Imagem";}
elseif($segmentacao == "C05") { $segmentacao = "Generalista Esportivo Comercial";}
elseif($segmentacao == "C06") { $segmentacao = "Directional de Imagem";}
elseif($segmentacao == "C07") { $segmentacao = "Lifestyle de Imagem";}
elseif($segmentacao == "C08") { $segmentacao = "Lifestyle Comercial";}
elseif($segmentacao == "C09") { $segmentacao = "Fashion";}
elseif($segmentacao == "C10") { $segmentacao = "Loja Conceito";}
else                          { $segmentacao = "ALL";}
		  
$segmentacao = strtoupper($segmentacao); 


$rodape_fixo = "<!-- LiveZilla Chat Button Link Code (ALWAYS PLACE IN BODY ELEMENT) --><div style=\"text-align:center;width:200px;\"><a href=\"javascript:void(window.open('http://chat.adisul.com/chat.php','','width=590,height=610,left=0,bottom=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes'))\"><img src=\"http://chat.adisul.com/image.php?id=04&amp;type=inlay\" width=\"200\" height=\"50\" border=\"0\" alt=\"LiveZilla Live Help\"></a><div style=\"margin-top:2px;\"></div></div><!-- http://www.LiveZilla.net Chat Button Link Code --><!-- LiveZilla Tracking Code (ALWAYS PLACE IN BODY ELEMENT) --><div id=\"livezilla_tracking\" style=\"display:none\"></div><script type=\"text/javascript\">
var script = document.createElement(\"script\");script.type=\"text/javascript\";var src = \"http://chat.adisul.com/server.php?request=track&output=jcrpt&nse=\"+Math.random();setTimeout(\"script.src=src;document.getElementById('livezilla_tracking').appendChild(script)\",1);</script><noscript><img src=\"http://chat.adisul.com/server.php?request=track&amp;output=nojcrpt\" width=\"0\" height=\"0\" style=\"visibility:hidden;\" alt=\"\"></noscript><!-- http://www.LiveZilla.net Tracking Code -->
</div>
";


if (isset($_GET['iniciarPedidos'])){
	
iniciarPedidos();
}
if (isset($_GET['excluirartigos'])){
	
excluirartigos();
}

if (isset($_GET['fecharPedidos'])){
	
fecharPedidos();
}

if (isset($_GET['inserirArtigos'])){
	
inserirArtigos();
}

if (isset($_GET['limpa'])){
	
limpa();
}

#---------------------------Funções------------------------------------------------------------------------------------------------------------	
	
function fecharPedidos(){	
	      
	$p_status_pedido =  $_SESSION['npedido'];
	$senha = $_SESSION['codigo'];	
	$p_status = "2";
	$data_atua = date('Y-m-d');
	
	$timestamp = mktime(date("H")+21, date("i"), date("s"),  0);
	$hora = gmdate("H:i:s", $timestamp);
	
        $resultado_npedido = mysql_query("UPDATE prevendafw12 SET `status` = '$p_status' ,`data_pedido` = '$data_atua', `hora` = '$hora' WHERE  `npedido` = '$p_status_pedido'");
	$info_npedido = mysql_query("SELECT * FROM prevendafw12 WHERE  `npedido` = '$p_status_pedido'");	
	while($array_em = mysql_fetch_array($info_npedido)){	  
	  $em_cliente              = $array_em["cliente"];
	  $em_cliente_filho        = $array_em["cliente_filho"];
	  $em_data                 = $array_em["data_pedido"];
	  $em_total                = $array_em["total"];
	  
	  $em_data= date('d/m/Y', strtotime(str_replace("-", "/", $em_data)));	
	  $em_total =  number_format($em_total, 2, ',', '.');  
     }  
	 
	 $corpo_npedido = mysql_query("SELECT * FROM login WHERE `B` = '$em_cliente'"); 
	while($array_emp = mysql_fetch_array($corpo_npedido)){		
	  $emp_loja       = $array_emp["loja"];	        
	  $e_comprador    = $array_emp["comprador"];
	  $e_senha        = $array_emp["D"];
	  $e_email        = $array_emp["email"];	
	  
	  $e_email = str_replace(";", ",", $e_email);
	  
	   $corpo_npedido_fil = mysql_query("SELECT * FROM login WHERE `B` = '$em_cliente_filho'"); 
	while($array_emp_fil = mysql_fetch_array($corpo_npedido_fil)){		
	  $emp_loja_fil       = $array_emp_fil["loja"];	 }       
	  
	    
     }
#----------Email Represetante------------------------------------------------------------------------------------------------------------------------------------
	 
	 $represetante_sql = mysql_query("SELECT `email`,`endereco` FROM `adisul_adidas`.`usuarios` WHERE `id` = '4'"); 
	while($array_repre = mysql_fetch_array($represetante_sql)){		
	  $emailrepre   = $array_repre["email"];
	  $barrarepre   = $array_repre["endereco"];	
		}
#----------Email 1 ------------------------------------------------------------------------------------------------------------------------------------------

	
	$assunto = "ADIDAS - Comprovante do pedido FW12 - ADISUL";	

    $html = "
    <html>
    <body>
    <img src=http://www.adisul.com/images/header.png /> <BR/>

    
    Atenção este e-mail é somente uma <b>NOTIFICAÇÃO</b> que seu pedido feito no site adisul.com,<br/>
    lembrando que a disponibilidade contida no site é de nível Brasil podendo ocorrer termino de estoque ao qualquer momento.<br />
    Por tanto pedimos que fique atento ao Relatório de Carteira nos próximos dias, pois no mesmo estará a confirmação dos produtos solicitados,<br />
    ou no menu Minha Loja > Meus Pedidos .<br />
    

    Número do pedido <b>$p_status_pedido</b><br />
    Pedido feito por  <b>$emp_loja | $em_cliente </b><br />	
    Data do pedido : $em_data <br/>
    Total do Pedido <b> R$ $em_total </b><br/>
	
	
		
    <br/>
    <br/>
    <br/>

    <img src=http://www.adisul.com/prevenda/imagens/email_fw12.jpg />
   <br/>
   $sql_html
   
   </body>
   </html>";  

   $html = utf8_decode($html);
   $headers  = 'MIME-Version: 1.0' . "\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $headers .= 'From: adisul@adisul.com' . "\r\n" .
               'Reply-To: adisul@adisul.com , $emailrepre' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
               $e_emailx = $e_email;

   mail($e_emailx, $assunto, $html, $headers);
   
#----------Email 2 ------------------------------------------------------------------------------------------------------------------------------------------

	
	$assunto = "ADIDAS - PEDIDO PREVENDA FW12 $emp_loja_fil | $em_cliente_filho - ADISUL";	

    $html = "
    <html>
    <body>
    <img src=http://www.adisul.com/images/header.png /> <BR/>
	Pedido Pré Venda FW12
    
    <br/>
    <br/>

    Número do pedido <b>$p_status_pedido</b><br />
	Pedido feito por  <b>$emp_loja | emp_loja_fil / $em_cliente </b><br /><br />
	
	<a href=\"$barrarepre/ordens/xls_pedido_fw12.php?npedido=$p_status_pedido&var=3\" >Download do Pedido</a>
	
    <br/>
    <br/>
    <br/>

    <img src=http://www.adisul.com/prevenda/imagens/email_fw12.jpg />
   <br/>
   $sql_html
   
   </body>
   </html>";  

   $html = utf8_decode($html);
   $headers  = 'MIME-Version: 1.0' . "\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $headers .= 'From: adisul@adisul.com' . "\r\n" .
               'Reply-To: adisul@adisul.com , $emailrepre' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
              

   mail($emailrepre, $assunto, $html, $headers);
	
	echo "<meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = vouncher.php?tipo=dispo\">";
	}  
	
	
	
	
	
	
function iniciarPedidos(){
	
	$divisao = $_GET["tipo"];
	$categoria = $_GET["categoria"];
	$numeros = 0;
	$shop = $_GET["shop"];
    $reg[0] = 0;
    while($reg[0] == $numeros){
    $numeros = rand(0, 2000);
    $resultado_npedido = mysql_query("SELECT npedido FROM prevendafw12 WHERE npedido = '$numeros';");
    $reg = mysql_fetch_row($resultado_npedido);
    }
	#----------------------- dados iniciais -----------------------------------------------------------------------------------------------------
	
	$p_status = "1";
	$data_pedido = date('Y-m-d');
	$p_nome = $_POST["codadidas"];
	$_SESSION['npedido'] = $numeros;
	$senha = $_SESSION["codigo"];
	$timestamp = mktime(date("H")+21, date("i"), date("s"),  0);
	$hora = gmdate("H:i:s", $timestamp);	
	$total = "0";
	
	if($p_nome == "0") {$p_nome = $senha;}
	
$resultado_npedido = mysql_query("INSERT INTO  prevendafw12 (`id` ,`npedido` ,`cliente` ,`cliente_filho` ,`data_pedido` ,`hora` ,`status` ,`total`) VALUES (NULL ,'$numeros', '$senha', '$p_nome', '$data_pedido', '$hora', '$p_status', '$total')");
 
 	if($shop <> "") {
		echo "<meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = shop.php?artigo=$shop\">";}
		else{
	echo "<meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = index.php?tipo=$divisao&categoria=$categoria\">";
		}
	}


#--------------------------- Adicionar artigos ao pedido -------------------------------------

function inserirArtigos(){	
	      
	$li_npedido    = $_SESSION['npedido'];
	$li_artigo     = $_POST["artigo"];
	$li_data       = $_POST["data"];
	$li_quantidade = $_POST["quantidade"];
	$li_tamanho    = $_POST["tamanho"];
	$li_valor      = $_POST["valor"];	
	$li_descricao  = $_POST["descricao"];	
	$li_segmento   = $_POST["segmento"];	
	
	
	$li_data = date('Y-m-d', strtotime(str_replace("/", "-", $li_data )));
	
	
	 
	
	foreach($li_quantidade as $key => $sli_quantidade) {
		
#----------------Multiplica quantidade por valor--------------------------------
		
	$li_valor = str_replace(",", ".", $li_valor );
	$li_total = $sli_quantidade * $li_valor;	
#-------------------------------------------------------------------------------
		
#------------------Grades Fechadas --------------------------------------------		


	
    $insert_artigo = mysql_query("INSERT INTO  lista_artigo_pedido_fw12 (`id` ,`npedido` ,`artigo` ,`descricao` ,`segmento` ,`data` ,`quantidade` ,`tamanho` ,`valor` ,`total`) VALUES (NULL , '$li_npedido', '$li_artigo','$li_descricao', '$li_segmento', '$li_data', '$sli_quantidade', '$li_tamanho[$key]', '$li_valor', '$li_total')") or die(mysql_error());
    }
  
    if($insert_artigo == true){
    echo("<script>alert('ADICIONADO COM SUCESSO');</script>");
    }
    else{
    echo("<script>alert('ERRO');</script>");
    }
	$vazio = "";
    //inicia a query para inserir 
#    $resultado_npedido = mysql_query("INSERT INTO  `lista_artigo_pedido` (`id` ,`npedido` ,`artigo` ,`data` ,`quantidade` ,`tamanho`) VALUES (NULL , '$li_npedido', '$li_artigo', '$li_data', '$li_quantidade', '$li_tamanho')") or die(mysql_error());
	$sql_limpa = mysql_query("DELETE  FROM lista_artigo_pedido_fw12 WHERE `quantidade` = '$vazio' AND `npedido` = '$li_npedido'") ;
    // Faz loop pelo array do cliente
#    foreach($_POST["quantidade"] as $key => $value) {(NULL , '$li_npedido', '$li_artigo', '$li_data', '$li_quantidade', '$li_tamanho'") or die(mysql_error()";
	
echo "<meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = shop.php?artigo=$li_artigo\">";
	
}



function excluirartigos(){
	
	
	$li_artigo          = $_GET["artigo"];	
	$p_pedido           = $_GET["pedido"];
	$sqlpedido_data     = $_GET["data"];	
	$sql_limpa_artigo = mysql_query("DELETE FROM lista_artigo_pedido_fw12 WHERE `artigo` = '$li_artigo' AND `npedido` = '$p_pedido' AND `data` = '$sqlpedido_data'") ;
	echo "<meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = car.php\">";
	}
	
function limpa(){
	
	
	$p_pedido           = $_GET["pedido"];	
	
	$sql_limpa_artigo = mysql_query("DELETE FROM lista_artigo_pedido_fw12 WHERE  `npedido` = '$p_pedido'") ;
	echo "<meta HTTP-EQUIV = \"Refresh\" CONTENT = \"0; URL = car.php\">";
	}

?>