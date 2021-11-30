<?php
session_start();
include"../conexao.php";
        //set content type and xml tag
        header("Content-type:text/xml");
        print("<?xml version=\"1.0\"?>");
 
        //define variables from incoming values
        if(isset($_GET["posStart"]))
            $posStart = $_GET['posStart'];
        else
            $posStart = 0;
        if(isset($_GET["count"]))
            $count = $_GET['count'];
        else
            $count = 100;
		
#		$sql = "SELECT * FROM `pedido_pfw13` WHERE `Cliente` = '$loja'";
        //if this is the first query - get total number of records in the query result
#        if($posStart==0){
#            $sqlCount = "Select count(*) as `id` from ($sql) as `pedido_pfw13` WHERE `Cliente` = '$loja'";
#            $resCount = mysql_query ($sqlCount);
#            $rowCount=mysql_fetch_array($resCount);
#            $totalCount = $rowCount["id"];
#        }
 
        //add limits to query to get only rows necessary for the output
#        $sql.= " LIMIT ".$posStart.",".$count;
 
        //query database to retrieve necessary block of data
		
		
		
 
        //output data in XML format   
        print("<rows total_count='".$totalCount."' pos='".$posStart."'>"); 
		
		#-- Endereço da pasta da xls do representante
		
		$query_folder = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`usuarios` WHERE `id` = '$represe'");
        
		while($array_folder = mysqli_fetch_array($query_folder)){
			
			$folder = $array_folder["endereco"];
			
		}
		#-------------------------------------------------
		
		$query_pedidos = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`loja_table`");
        
		while($array_pedido = mysqli_fetch_array($query_pedidos)){
			
			$table = $array_pedido["banco"];
			$id_table = $array_pedido["id"];
			$xls_table = $array_pedido["xls"];
			
		$res = mysqli_query($con, "SELECT * FROM `$table` WHERE `status` = '5'");
		
		
		$id_index .= +1;
        while($row = mysqli_fetch_array($res)){
			
            print("<row id='".$id_index++."'>");
                
                print("<cell>");
                   $query_cliente = mysqli_query($con, "SELECT * FROM `login` WHERE `B` ='".$row['cliente']."'");
					while($row_cliente=mysqli_fetch_array($query_cliente)){
					$nome_loja_final = str_replace("&","E",$row_cliente['loja']);                    
				    print($nome_loja_final); //value for price
					 print("<![CDATA[".$nome_loja_final."^_perfil.php?login=".$row['cliente']."^iframe_a]]>");  //value for internal code	  
					}
				print("</cell>");
				print("<cell>");
				    print("<![CDATA[".$row['npedido']."^xls/".$xls_table."?npedido=".$row['npedido']."^iframe_a]]>");  //value for internal code
				print("</cell>");
				print("<cell>");
				    print("<![CDATA[|Download|^".$folder."/order/ordens/".$xls_table."?npedido=".$row['npedido']."^iframe_a]]>");  //value for internal code
				print("</cell>");
				print("<cell>");
				    print("<![CDATA[|Download|^".$folder."/xls/".$xls_table."?npedido=".$row['npedido']."^iframe_a]]>");  //value for internal code
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
					$entrega_revisada = date('d-m-Y', strtotime($row['data_2']));
                    print($entrega_revisada);    //value for price                    
                print("</cell>");			   
			    print("<cell>");
					 $query_rotulo_status = mysqli_query($con, "SELECT * FROM `rbkne024_reebok`.`status` WHERE `id` ='".$row['status']."'");
					 while($row_cliente_status = mysqli_fetch_array($query_rotulo_status)){
				    print($row_cliente_status['rotulo']);
					 }
                print("</cell>");
				print("<cell>");
					 $query_rotulo_type = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`loja_table` WHERE `id` ='$id_table'");
					 while($row_cliente_type = mysqli_fetch_array($query_rotulo_type)){
				    print("<![CDATA[|Excluir|^?chamar&pedido=".$row['npedido']."&tipo=".$row_cliente_type['tipo']."^iframe_a]]>");
					 }
				print("</cell>");
				print("<cell>");
					 $query_rotulo_type = mysqli_query($con,"SELECT * FROM `rbkne024_reebok`.`loja_table` WHERE `id` ='$id_table'");
					 while($row_cliente_type = mysqli_fetch_array($query_rotulo_type)){
				    print("<![CDATA[|Restaurar|^?chemar&pedido=".$row['npedido']."&tipo=".$row_cliente_type['tipo']."^iframe_a]]>");
					 }//value for internal code
				print("</cell>");
				print("<cell>");
					$id_loja = $row['cliente'];
					$query_log = mysqli_query($con, "SELECT * FROM `$banco`.`location_user` WHERE `codigo` = '$id_loja' ORDER BY `data` DESC LIMIT 1");
								while($row_log = mysqli_fetch_array($query_log)){	
								$data_log = $row_log['data'];
								if($data_log == "") {$data_log = "-";}
								$data_log = date('d-m-Y H:i:s', strtotime($row['data']));			        
                    print($data_log);    //value for price
								}
                print("</cell>");
							
             print("</row>");
			 
        }
		}
        print("</rows>");
    ?>