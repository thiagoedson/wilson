<?php
$img = "<center><img src=\"http://adisul.net/demandimage/rbk/thumb/".$s_artigo."_F.jpg\"  style=\"max-width:120px;max-height:120px;\"  /></center>";
if($s_status == "2") {$estilo_star = "label_esgotado";} else { $estilo_star = "label";}

#------- Regra Estrelas ----------------------------------------------------------------------------------------------------------------------------------
$star = "<img src=\"img/star_black.jpg\"/>";
$query_star = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`vistos_artigo` WHERE `artigo` = '$s_artigo'")or die(mysql_error());
while($star_array = mysqli_fetch_array($query_star)){		
	  $total_star       = $star_array["count"];
	  }
#---- Condições-----

	if($categoria_query == "NEO"){
	
    if($total_star >= 100) {$star = "<img src=\"img/star_1.jpg\"/>";}
    if($total_star >= 150) {$star = "<img src=\"img/star_2.jpg\"/>";}
    if($total_star >= 200) {$star = "<img src=\"img/star_3.jpg\"/>";}
	if($total_star >= 250) {$star = "<img src=\"img/star_4.jpg\"/>";} 
	if($total_star >= 300) {$star = "<img src=\"img/star_5.jpg\"/>";}  
	}
	elseif($categoria_query == "ORIGINALS" || $categoria_query == "ACTION SPORTS"){
	
    if($total_star >= 50) {$star = "<img src=\"img/star_1.jpg\"/>";}
    if($total_star >= 100) {$star = "<img src=\"img/star_2.jpg\"/>";}
    if($total_star >= 150) {$star = "<img src=\"img/star_3.jpg\"/>";}
	if($total_star >= 200) {$star = "<img src=\"img/star_4.jpg\"/>";} 
	if($total_star >= 250) {$star = "<img src=\"img/star_5.jpg\"/>";}  
	}
	elseif($s_tipo == "Apparel"){
	
    if($total_star >= 50) {$star = "<img src=\"img/star_1.jpg\"/>";}
    if($total_star >= 100) {$star = "<img src=\"img/star_2.jpg\"/>";}
    if($total_star >= 150) {$star = "<img src=\"img/star_3.jpg\"/>";}
	if($total_star >= 200) {$star = "<img src=\"img/star_4.jpg\"/>";} 
	if($total_star >= 250) {$star = "<img src=\"img/star_5.jpg\"/>";}  
	}
	elseif($s_tipo == "Hardware"){
	
    if($total_star >= 25) {$star = "<img src=\"img/star_1.jpg\"/>";}
    if($total_star >= 45) {$star = "<img src=\"img/star_2.jpg\"/>";}
    if($total_star >= 65) {$star = "<img src=\"img/star_3.jpg\"/>";}
	if($total_star >= 85) {$star = "<img src=\"img/star_4.jpg\"/>";} 
	if($total_star >= 115) {$star = "<img src=\"img/star_5.jpg\"/>";}  
	}
	else {
	
    if($total_star >= 100) {$star = "<img src=\"img/star_1.jpg\"/>";}
    if($total_star >= 150) {$star = "<img src=\"img/star_2.jpg\"/>";}
    if($total_star >= 250) {$star = "<img src=\"img/star_3.jpg\"/>";}
	if($total_star >= 300) {$star = "<img src=\"img/star_4.jpg\"/>";} 
	if($total_star >= 350) {$star = "<img src=\"img/star_5.jpg\"/>";}  
	}


?>
