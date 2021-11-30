<footer id="blocodado" name="blocodado">

<?php
if($search <> "") { 
?>
<div id="caixa_pag">
<?php
echo '<a href="dispo.php?pag=1&type='.$type.'&search='.$search.'" class="pagi">'.'Primeira página'.'</a>';
    for($i=1; $i <= $total_paginas; $i++)
    {
         if($pagina == $i)
         {
             echo " ".$i." ";
         }
         else
         {
             echo '<a href="dispo.php?pag='.$i.'&type='.$type.'&search='.$search.'" class="pagi"> '.$i.'</a>';
 
         }
    }
echo '<a href="dispo.php?pag='.$total_paginas.'&type='.$type.'&search='.$search.'" class="pagi"> Última página</a>';


}

if($star_get <> "") { 
?>
<div id="caixa_pag">
<?php
echo '<a href="dispo.php?pag=1&star_get='.$star_get.'" class="pagi">'.'Primeira página'.'</a>';
    for($i=1; $i <= $total_paginas; $i++)
    {
         if($pagina == $i)
         {
             echo " ".$i." ";
         }
         else
         {
             echo '<a href="dispo.php?pag='.$i.'&star_get='.$star_get.'" class="pagi"> '.$i.'</a>';
 
         }
    }
echo '<a href="dispo.php?pag='.$total_paginas.'&star_get='.$star_get.'" class="pagi"> Última página</a>';


}

if($tipo <> "") { 

?>
<div id="caixa_pag">
<?php
echo '<a href="dispo.php?pag=1&type='.$type.'&tipo='.$tipo.'&categoria='.$categoria.'&gender='.$gender.'&order='.$order_pag.'" class="pagi">'.'Primeira página'.'</a>';
    for($i=1; $i <= $total_paginas; $i++)
    {
         if($pagina == $i)
         {
             echo "<a href=\"#\" class=\"pagi_hover\"> ".$i."</a>";
         }
         else
         {
             echo '<a href="dispo.php?pag='.$i.'&type='.$type.'&type='.$type.'&tipo='.$tipo.'&categoria='.$categoria.'&gender='.$gender.'&order='.$order_pag.'" class="pagi"> '.$i.'</a>';
 
         }
    }
echo '<a href="dispo.php?pag='.$total_paginas.'&type='.$type.'&type='.$type.'&tipo='.$tipo.'&categoria='.$categoria.'&gender='.$gender.'&order='.$order_pag.'" class="pagi"> Última página</a>';


}
?>    
</div></footer>