<?php
session_start();

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include"../../conexao.php";
include"sql_pedido/p_pedido.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "SELECT DISTINCT `Descricao` FROM `zk10n546_adidas`.`$tabela` WHERE `Descricao` LIKE '%".$q."' ORDER BY `Descricao`";
$rsd = mysqli_query($con, $sql);
while($rs = mysqli_fetch_array($rsd)) {
	$cname = $rs['Descricao'];
	echo "$cname\n";
}
?>

