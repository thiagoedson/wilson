<?php
session_start();
    header("Pragma: no-cache");
    header("Cache: no-cache");
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");	
	
$categoria = $_GET["categoria"];
$search    = $_GET["search"];
$star_get  = $_GET["star_get"];
$tipo      = $_GET["tipo"];
$price     = $_GET["price"];
$order     = $_GET["order"];
include"../../conexao.php";
include"sql_pedido/p_pedido.php";

#--------------------------------------------------compra----------------------------------------------
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://rbk.net.br/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon-precomposed" href="http://rbk.net.br/apple-touch-icon-precomposed.png" />
<title>adisul.net</title>
<link type="text/css" href="../../menu.css" rel="stylesheet" />
<style type="text/css" media="all">
@import url("estilo_shop.css");
@import "media/css/demo_page.css";
@import "media/css/demo_table.css";
@import "media/jquery-ui-1.8.4.custom.css";
@import "css/shCore.css";

</style>
<script type="text/javascript" src="../../menu.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>

		<script type="text/javascript" charset="utf-8">
			(function($) {
			/*
			 * Function: fnGetColumnData
			 * Purpose:  Return an array of table values from a particular column.
			 * Returns:  array string: 1d data array 
			 * Inputs:   object:oSettings - dataTable settings object. This is always the last argument past to the function
			 *           int:iColumn - the id of the column to extract the data from
			 *           bool:bUnique - optional - if set to false duplicated values are not filtered out
			 *           bool:bFiltered - optional - if set to false all the table data is used (not only the filtered)
			 *           bool:bIgnoreEmpty - optional - if set to false empty values are not filtered from the result array
			 * Author:   Benedikt Forchhammer <b.forchhammer /AT\ mind2.de>
			 */
			$.fn.dataTableExt.oApi.fnGetColumnData = function ( oSettings, iColumn, bUnique, bFiltered, bIgnoreEmpty ) {
				// check that we have a column id
				if ( typeof iColumn == "undefined" ) return new Array();
				
				// by default we only want unique data
				if ( typeof bUnique == "undefined" ) bUnique = true;
				
				// by default we do want to only look at filtered data
				if ( typeof bFiltered == "undefined" ) bFiltered = true;
				
				// by default we do not want to include empty values
				if ( typeof bIgnoreEmpty == "undefined" ) bIgnoreEmpty = true;
				
				// list of rows which we're going to loop through
				var aiRows;
				
				// use only filtered rows
				if (bFiltered == true) aiRows = oSettings.aiDisplay; 
				// use all rows
				else aiRows = oSettings.aiDisplayMaster; // all row numbers
			
				// set up data array	
				var asResultData = new Array();
				
				for (var i=0,c=aiRows.length; i<c; i++) {
					iRow = aiRows[i];
					var aData = this.fnGetData(iRow);
					var sValue = aData[iColumn];
					
					// ignore empty values?
					if (bIgnoreEmpty == true && sValue.length == 0) continue;
			
					// ignore unique values?
					else if (bUnique == true && jQuery.inArray(sValue, asResultData) > -1) continue;
					
					// else push the value onto the result data array
					else asResultData.push(sValue);
				}
				
				return asResultData;
			}}(jQuery));
			
			
			function fnCreateSelect( aData )
			{
				var r='<select><option value=""></option>', i, iLen=aData.length;
				for ( i=0 ; i<iLen ; i++ )
				{
					r += '<option value="'+aData[i]+'">'+aData[i]+'</option>';
				}
				return r+'</select>';
			}
			
			
			$(document).ready(function() {
				/* Initialise the DataTable */
				var oTable = $('#example').dataTable( {
					"oLanguage": {
						"sSearch": "Procurar na lista:"
					}
				} );
				
				/* Add a select menu for each TH element in the table footer */
				$("tfoot th").each( function ( i ) {
					this.innerHTML = fnCreateSelect( oTable.fnGetColumnData(i) );
					$('select', this).change( function () {
						oTable.fnFilter( $(this).val(), i );
					} );
				} );
			} );
		</script>
<script language="JavaScript">
function abrir(URL) { 
  var width = 850;
  var height = 550; 
  var left = 150;
  var top = 150; 
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=0, location=no, directories=no, menubar=no, resizable=no, fullscreen=no'); 
}
</script>
<script type="text/javascript" >
var req;
 
// FUNÇÃO PARA BUSCA NOTICIA
function buscarNoticias(valor) {
 
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
 
// Arquivo PHP juntamente com o valor digitado no campo (método GET)
var url = "funcao.php?valor="+valor+"&npedido="+<?php echo $npedido;?>;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);

req.send(null);
}

</script>
<script type="text/javascript" language="javascript" src="js/shCore.js"></script>
</head>
<body>
<div id="conta">
<?php 
include"top.php";
?>
<?php if($status_banco == "<div id=\"status_banco\"><a href=\"../../principal.php\"><img src=\"img/bancno.jpg\"></a></div>")  {echo $status_banco; exit;}?>
<div id="barra_pedido">
  <!--Shop --- ADidas---->
  <?php echo $p_menu;?>
</div>
<a href="dispo.php"><div id="bt_shop"></div></a>
<a href="javascript:window.history.go(-1)"><div id="bt_volto"></div></a>
<div id="lista_marcados">



<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" style="width:850px !important;" >
        <thead>
          <tr>
          	<th>Foto</th>
            <th>Divisão</th>
            <th>Artigo</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>PDV</th>
            <th>Data de Lancamento*</th>
            <th>Ações</th>
          </tr>
        </thead>
        	<tfoot  class="media_inout">
		<tr>
			<th></th>
			<th></th>
			<th></th>
            <th></th>
            <th></th>
			<th></th>
            <th></th>
           
			
		</tr>
	</tfoot>
    
        <tbody>
        <form action="<?php echo $PHP_SELF;?>?addCliente_tb" method="get" name="exemplo2" >
<?php
$mysqli_query_list = mysqli_query($con, "SELECT * FROM `$banco`.`lista_ss16` WHERE `npedido` = '$senha'");
	while($array_m = mysqli_fetch_array($mysqli_query_list)){		
	  $divisao         = $array_m["divisao"];
	      if($divisao == "Footwear"){ $divisao = "Calçado";}
	  elseif($divisao == "Apparel") { $divisao = "Têxtil";}
	                           else { $divisao = "Equipamento";}
	  $artigo          = $array_m["artigo"];
	  $id              = $array_m["id"];
	  $categoria       = $array_m["categoria"];
	  $descricao       = $array_m["descricao"];
	  $price           = $array_m["price"];
	  
	  @$price = str_replace(",", ".", $price);
      @$price =  number_format($price, 2, ',', '.'); 
	  	
	  $data_l          = $array_m["data_lancamento"];
	  $data_l    = date('d/m/Y', strtotime(str_replace("-", "/", $data_l )));
	  
	  $mysql_car = mysqli_query($con, "SELECT * FROM `lista_artigo_pedido_ss16` WHERE `npedido` = '$npedido' AND `artigo` = '$artigo'");
	  $lin = mysqli_num_rows($mysql_car);
      if($lin==0) // verifica se retornou algum registro
      {
      $bt_list = "<a href=\"javascript:abrir('window.php?artigo=$artigo');\" class=\"comprar_bt\" > Adicionar ao Carrinho </a>";
      }
	  else
	  {
      $bt_list = "<a href=\"javascript:abrir('window.php?artigo=$artigo');\" class=\"comprado_bt\" > Já adicionado </a>";
      }
echo " <tr class=\"odd gradeA\">
			<td><a href=\"shop.php?artigo=".$artigo."\"><img src=\"http://adisul.net/demandimage/rbk/thumb/".$artigo."_F.jpg\"  class=\"timg\" ></a></td>
            <td>$divisao </td>
            <td>$artigo </td>
			<td>$descricao </td>
            <td>$categoria </td>
			<td>R$ $price </td>
            <td class=\"center\">$data_l </td>
            <td class=\"center\">$bt_list 
							     <a href=\"?excluirLista&id=$id\" class=\"excluir_bt\" > Excluir da Lista </a> </td>
          </tr>";
	  
	}


?>

</form>
</tbody>
	

</table>

<footer id="blocodado"></footer>

</div>
<a href="list.php"><div id="atualizar">Atualizar página<br />
<img src="img/atualizar.png" /></div></a>
</div>






</body>
</html>