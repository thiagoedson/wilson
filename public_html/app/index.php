<?php

use App\App;

session_start();
require_once '../../include/info.php';

$app = new App();

?>
<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="msapplication-TileColor" content="<?php echo $app->getAppThemecolor(); ?>">
    <meta name="theme-color" content="<?php echo $app->getAppThemecolor(); ?>">
    <title>Itanet® - Intranet da Administração Municipal de Itapema </title>
    <link href="../assets/appv2.min.css?v=<?php echo $app->getVersao(); ?>" type="text/css" rel="stylesheet">
    <script src="../assets/appv2.min.js?v=<?php echo $app->getVersao(); ?>" type="text/javascript"></script>
    <link rel="shortcut icon" href="../assets/favicon.ico"/>
    <title>adisul.net</title>

</head>
<body>
<div class="container-fluid conya">
    <div class="side-left">
        <div class="sid-layy">
            <div class="row slid-roo">
                <div class="data-portion">
                    <h2>adisul.net</h2>
                    <p>Somente as melhores marcas esportivas </p>
                    <ul>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="side-right">
        <img class="logo" src="<?php echo $app->getAppLogo()?>" alt="">
        <hr>
        <h4>Acesso restrito</h4>

        <div class="form-row">
            <label for="">E-mail</label>
            <input type="text" placeholder="yourname@company.com" class="form-control form-control-sm">
        </div>

        <div class="form-row">
            <label for="">Senha</label>
            <input type="text" placeholder="senha" class="form-control form-control-sm">
        </div>

        <div class="form-row row ">

            <div class="col-sm-12 text-center">
                <small> <a href="#" disabled="true">Esqueçeu a senha ?</a></small>
            </div>


        </div>


        <div class="form-row dfr">
            <button class="btn btn-sm btn-success">Login</button>
        </div>


        <div class="ord-v">
            <a href="or login with"></a>
        </div>

        <div class="soc-det">

        </div>



    </div>
    <div class="copyco">
        <p>Copyrigh <?php echo date('Y');?> @adisul.net</p>
    </div>
</div>
</body>
<script>
    $( document ).ready(function() {

        setInterval(setBGLogin, 300)

    });

    function setBGLogin(){
        var arr = ['bg_1.jpg','bg_2.jpg','bg_3.jpg'];

        var i = 0;
        if(i == arr.length - 1){
            i = 0;
        }else{
            i++;
        }
        var img = 'url(../assets/images/'+arr[i]+')';
        $(".full-bg").css('background-image',img);

    }
</script>
</html>