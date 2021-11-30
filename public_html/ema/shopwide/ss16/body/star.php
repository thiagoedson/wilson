<?php
$img = "<img src=\"http://adisul.net/demandimage/thumb/".$s_artigo."_F.jpg\" style=\"max-height:120px;padding-top:10px;\" ";
if($s_status == "2") {$estilo_star = "label_esgotado";} else { $estilo_star = "label";}

#------- Regra Estrelas ----------------------------------------------------------------------------------------------------------------------------------
$star = "style=\"background: url(star.png) 0 0 no-repeat;\"";
$query_star = mysql_query("SELECT * FROM `adisu724_adidas`.`vistos_artigo` WHERE `artigo` = '$s_artigo'")or die(mysql_error());
while($star_array = mysql_fetch_array($query_star)){		
	  $total_star       = $star_array["count"];
	  }
#---- Condições-----

	if($categoria_query == "NEO"){
	
    if($total_star >= 250) {$star = "style=\"background: url(star.png) 0 0 no-repeat;\"";}
    if($total_star >= 325) {$star = "<img src=\"img/star_2.jpg\"/>";}
    if($total_star >= 400) {$star = "<img src=\"img/star_3.jpg\"/>";}
	if($total_star >= 475) {$star = "<img src=\"img/star_4.jpg\"/>";} 
	if($total_star >= 525) {$star = "<img src=\"img/star_5.jpg\"/>";}  
	}
	elseif($categoria_query == "ORIGINALS" || $categoria_query == "ACTION SPORTS"){
	
    if($total_star >= 100) {$star = "<img src=\"img/star_1.jpg\"/>";}
    if($total_star >= 150) {$star = "<img src=\"img/star_2.jpg\"/>";}
    if($total_star >= 200) {$star = "<img src=\"img/star_3.jpg\"/>";}
	if($total_star >= 250) {$star = "<img src=\"img/star_4.jpg\"/>";} 
	if($total_star >= 300) {$star = "<img src=\"img/star_5.jpg\"/>";}  
	}
	elseif($s_tipo == "Apparel"){
	
    if($total_star >= 100) {$star = "<img src=\"img/star_1.jpg\"/>";}
    if($total_star >= 150) {$star = "<img src=\"img/star_2.jpg\"/>";}
    if($total_star >= 200) {$star = "<img src=\"img/star_3.jpg\"/>";}
	if($total_star >= 250) {$star = "<img src=\"img/star_4.jpg\"/>";} 
	if($total_star >= 300) {$star = "<img src=\"img/star_5.jpg\"/>";}  
	}
	elseif($s_tipo == "Hardware"){
	
    if($total_star >= 100) {$star = "<img src=\"img/star_1.jpg\"/>";}
    if($total_star >= 150) {$star = "<img src=\"img/star_2.jpg\"/>";}
    if($total_star >= 200) {$star = "<img src=\"img/star_3.jpg\"/>";}
	if($total_star >= 250) {$star = "<img src=\"img/star_4.jpg\"/>";} 
	if($total_star >= 300) {$star = "<img src=\"img/star_5.jpg\"/>";}  
	}
	else {
	
    if($total_star >= 500) {$star = "style=\"width=100%;height=20px; background: url(star.png) 0 0 no-repeat;\"";}
    if($total_star >= 550) {$star = "<img src=\"img/star_2.jpg\"/>";}
    if($total_star >= 610) {$star = "<img src=\"img/star_3.jpg\"/>";}
	if($total_star >= 720) {$star = "<img src=\"img/star_4.jpg\"/>";} 
	if($total_star >= 820) {$star = "<img src=\"img/star_5.jpg\"/>";}  
	}


?>