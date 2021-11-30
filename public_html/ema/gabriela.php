<?php
include"conexao.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>adisul.net</title>

<style type="text/css" media="all">

</style>
</head>
<body >
<table>
<tr><td>Artigo</td><td>Preço de vitrine</td><td>Página</td><td>Imagem</td></tr>
<?php 
$query_footer = mysql_query("SELECT * FROM `adisu724_mau`.`gabriela`");
while($array_foo = mysql_fetch_array($query_footer))
{	
	$artigo         = $array_foo["A"];
	$preco          = $array_foo["B"];
	$pag            = $array_foo["C"];

	

echo "<tr>
			<td>". $artigo."</td>
			<td>". $preco."</td>
			<td>Página ". $pag."</td>
			<td><img src=\"http://adisul.net/demandimage/thumb/".$artigo."_F.jpg\" width=\"120px\" height=\"100px\" /></td>";
			}

?>

</table>
</body>
</html>