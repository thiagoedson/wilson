<div id="footer">

<?php
$query_footer = mysqli_query($con, "SELECT `email`,`titulo`,`telefone`,`region` FROM `rbkne024_reebok`.`usuarios` WHERE `id` = '$id_repre'");
	while($array_foo = mysqli_fetch_array($query_footer))


	{	
	$email_footer         = $array_foo["email"];
	$titulo_footer        = $array_foo["titulo"];
	$telefone_footer      = $array_foo["telefone"];
	$region_footer        = $array_foo["region"];
	}

	
echo "<div class=\"texto_rodape\">".$titulo_footer."<br />";
echo "Região : ".$region_footer."<br />";
echo "Contato : <a href=\"mailto:".$email_footer." \" />".$email_footer." </a> <br />";
echo "Telefone : $telefone_footer</div> ";

?>
<p class="titulo_legenda">© Copyright | 2015  - - </p>
<div id="imga">
</div>
</div>
<div id="grade">
<?php 
#---------------------------- Função CLE ------------------------------------------------------------------
$query_fx = mysqli_query($con, "SELECT * FROM `$banco`.`tb_cle` WHERE `cliente` = '$senha'");
while($array_fx = mysqli_fetch_array($query_fx)){	
	  $lin_fx        = $array_fx["typt"];}	  
	  $lin_aa = mysqli_num_rows($query_fx);
    if($lin_aa == 0)  {$cle = "";}    
    else {     
    if($lin_fx == "1") // verifica se retornou algum registro
    {$cle = "";}
    else {
	#--------------Promocional CLE----------------------------------------------------------------
	$query_consulta_cle = mysqli_query($con, "SELECT `status` FROM `$banco`.`pedido_promocional` WHERE `cliente` = '$senha' AND `status` = '1'");
	$csa_c = mysqli_num_rows($query_consulta_cle);	  
    if($csa_c == 1)  {$ativo_3 = "<span class=\"notific\" title=\"Pedido em aberto\" >Pedido em aberto</span>";}
	#--------------------------------------------------------------------------------------------
		
		
		$cle  = "<li>
				  	<a  href=\"shopwide/promo/dispo.php\">  
						<span>PROMOCIONAL CLE 
						$ativo_3<br>
						<span class=\"detalhe_legenda\">Produtos com descontos especiais</span>
						</span>
						
						
						
					</a>
				  </li>";}	
	}
	
#---------------------------- Função CLE 1 ----------------------------------------------------------------

	

#---------------------------- Função LOJA SPRING ------------------------------------------------
$query_sb = mysqli_query($con, "SELECT * FROM `$banco`.`tb_ss14` WHERE `cliente` = '$senha'");
while($array_sb = mysqli_fetch_array($query_sb))
			{	
			  $lin_sb        = $array_sb["typt"];
			}
	  
	          $lin_ss = mysqli_num_rows($query_sb);	  
    			if($lin_ss == 0)  {$spring = "";}
    			else { 
	
	$query_consulta_pedido = mysqli_query($con, "SELECT `status` FROM `$banco`.`pedido_ss16` WHERE `cliente` = '$senha' AND `status` = '1'");
	$csa = mysqli_num_rows($query_consulta_pedido);	  
    if($csa == 1)  {$ativo_1 = "<span class=\"notific\" title=\"Pedido em aberto\" >Pedido em aberto</span>";}
	
#    
   if($lin_sb == "1") // verifica se retornou algum registro
   { $spring = "";	}
    else {$spring = "";}
	
	}

	
#---------------Linl powerplay	
$power = "	<li>
		  	<a href=\"".$barra_endereco."shopwide/ss16/dispo.php\" title=\"PRÉ-VENDA SS16\">           
			<span>PRÉ-VENDA SS16 $ativo_1</span><br>
			<span class=\"detalhe_legenda\">Produtos de Janeiro a Junho 2016</span>
			</a>
		   </li>";	
	
#------------------------------------------------------------------------------------------------
#----------------------------------LINK DAS LOJAS -----------------------------------------------
#------------------------------------------------------------------------------------------------

	if($loja_status == "1") {
	
#--------------Pronta-Entrega----------------------------------------------------------------

#--------------------------------------------------------------------------------------------
	
	
	$loja_status_loja = "$power";}		

#------------------------------------------------------------------------------------------------

echo 	$loja_status_loja;
?>

</div>
<script type="text/javascript">
$(document).ready(function() {
$('#coin-slider').coinslider();
});
</script>