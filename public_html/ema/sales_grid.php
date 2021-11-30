<?php
session_start();

$loja = $_SESSION["codigo"];
include"conexao.php";
        //set content type and xml tag
        header("Content-type:text/xml");
        print("<?xml version=\"1.0\"?>");
 
             $count = 100;
		
#		$sql = "SELECT * FROM `pedido_pfw13` WHERE `Cliente` = '$loja'";
        //if this is the first query - get total number of records in the query result
#        if($posStart==0){
#            $sqlCount = "Select count(*) as `id` from ($sql) as `pedido_pfw13` WHERE `Cliente` = '$loja'";
#            $resCount = mysqli_query($con, $sqlCount);
#            $rowCount=mysqli_fetch_array($resCount);
#            $totalCount = $rowCount["id"];
#        }
 
        //add limits to query to get only rows necessary for the output
#        $sql.= " LIMIT ".$posStart.",".$count;
 
        //query database to retrieve necessary block of data
		
		
		
 
        //output data in XML format   
        print("<rows total_count='".$totalCount."' pos='".$posStart."'>");   
		
		$query_pedidos = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`loja_table`");
        
		while($array_pedido = mysqli_fetch_array($query_pedidos)){
			
			$table = $array_pedido["banco"];
			$id_table = $array_pedido["id"];
			$xls_table = $array_pedido["xls"];
			
		$res = mysqli_query($con, "SELECT * FROM `$table` WHERE `Cliente` = '$loja' AND `status` != '5'");
		
		
		$id_index .= +1;
        while($row = mysqli_fetch_array($res)){
			
            print("<row id='".$id_index++."'>");
                print("<cell>");
				    print("<![CDATA[|Download|^xls/".$xls_table."?npedido=".$row['npedido']."^iframe_a]]>");  //value for internal code
				print("</cell>");
                print("<cell>");
                    print($row['npedido']);    //value for price
                print("</cell>");
                print("<cell>");				
                    $query_rotulo = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`loja_table` WHERE `id` ='$id_table'");
					while($row_cliente=mysqli_fetch_array($query_rotulo)){
				    print($row_cliente['descricao']);    //value for price	 
					}
                print("</cell>");
			    print("<cell>");
					$valor_unite = number_format($row['total'], 2, ',', '.');			        
                    print($valor_unite);    //value for price
                print("</cell>");
			    print("<cell>");
				 	$query_cliente = mysqli_query($con, "SELECT * FROM `login` WHERE `B` ='".$row['cliente']."'");
					while($row_cliente=mysqli_fetch_array($query_cliente)){
					$nome_loja_final = str_replace("&","E",$row_cliente['loja']);
				    print($nome_loja_final);    //value for price	 
					}
                print("</cell>");	
			    print("<cell>");
					$entrega_revisada = date('d-m-Y', strtotime($row['data_2']));
                    print($entrega_revisada);    //value for price                    
                print("</cell>");			   
			    print("<cell>");
					if($row['status'] == "1")     {$status_pedido = "PEDIDO EM ABERTO";}
					elseif($row['status'] == "2") {$status_pedido = "PEDIDO ENVIADO";}
					elseif($row['status'] == "3") {$status_pedido = "PEDIDO RECEBIDO";}
					elseif($row['status'] == "4") {$status_pedido = "FINALIZADO";}
					elseif($row['status'] == "6") {$status_pedido = "SEM ESTOQUE";}
					elseif($row['status'] == "7") {$status_pedido = "ATENDIDO PARCIAL";}
					else {$status_pedido = "ERRO 478";}				
				    print($status_pedido);    //value for price
                print("</cell>");
							
             print("</row>");
			 
        }
		}
        print("</rows>");
    ?>