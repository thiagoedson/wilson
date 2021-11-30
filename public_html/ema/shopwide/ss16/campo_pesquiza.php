<?php
$categoria = $_GET["categoria"];
$search    = $_GET["search"];
$star_get  = $_GET["star_get"];
$tipo      = $_GET["tipo"];
$price     = $_GET["price"];
$order     = $_GET["order"];
$categoria_tipo = "";

#----------------------Verifica clientes especiais com restrição de produtos --------------------------------------------------------
$wr_query = mysqli_query($con, "SELECT * FROM `$banco`.`login_restrito` WHERE `cod_adidas` = '$senha'")or die(mysql_error());
$wr_lin = mysqli_num_rows($wr_query);
    if($wr_lin == 1) // verifica se retornou algum registro
    {
?>
<fieldset>
<legend>Pesquisa 1:</legend>
<form action="<?php echo $PHP_SELF; ?>" method="get">
Defina por
<select name="tipo">

  						<option value="Footwear" <?php if($tipo == "Footwear"){echo "selected=\"selected\" ";}?> >Calçados</option>
  						<option value="Hardware" <?php if($tipo == "Hardware"){echo "selected=\"selected\" ";}?> >Equipamento</option>
  						<option value="Apparel"  <?php if($tipo == "Apparel") {echo "selected=\"selected\" ";}?> >Têxtil</option>  	
                            <?php  $wc_calcado = "<a href=\"?ALL=1\" title=\"Exibir tudo\" class=\"bt_all\">Exibir Calçados</a> 	";?>
							<?php  $wc_textil  = "<a href=\"?ALL=2\" title=\"Exibir tudo\" class=\"bt_all\">Exibir Têxtil</a> 		";?>
							<?php  $wc_equipa  = "<a href=\"?ALL=3\" title=\"Exibir tudo\" class=\"bt_all\">Exibir Equipamento</a>	";?>					
</select>
<select name="categoria">  						 			          
<?php
$query_ca = mysqli_query($con, "SELECT DISTINCT `Categoria` FROM  `rbkne024_reebok`.`$tabela` WHERE `Usage` LIKE '%".$segmentacao_2."%' ORDER BY `Categoria`") or die(mysql_error());
while($array_ca = mysqli_fetch_array($query_ca)){
if($categoria == $array_ca["Categoria"]) {$condi_eua = "selected=\"selected\" ";}
else {$condi_eua = "";}
echo "<option ".$condi_eua." >".$array_ca["Categoria"]."</option>";}
?>
</select>

<select name="gender">
<?php if($gender == "x") {$cheeked = "selected=\"selected\""; $sinal_x = "<>"; $gender = "";} else { $cheeked = ""; $sinal_x = "="; }?>
<option value="x" <?php echo $cheeked;?> >Tudo</option>
<?php
$categoria_ge = $_GET["gender"];
$query_ge = mysqli_query($con, "SELECT DISTINCT `Gender` FROM  `rbkne024_reebok`.`$tabela` WHERE `Usage` LIKE '%".$segmentacao_2."%'") or die(mysql_error());
while($array_ge = mysqli_fetch_array($query_ge)){
if($categoria_ge == $array_ge["Gender"]) {$condi_ge = "selected=\"selected\" ";}
else {$condi_ge = "";}
echo "<option ".$condi_ge." >".$array_ge["Gender"]."</option>";}
?>
</select>
Order por :
<select name="order">  						
                        <option value="vitrine"              <?php if($order  == "vitrine")            {echo "selected=\"selected\" ";}?>>Preço</option>
                        <option value="Descricao"            <?php if($order  == "Descricao")          {echo "selected=\"selected\" ";}?>>Nome</option>
                        <option value="pag"                  <?php if($order  == "pag")                {echo "selected=\"selected\" ";}?>>Página</option>
                         
                       	
</select>
                        <input type="submit"  value="Buscar" class="bt_search"/>
</form>
</fieldset>
<fieldset>
<legend>Pesquisa 2:</legend>
<form action="#" method="get">
Buscar produto por Artigo ou nome : <input type="text" name="search" style="width:130;border-color:#CCC;border-style:inset;border-width:thin;" /><input type="submit" value="Buscar" class="bt_search" />
</form>
</fieldset>
<label style="display:block; width:100%;height:40px; position:absolute;">

</label>
<br>
<br>
<?php ;
   

     }
	else {





#------------------------------------------------------------------------------------------------------------------------------------
?>
<fieldset>
<legend>Pesquisa 1:</legend>
<form action="<?php echo $PHP_SELF; ?>" method="get">
Defina por
<select name="tipo">
<?php
#-------------------------------------------------------------------------------------------------------------------------------------
#--------------- Tipo de representante para o cliente --------------------------------------------------------------------------------
$type_re = mysqli_query($con, "SELECT `tipo` FROM `rbkne024_reebok`.`usuarios` WHERE `id` = '$e_represetante'");
while($array_type_e = mysqli_fetch_array($type_re)){	$tipo_re = $array_type_e["tipo"];}
if($tipo_re == "CTE") {
?>
  						<option value="Footwear" <?php if($tipo == "Footwear"){echo "selected=\"selected\" ";}?> >Calçados</option>
  						<option value="Hardware" <?php if($tipo == "Hardware"){echo "selected=\"selected\" ";}?> >Equipamento</option>
  						<option value="Apparel"  <?php if($tipo == "Apparel") {echo "selected=\"selected\" ";}?> >Têxtil</option>  	
                        
                        	<?php  $wc_calcado = "<a href=\"?ALL=1\" title=\"Exibir tudo\" class=\"bt_all\">Exibir Calçados</a> 	";?>
							<?php  $wc_textil  = "<a href=\"?ALL=2\" title=\"Exibir tudo\" class=\"bt_all\">Exibir Têxtil</a> 		";?>
							<?php  $wc_equipa  = "<a href=\"?ALL=3\" title=\"Exibir tudo\" class=\"bt_all\">Exibir Equipamento</a>	";?>				
</select>
<select name="categoria">  						 			          
<?php
$query_ca = mysqli_query($con, "SELECT DISTINCT `Categoria` FROM  `rbkne024_reebok`.`$tabela` WHERE `Usage` LIKE '%".$segmentacao_2."%' ORDER BY `Categoria`") or die(mysql_error());
while($array_ca = mysqli_fetch_array($query_ca)){
if($categoria == $array_ca["Categoria"]) {$condi_eua = "selected=\"selected\" ";}
else {$condi_eua = "";}
echo "<option ".$condi_eua." >".$array_ca["Categoria"]."</option>";}
?>
</select>
<?php }
elseif($tipo_re == "C") {$categoria_tipo = "AND `Divisao` = 'Footwear'";
?>  						  						
  						<option value="Footwear" <?php if($tipo == "Footwear"){echo "selected=\"selected\" ";}?> >Calçados</option>
                        	<?php  $wc_calcado = "<a href=\"?ALL=1\" title=\"Exibir tudo\" class=\"bt_all\">Exibir Calçados</a> 	";?>
</select>			
<select name="categoria">
<?php
$query_ca = mysqli_query($con, "SELECT DISTINCT `Categoria` FROM  `rbkne024_reebok`.`$tabela` WHERE `Usage` LIKE '%".$segmentacao_2."%' ORDER BY `Categoria`") or die(mysql_error());
while($array_ca = mysqli_fetch_array($query_ca)){
if($categoria == $array_ca["Categoria"]) {$condi_eua = "selected=\"selected\" ";}
else {$condi_eua = "";}
echo "<option ".$condi_eua." >".$array_ca["Categoria"]."</option>";}
?>
</select>
<?php } 
elseif($tipo_re == "TE") { $categoria_tipo = "AND `Divisao` != 'Footwear'";
?>
  						<option value="Apparel"  <?php if($tipo == "Apparel") {echo "selected=\"selected\" ";}?> >Têxtil</option>  						
  						<option value="Hardware" <?php if($tipo == "Hardware"){echo "selected=\"selected\" ";}?> >Equipamento</option>
                        	<?php  $wc_textil  = "<a href=\"?ALL=2\" title=\"Exibir tudo\" class=\"bt_all\">Exibir Têxtil</a> 		";?>
							<?php  $wc_equipa  = "<a href=\"?ALL=3\" title=\"Exibir tudo\" class=\"bt_all\">Exibir Equipamento</a>	";?>
  						
</select>
<select name="categoria">  						 			            
<?php
$query_ca = mysqli_query($con, "SELECT DISTINCT `Categoria` FROM  `rbkne024_reebok`.`$tabela` WHERE `Usage` LIKE '%".$segmentacao_2."%' ORDER BY `Categoria`") or die(mysql_error());
while($array_ca = mysqli_fetch_array($query_ca)){
if($categoria == $array_ca["Categoria"]) {$condi_eua = "selected=\"selected\" ";}
else {$condi_eua = "";}
echo "<option ".$condi_eua." >".$array_ca["Categoria"]."</option>";}
?>
</select>
<?php }
elseif($tipo_re == "E") {$categoria_tipo = "AND `Divisao` = 'Hardware'";
?>  						  						
  						<option value="Hardware" <?php if($tipo == "Hardware"){echo "selected=\"selected\" ";}?> >Equipamento</option> 
                        	<?php  $wc_equipa  = "<a href=\"?ALL=3\" title=\"Exibir tudo\" class=\"bt_all\">Exibir Equipamento</a>	";?> 						
</select>
<select name="categoria">  						 			            
<?php
$query_ca = mysqli_query($con, "SELECT DISTINCT `Categoria` FROM  `rbkne024_reebok`.`$tabela` WHERE `Usage` LIKE '%".$segmentacao_2."%' $categoria_tipo ORDER BY `Categoria`") or die(mysql_error());
while($array_ca = mysqli_fetch_array($query_ca)){
if($categoria == $array_ca["Categoria"]) {$condi_eua = "selected=\"selected\" ";}
else {$condi_eua = "";}
echo "<option ".$condi_eua." >".$array_ca["Categoria"]."</option>";}
?>
</select>
<?php } 
elseif($tipo_re == "T") {$categoria_tipo = "AND `Divisao` = 'Apparel'";
?>  						 
                        <option value="Apparel"  <?php if($tipo == "Apparel") {echo "selected=\"selected\" ";}?> >Têxtil</option>
                        	<?php  $wc_textil  = "<a href=\"?ALL=2\" title=\"Exibir tudo\" class=\"bt_all\">Exibir Têxtil</a> 		";?>
  						
</select>
<select name="categoria">  						  			             
<?php
$query_ca = mysqli_query($con, "SELECT DISTINCT `Categoria` FROM  `rbkne024_reebok`.`$tabela` WHERE `Usage` LIKE '%".$segmentacao_2."%' $categoria_tipo ORDER BY `Categoria`") or die(mysql_error());
while($array_ca = mysqli_fetch_array($query_ca)){
if($categoria == $array_ca["Categoria"]) {$condi_eua = "selected=\"selected\" ";}
else {$condi_eua = "";}
echo "<option ".$condi_eua." >".$array_ca["Categoria"]."</option>";}
?>
</select>
<?php } 
elseif($tipo_re == "O") { 
?>  						  
                        <option value="Footwear" <?php if($tipo == "Footwear"){echo "selected=\"selected\" ";}?> >Calçados</option>	  
						<option value="Apparel"  <?php if($tipo == "Apparel") {echo "selected=\"selected\" ";}?> >Têxtil</option>
                        <option value="Hardware" <?php if($tipo == "Hardware"){echo "selected=\"selected\" ";}?> >Equipamento</option>
                        	<?php  $wc_calcado = "<a href=\"?ALL=1\" title=\"Exibir tudo\" class=\"bt_all\">Exibir Calçados</a> 	";?>
							<?php  $wc_textil  = "<a href=\"?ALL=2\" title=\"Exibir tudo\" class=\"bt_all\">Exibir Têxtil</a> 		";?>
							<?php  $wc_equipa  = "<a href=\"?ALL=3\" title=\"Exibir tudo\" class=\"bt_all\">Exibir Equipamento</a>	";?>
  						
</select>
<!-- Inicio da seleção em tabela do site -->
<select name="categoria">  						  			             
<?php
$query_ca = mysqli_query($con, "SELECT DISTINCT `Categoria` FROM  `rbkne024_reebok`.`$tabela` WHERE `Usage` LIKE '%".$segmentacao_2."%' $categoria_tipo ORDER BY `Categoria`") or die(mysql_error());
while($array_ca = mysqli_fetch_array($query_ca)){
if($categoria == $array_ca["Categoria"]) {$condi_eua = "selected=\"selected\" ";}
else {$condi_eua = "";}
echo "<option ".$condi_eua." >".$array_ca["Categoria"]."</option>";}
?>
</select>
<?php }  ?>
<select name="gender">
<?php if($gender == "x") {$cheeked = "selected=\"selected\""; $sinal_x = "<>"; $gender = "";} else { $cheeked = ""; $sinal_x = "="; }?>
<option value="x" <?php echo $cheeked;?> >Tudo</option>
<?php
$categoria_ge = $_GET["gender"];
$query_ge = mysqli_query($con, "SELECT DISTINCT `Gender` FROM  `rbkne024_reebok`.`$tabela` WHERE `Usage` LIKE '%".$segmentacao_2."%'") or die(mysql_error());
while($array_ge = mysqli_fetch_array($query_ge)){
if($categoria_ge == $array_ge["Gender"]) {$condi_ge = "selected=\"selected\" ";}
else {$condi_ge = "";}
echo "<option ".$condi_ge." >".$array_ge["Gender"]."</option>";}
?>
</select>
Order por :
<select name="order">  						
                        <option value="vitrine"              <?php if($order  == "vitrine")            {echo "selected=\"selected\" ";}?>>Preço</option>
                        <option value="Descricao"            <?php if($order  == "Descricao")          {echo "selected=\"selected\" ";}?>>Nome</option>
                        <option value="pag"                  <?php if($order  == "pag")                {echo "selected=\"selected\" ";}?>>Página</option>
                         
                       	
</select>
                        <input type="submit"  value="Buscar" class="bt_search"/>
</form>
</fieldset>
<fieldset>
<legend>Pesquisa 2:</legend>
<form action="#" method="get">
Buscar produto por Artigo ou nome : <input type="text" name="search" style="width:130;border-color:#CCC;border-style:inset;border-width:thin;" /><input type="submit" value="Buscar" class="bt_search" />
</form>
</fieldset>
<label style="display:block; width:100%;height:40px; position:absolute;">

</label>
<br>
<br>

<?php } ?>