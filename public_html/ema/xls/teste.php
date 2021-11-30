<?php
include ('GeraPDF/class.ezpdf.php');

$npedido = $_GET["npedido"];

$pdf = new Cezpdf(); 

// seta a fonte que será usada para apresentar os dados
//essas fontes são aquelas dentro do diretório GeraPDF/fonts
$pdf->selectFont('GeraPDF/fonts/Helvetica.afm'); 

// chama o método ezText e passa o texto que deverá ser apresentado no documento
//o numero após o texto se refere ao tamanho da fonte

$pdf->ezText('<table>',100); 

$SQL = "SELECT DISTINCT artigo, data FROM `lista_artigo_pedido` WHERE npedido = '$npedido' ORDER BY data, artigo ";
$executa = mysql_query($SQL);

while ($rs = mysql_fetch_array($executa)){
	
	$pdf->ezText('<td>'. $rs['artigo'].'</td>',10);
	
}

// gera o PDF
$pdf->ezStream(); 
?>
?>