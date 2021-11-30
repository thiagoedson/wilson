<?php
session_start();
$senha = $_SESSION["codigo"];
include "dire.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>adisul.net</title>
<link href="img/Adidas.ico" rel="shortcut icon" type="image/x-icon" />
<link type="text/css" href="menu.css" rel="stylesheet" />
<link type="text/css" href="coin-slider-styles.css" rel="stylesheet" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="menu.js"></script>
<script type="text/javascript" src="coin-slider.min.js"></script>
<script type="text/javascript" src="coin-slider.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<style type="text/css" media="all">
@import url("estilo.css");
</style>
</head>
<body >
<?php 
include"../adisul_prt1.php";
	   echo $menu_principal; 
include"../video_list.php";
?>
</body>
</html>