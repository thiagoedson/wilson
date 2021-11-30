<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
</head>

<body>

<script language="Javascript">
function soma(){

document.getElementById("total").value = '0'
var preco = parseFloat(document.getElementById("preco").value);
var quantos = parseFloat(document.getElementById("quantos").value);
var desconto = parseFloat(document.getElementById("desconto").value);
document.getElementById("total").value = preco * quantos - desconto;
}
</SCRIPT>
</head>
<input type="text" id="preco" value="0"><br>
<input type="text" id="quantos" value="0" onblur="soma()"><br>
<input type="text" id="desconto" value="0" onblur="soma()"><br><hr size="1">


<b>Total:<input type="text" id="total"></b>
</body>
</html>