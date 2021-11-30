<?php
$resultado_index = "
<label class=\"$estilo_star\" $filtro_tamanho>
<a href=\"shop.php?artigo=$s_artigo\"\"  title=\"Clique para ver o produto\" id=\"galeria\" $filtro_tamanho >
$s_descri <br />
$img  
<br />
</p>
<br />

	<font class=\"segm\" >$s_segment 
	<br />
	<span class=\"preco_des\">Vitrine R$ $s_vitrine</span>
	<br />
	<img src=\"img/bar.jpg\" />
	<br />
	<br />
	$s_origem
	<img src=\"$img_logo\" class=\"logo\" />	$pag
	<span class=\"$s_gender\">$s_gender</span> $s_artigo
	</font>
	<br />

	<br />
<img src=\"img/bar.jpg\" /><br />$tudo
<div id=\"star_label_v\">$star</div>
</a>
<br />
$link_mar
$link_car
</label>
";
echo $resultado_index;	
$tudo = "";
$total_star = "";



?>