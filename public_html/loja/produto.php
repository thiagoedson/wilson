<?php

use App\App;
use Loja\Loja;
use Produto\Produto;
use Usuario\Usuario;

session_start();
require_once '../../include/info.php';

$app    = new App();
$modulo = $app->Modulo();
$tela   = $modulo->Tela();

$loja = new Loja();
$loja->setColecao($_GET['q']);
$produto = new Produto($_GET['i'])
?>
<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="msapplication-TileColor" content="<?php echo $app->getAppThemecolor(); ?>">
    <meta name="theme-color" content="<?php echo $app->getAppThemecolor(); ?>">
    <title><?php echo $app->getAppName(); ?></title>
    <link href="../assets/appv2.min.css?v=<?php echo $app->getVersao(); ?>" type="text/css" rel="stylesheet">

    <link rel="shortcut icon" href="../assets/favicon.ico"/>
    <title>
        <?php
        echo $app->getAppName();
        ?>
    </title>

</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <?php
        echo $app->GerarMenuLeft();
        ?>


    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Topbar Navbar -->
                <?php
                echo $app->GerarHeaderTopMenu();
                ?>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->

                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb shadow-sm ">
                            <li class="breadcrumb-item">
                                <a href="../<?php echo $modulo->getUrl(); ?>"><?php echo $modulo->getNome(); ?></a>
                            </li>
                            <li class="breadcrumb-item active"><?php echo $tela->getNome(); ?></li>
                        </ol>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-9">
                        <div class="card card-body shadow-sm">
                            <h4>
                                <i class="fas fa-cart-plus text-success"></i>

                                <?php echo $loja->getNome(); ?>
                            </h4>
                            <p class="text-primary">
                                <?php echo $loja->getDescricao(); ?> (<?php echo $loja->getTipo(); ?>)
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <a href="../loja/carrinho.php" class="text-decoration-none">
                            <div class="card card-body bg-warning shadow-sm text-dark text-center">
                                <h4>
                                    <i class="fas fa-shopping-cart"></i>
                                    Carrinho
                                </h4>
                            </div>
                        </a>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-body mt-4 shadow-sm">

                            <div class="row">
                                <div class="col-sm-4">
                                    <h2>
                                        <?php
                                        echo $produto->getNome();
                                        ?>
                                        -
                                        <?php
                                        echo $produto->getCodigoReferencia();
                                        ?>
                                    </h2>
                                    <?php

                                    $dir_img = '../img/prod/'.$produto->getCodigoReferencia().'.jpeg';

                                    if(file_exists($dir_img)){

                                        $produto->setFoto($dir_img);
                                        $produto->Salvar();
                                        ?>
                                        <img src="<?php echo $dir_img;?>" class="img-fluid" title="<?php echo $produto->getNome();?>" alt="<?php echo $produto->getNome();?>">
                                        <?php

                                    } else {

                                        ?>
                                        <img src="<?php echo $produto->getFoto();?>" class="img-fluid" title="<?php echo $produto->getNome();?>" alt="<?php echo $produto->getNome();?>">
                                    <?php
                                    }
                                    ?>

                                </div>
                                <div class="col-sm-6">
                                    <h2>
                                        PDV <?php echo $produto->getValorVenda();?>
                                    </h2>
                                    <h3>
                                        Custo <?php echo $produto->getValorCusto();?>
                                    </h3>
                                    <pre>
                                        <?php
                                        print_r($produto);
                                        ?>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php
        echo $app->GerarFooter();
        ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Está certo disso ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tem certeza que deseja sair ?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Voltar</button>
                <a class="btn btn-primary" href="../app/sair.php">Sair</a>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../assets/appv2.min.js?v=<?php echo $app->getVersao(); ?>"></script>
<script>
    let $table = $('#table');
    $(document).ready(function () {


        CarregaProdutos();

        $("#procura").on('focusout',function (e){
            CarregaProdutos(this.value);
        });

    });


    function linkAcesso(row, index) {
        try {

            return '<a href="orcamento.php?id=' + index.id + '" class="btn btn-dark btn-sm"><i class="fas fa-sign-in-alt"></i></a>';

        } catch (e) {
            console.log(e);
        }
    }

    function rowStyle(row, index) {

        if (row.origem == "calculadora") {
            return {
                classes: 'table-warning'
            }
        }


        return {
            classes: ''

        }

    }

    function datesSorter(value, row, index) {

        if (value == null) {

            return null;

        } else {
            return moment(new Date(value)).format('DD/MM/YYYY HH:mm:ss');
        }
    }

    function dateSorter(value, row, index) {


        if (moment(value).isValid()) {

            return moment(value).format('DD/MM/YYYY');
        } else {
            return null;
        }


    }

    function NumFormatter(data) {
        return parseFloat(data).toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function CarregaProdutos(procura) {
        try {

            $.ajax({
                url: 'consulta.php?ACAO=CarregaProdutos',
                type: 'post',
                data: {
                    ACAO: 'CarregaProdutos',
                    procura: procura,
                    tipo :'<?php echo $_GET['q'];?>'
                },
                dataType: 'json',

                success: function (response) {

                    return $("#load_produto").html(response.html);

                },
                error: function (e) {


                },
                complete: function (response) {
                    return $("#load_produto").html(response.html);
                }
            });

        } catch (e) {
            console.log(e);
        }
    }

</script>
</html>