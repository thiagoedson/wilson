
<?php

include("conexao.php");

// Recebe o valor enviado 
$valor = $_GET['valor'];

$valor = strtoupper($valor);

if($valor == "") {exit;}

echo "<table align=\"center\">";

$sql = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`prevendass16` WHERE `artigo` = '".$valor."' LIMIT 1");

// Exibe todos os valores encontrados
while ($pesquisa = mysqli_fetch_array($sql)) {

$price = $pesquisa["vitrine"];
$descricao = $pesquisa["Descricao"];
$ipi = $pesquisa["IPI"];
$ncm = $pesquisa["NCM"];



$artigo = $valor;

$artigo = $artigo;

$artigo = strtoupper($artigo);

$img = "<img src=\"http://adisul.net/demandimage/rbk/thumb/".$artigo."_F.jpg\" title=\"".$descricao."\" width=\"120px\"  /><br />";

 $price = str_replace(",", ".",  $price); 
 $price =  number_format($price, 2, ',', '.');


echo "<b>". $descricao;
echo "<br /> IPI =". $ipi;
echo "<br /> NCM =". $ncm;
echo "<br /></b><span class=\"preco\">R$ ".$price . "</span>";
echo $img;

}


echo "<tr>
		<td>Tamanho</td>
		<td>EAN</td>
	 </tr>	";
#-----------------------------------------------------------
$sql      = mysqli_query($con_reebok, "SELECT * FROM `rbkne024_reebok`.`EAN` WHERE `Artigo` = '".$valor."'");

    

// Exibe todos os valores encontrados
while ($pesquisa = mysqli_fetch_array($sql)) {

$ean       = $pesquisa["EANCode"];
$descricao = $pesquisa["Descricao"];
$tamanho   = $pesquisa["Tamanho"];

$artigo = strtoupper($artigo);
echo "<tr>
		<td>". $tamanho."</td><td>".$ean ."</td>
	  </tr>";
}
#------------------------------------------------------------------------------------------



?>
</table>