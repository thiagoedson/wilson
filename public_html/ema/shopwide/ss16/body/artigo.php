<?php
$resultado_index = "
<label class=\"$estilo_star\" $filtro_tamanho>
<a href=\"shop.php?artigo=$s_artigo\"  title=\"Clique para ver o produto\" id=\"galeria\" $filtro_tamanho >
$s_descri <br />
$img<br />
<br />
De R$ $s_custo por R$ $s_cle_1<br /><br />

<img src=\"$img_logo\" /> - <span class=\"$s_gender\">$s_gender</span>
<br />
<br />
<font class=\"segm\" >$s_segment <br />
</font><br />
<img src=\"img/bar.jpg\" /><br />
$tudo
<div id=\"star_label_v\">$star</div>
</a>
<br />
$link_car
</label>
";
echo $resultado_index;	
$tudo = "";
$total_star = "";



?>