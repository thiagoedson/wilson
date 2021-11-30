<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
</head>

<body>

<form action="?inserirArtigos&artigo=G41309" method="post" name="oi" onsubmit="return false;">>

       <input type="hidden" name="qual">

     <center><span class="dataport_1_1">Artigo</span><span class="dataport_2_2">Data</span><br />

	   <input type="text" class="dataport_1" name="artigo" value="G41309" readonly ><input type="text" class="dataport_2" name="data" value="14/04/2012"  /> 

       <img src="img/data_dp.jpg"><br />

<br /></center>

		<span class="bloco"><span class="quanti">Tamanho</span><span class="tama">Quantidade</span></span>



        

       

	  <span class="bloco">

	  	<input type="text" class="dataport_3_3" name="tamanho[]" value="35" readonly><br />

		<input type="text" class="dataport_3"   name="quantidade[]" id="m_35"  onkeypress="return SomenteNumero(event)"  TABINDEX="1" onblur="soma()"></span>

	  <span class="bloco">

	  	<input type="text" class="dataport_3_3" name="tamanho[]" value="36" readonly><br />

		<input type="text" class="dataport_3"   name="quantidade[]" id="m_36"  onkeypress="return SomenteNumero(event)"  TABINDEX="1" onblur="soma()"></span>

	  <span class="bloco">

	  	<input type="text" class="dataport_3_3" name="tamanho[]" value="37" readonly><br />

		<input type="text" class="dataport_3"   name="quantidade[]" id="m_37"  onkeypress="return SomenteNumero(event)"  TABINDEX="1" onblur="soma()"></span>

	  <span class="bloco">

	  	<input type="text" class="dataport_3_3" name="tamanho[]" value="38" readonly><br />

		<input type="text" class="dataport_3"   name="quantidade[]" id="m_38"  onkeypress="return SomenteNumero(event)"  TABINDEX="1" onblur="soma()"></span>

	  <span class="bloco">

	  	<input type="text" class="dataport_3_3" name="tamanho[]" value="39" readonly><br />

		<input type="text" class="dataport_3"   name="quantidade[]" id="m_39"  onkeypress="return SomenteNumero(event)"  TABINDEX="1" onblur="soma()"></span> 

     

      <br />

<script language="Javascript">



function soma(){

document.getElementById("total").value = '0'

var poko = 0;

var m_35 = parseFloat(document.getElementById("m_35").value);
var m_36 = parseFloat(document.getElementById("m_36").value);
var m_37 = parseFloat(document.getElementById("m_37").value);
var m_38 = parseFloat(document.getElementById("m_38").value);
var m_39 = parseFloat(document.getElementById("m_39").value);

document.getElementById("total").value = m_35+m_36+m_37+m_38+m_39+poko;
}
</script>

      

<input type="text" id="total"></b>

</form>

</body>
</html>