<?php
session_start();
include"../conexao.php";
$loja = $_GET["star"];

        //set content type and xml tag
        header("Content-type:text/xml");
        print("<?xml version=\"1.0\"?>");
 
     
 
        //output data in XML format   
        print("<rows total_count='".$totalCount."' pos='".$posStart."'>");   
		
		
			
		$res = mysqli_query($con,"SELECT * FROM `login` ORDER BY `loja`");
		
		
		$id_index = 1;
        while($row = mysqli_fetch_array($res)){
			
            print("<row id='".$id_index++."'>");
                print("<cell>");
		    print($row['B']);  //value for internal code
		print("</cell>");
                print("<cell>");
                    print($row['C']);    //value for price
                print("</cell>");
                print("<cell>"); 
		    print($row['loja']);    //value for price	 
	        print("</cell>");
		print("<cell>");			        
                    print($row['nome']);    //value for price
                print("</cell>");
		print("<cell>");
		    print($row['status']);    //value for price	 
                print("</cell>");
                print("<cell>");
		    print($row['email']);    //value for price	 
                print("</cell>");
                print("<cell>");
		    print($row['segmento_2']);    //value for price	 
                print("</cell>");									
             print("</row>");			 
        }
		
        print("</rows>");
    ?>