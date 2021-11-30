<?php
session_cache_limiter( 'nocache' );
session_start();
include"../conexao.php";
if(isset($_POST['evento'])){
		

        //faz upload do arquivo CSV para uma pasta com permissão 0777
        $arq = $_FILES["arq"]; // pegar o nome da foto 
        $arq_nome = $arq["name"]; // pegar o nome da foto
  
        $arqv_temporario = $_FILES['arq']["tmp_name"]; 
        if(move_uploaded_file($arqv_temporario, "upload/". $arq_nome)) {}
        
        // faça a conexão com seu servidor local, caso você tenha startado pelo XAMPP a senha deixe em branco.
        // Os argumentos são "localhost" destino que você ta dando pra estabelecer conexão.
        // "root" nome de usuário que você precisa para ter acesso ao banco de dados mysql.
        // "pass" a senha.
       

        //Usando $abraArq para abrir arquivos com r você apenas vai lê-lo com w ou w+ você pode alterar e caso queira ler e depois alterar só usar as duas rw ou rw+.
        // Selecione o destino que você vai usar como coloquei esse script no mesmo local do arquivo csv apenas escrevi o nome do arquivo com sua extensão.

        $abraArq = fopen("upload/". $arq_nome, "r");

        //Apenas para ficar com mais controle melhor colocar um tratamento de erros caso o arquivo são seja aberto ai use as condições if e else. E imprima na tela com um echo()
        if (!$abraArq){
                header("location:../impor.php?msg=2"); 
        }else{
			
			$query_delete = mysql_query("DROP TABLE  `tree`");
 
        // Caso abra faça isso agora
        // usando a nova função do php 5 fgetcsv() o 2048 é apenas para colocar o número máximo de caracteres por linha.
        // crie uma variável chamada $valores o que vai corresponder pelos valores das colunas para serem inseridas.

        while ($valores = fgets($abraArq)) {
                $linha = explode(";",$valores);                
                $grupo = trim(addslashes($linha[1]));
                $cliente = trim(addslashes($linha[2]));
                $artigo = trim(addslashes($linha[3]));
                $venda = trim(addslashes($linha[4]));
                $estoque = trim(addslashes($linha[5]));
                $mes = trim(addslashes($linha[6]));
                $ano = trim(addslashes($linha[7]));
				
              
				
				$query_table = mysql_query("
 CREATE TABLE  `tree` (
 `id` INT( 255 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `grupo` VARCHAR( 255 ) NOT NULL ,
 `cliente` VARCHAR( 255 ) NOT NULL ,
 `artigo` VARCHAR( 255 ) NOT NULL ,
 `venda` INT( 255 ) NOT NULL ,
 `estoque` INT( 255 ) NOT NULL ,
 `mes` VARCHAR( 255 ) NOT NULL ,
 `ano` VARCHAR( 255 ) NOT NULL
) ENGINE = INNODB;");

                // Só criar agora o construtor que pegou os valores das colunas do arquivo csv. E começar a inserir dentro da base de dados.
                $result = mysql_query("INSERT INTO tree (grupo, cliente, artigo, venda, estoque, mes, ano) 
                                                           values ('$grupo', '$cliente', '$artigo', '$venda', '$estoque', '$mes', '$ano')");

           // $num = count($valores);
           // echo "<p> $num campos na linha $row: <br /></p>\n";
           // $row++;
           //   for ($c=0; $c < $num; $c++) {
           //     echo $valores[$c] . "<br />\n";
           //   }
                // Ai no caso do id se você criou como auto incremento use uma função do mySQL para isso que é inserir em outra tabela os últimos id inseridos. O que não entraria em ambigüidade.
                //$ultimo_id = mysql_insert_id();
                //$result = mysql_query("insert into tabelaDois (id,endereco,msn) values("","" . $ultimo_id. "","" .$data[0]."","".$data[1]."")");
         }
          $msg = "O arquivo <strong>". $arq_nome ."</strong> foi totalmente importado com sucesso!";
		  
		  header("location:../impor.php?msg=1");    }
// Só fechar agora o arquivo
fclose($abraArq);
        
}
?>