<?php
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );

include"../conexao.php";

	$cod_estados = mysql_real_escape_string( $_REQUEST['cod_estados'] );

	$cidades = array();

	$sql = "SELECT * FROM `rbkne024_reebok`.`tb_cidades` WHERE `estado`='$cod_estados' ORDER BY nome";
	$res = mysqli_query($con, $sql );
	while ( $row = mysql_fetch_assoc( $res ) ) {
		$cidades[] = array(
			'id'	=> $row['id'],
			'nome'			=> $row['nome'],
		);
	}

	echo( json_encode( $cidades ) );