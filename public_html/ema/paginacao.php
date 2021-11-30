<style type="text/css">
<!--
.pgoff {font-family: Verdana, Arial, Helvetica; font-size: 11px; color: #FF0000; text-decoration: none}
a.pg {font-family: Verdana, Arial, Helvetica; font-size: 11px; color: #003366; text-decoration: none}
a:hover.pg {font-family: Verdana, Arial, Helvetica; font-size: 11px; color: #0066cc; text-decoration:underline}

.msgalert { font-family:Verdana, Geneva, sans-serif; font-size:25pt; color:#F00;}
-->
</style>
<center>
<?php
$quant_pg = ceil($quantreg/$numreg);
$quant_pg++;


$lin = mysql_num_rows($sql);
    if($lin==0) // verifica se retornou algum registro
    {
   echo '<center><span  class="msgalert" > Nada encontrado</span></center>';
     }

// Verifica se esta na primeira página, se nao estiver ele libera o link para anterior
if ( @$_GET['pg'] > 0) {
echo "<a href=".$_SERVER['PHP_SELF']."?pg=".(@$_GET['pg']-1)." class=pg ><b>Anterior</b></a>";
} else {
echo "<font color=#CCCCCC>Anterior</font>";
}

// Faz aparecer os numeros das página entre o ANTERIOR e PROXIMO

for($i_pg=1; $i_pg<$quant_pg;$i_pg++) {
// Verifica se a página que o navegante esta e retira o link do número para identificar visualmente

if (@$_GET['pg'] == ($i_pg-1)) {
echo "&nbsp;<span class=pgoff>[$i_pg]</span>&nbsp;";
} else {
$i_pg2 = $i_pg-1;
echo "&nbsp;<a href=".$_SERVER['PHP_SELF']."?pg=$i_pg2&filtro=".$_GET['filtro']." class=pg><b>$i_pg</b></a>&nbsp;";
}
}

// Verifica se esta na ultima página, se nao estiver ele libera o link para próxima
if ((@$_GET['pg']+2) < $quant_pg) {
echo "<a href=".$_SERVER['PHP_SELF']."?pg=".(@$_GET['pg']+1)." class=pg ><b>Próximo</b></a>";
} else {
echo "<font color=#CCCCCC>Próximo</font>";
}
?> 
</center>