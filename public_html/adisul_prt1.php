<?php
#---------------------------------------------------------------------------------------
if($var_status == "1" or $var_status == "2") {
$menu_principal ="

<div id=\"telate\"></div>

<div id=\"conta\">
	<div id=\"telate\">
	<img src=\"".$barra_endereco."images/logo_m.png\" title=\"www.adisul.net\">
	$tile_shop
	<span class=\"lorena\"> $nome_cliente  $senha  $cnpj <br />						
		$segmentacao 
		<p class=\"email\"><img src=\"".$barra_endereco."images/mail.gif\" /> $email_senha</p>
	</span>
	<p class=\"logo_neaw\">$img_logo</p>
	</div>
	
<div id=\"menu\">
	<ul class=\"menu\">
    	<li>
			<a href=\"".$barra_endereco."principal.php\" class=\"parent\" title=\"PÁGINA INICIAL\">
				<span>
					<img src=\"".$barra_endereco."images/home.png\" style=\"float:left; margin-top:10px; margin-left:2px; margin-right:5px;\"  />  HOME 
				</span>
			</a>
		</li>
		
        <li>
			<a href=\"#\" class=\"parent\" title=\"MINHA LOJA\"><span>MINHA LOJA</span></a>
        		<div>
					<ul>
                		<li><a href=\"".$barra_endereco."info2.php\"><span>Meus Dados</span></a></li>
                		<li><a href=\"".$barra_endereco."pedidos.php\"><span>Meus Pedidos do site</span></a></li>
                		
                	</ul>
				</div>
					               		
        				 
		 <li><a href=\"#\" title=\"CATÁLOGO\"><span>CATÁLOGO</span></a>        
        	<div>
				<ul>      
		    		<li><a href=\"".$barra_endereco."view/ss15/\"><span>COLEÇÃO SS16</a></li>
		    	</ul>
			</div>
				<li><a href=\"".$barra_endereco."sair.php\" title=\"SAIR\"><span>SAIR</span></a></li>
    </ul>
</div>
					<div id=\"chato\">
						<a href=\"http://apycom.com/\">LINK</a>
					</div>	
";}



?>