<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

$var = $_SESSION['adm'];
$userx = $_SESSION['usuarioNome'];

$query_conexao_representada = mysqli_query($SG_x , "SELECT `nome`,`banco`,`id`,`contato` FROM `usuarios` WHERE `nome` = '$userx'");
while($array_co_re = mysqli_fetch_assoc($query_conexao_representada))
{	
	$welcome         = $array_co_re["contato"];
	$represe         = $array_co_re["id"];
	$host            = "localhost";
	$user            = $array_co_re["banco"];
	$pass            = "mhvt26mnk";
	$banco           = $array_co_re["banco"];
	$con = mysqli_connect($host, $user, $pass) or die (mysql_error());
	mysqli_select_db($con,$banco);
}



$menu_adi = "

<div id=\"menu\">
    <ul class=\"menu\">
        <li><a href=\"\" class=\"parent\"><span>$welcome</span></a>
        <li><a href=\"home.php\" class=\"parent\"><span>Página inicial</span></a>        
        </li>
        <li><a href=\"#\" class=\"parent\"><span>Clientes</span></a>
            <ul>
                <li><a href=\"pesquisa_cliente.php\">	<span>Procurar por nome</span></a></li>
		        <li><a href=\"pesquisa_grupo.php\">	<span>Procurar por grupo</span></a></li>               
                <li><a href=\"white_red.php\">		<span>Acesso Suspenso</span></a></li>
                <li><a href=\"ver_grupos.php\">		<span>Ver Grupos do site</span></a></li>               
                <li><a href=\"dadoscompleto.php\">	<span>Dados dos Clientes</span></a></li>
		<li><a href=\"cada_logi.php\">		<span>Cadastrar Clientes</span></a></li>
		<li><a href=\"premium_ss14.php\">	<span>APROVAR SS16</span></a></li>	
		<li><a href=\"premium.php\">		<span>APROVAR CLE </span></a></li>	
		<li><a href=\"premium_cle.php\">	<span>APROVAR  CLE 1 </span></a></li>	
                
                
            </ul>
        </li>
        
		<li><a href=\"#\"><span>Pedidos</span></a>
			<ul>
			  <li><a href=\"lixeira.php\">                    <span>Lixeira		 <p class=\"inativo\">(NOVO)</p></span></a></li>				  	 
			  		
			  					  
			  <li><a href=\"#\"  class=\"parent\"><span>Pedidos Pré-venda</span></a>			  
			     <div><ul>
			      <li><a href=\"pedido_2.php?type=SS16\">           <span>Pré-Venda | SS16</span></a></li>
			     </ul></div>
			</li>
			  		  			 
		   </ul>
		</li>   
		
		<li class=\"parent\"><a href=\"#\" target=\"_blank\"><span>Relatórios</span></a>
		  <ul>
                  <li><a href=\"relatorio_grafico.php\"><span>Vendas</span></a></li>
                  <li><a href=\"meus_dados.php\"><span>Meus dados</span></a></li>
                  
		
                  </ul>
		
		</li>
		<li class=\"parent\"><a href=\"sair.php\"><span>Sair do site</span></a></li>
    </ul>
</div>

<div id=\"copyright\" style=\" visibility:hidden;\">Copyright &copy; 2011 <a href=\"http://apycom.com/\">Apycom jQuery Menus</a></div>";

/**
* Função para salvar mensagens de LOG no MySQL
*
* @param string $mensagem - A mensagem a ser salva
*
* @return bool - Se a mensagem foi salva ou não (true/false)
*/
function salvaLog($con,$mensagem) {
$ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
$hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
$timestamp = mktime(date("H")-2);
$hora = gmdate("Y-m-d H:i:s", $timestamp);
$userx = $_SESSION['user'];
// Usamos o mysql_escape_string() para poder inserir a mensagem no banco
//   sem ter problemas com aspas e outros caracteres
$mensagem = mysqli_real_escape_string($con,trim($mensagem));

// Monta a query para inserir o log no sistema
$sql = "INSERT INTO `logs` VALUES (NULL, '".$hora."', '".$ip."', '".$userx."', '".$mensagem."')";

if (mysqli_query($con,$sql)) {
return true;
} else {
return false;
}
}



?>