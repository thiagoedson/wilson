<?php

use App\App;
use Usuario\Usuario;

session_start();
require_once '../../include/info.php';

$app = new App();
$modulo = $app->Modulo();
$tela   = $modulo->Tela();

$usuario_page = new Usuario(getUsuarioSessao());

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
                    <div class="col-sm-6">
                        <div class="card card-body shadow-sm">
                            <h4>
                                <?php echo $usuario_page->getNome();?>
                            </h4>
                            <table>
                                <tr>
                                    <th>Login</th>
                                    <td><?php echo $usuario_page->getLogin();?></td>
                                </tr>
                                <tr>
                                    <th>Celular 1</th>
                                    <td><?php echo $usuario_page->getCelular1();?></td>
                                </tr>
                                <tr>
                                    <th>Celular 2</th>
                                    <td><?php echo $usuario_page->getCelular2();?></td>
                                </tr>
                                <tr>
                                    <th>Telefone</th>
                                    <td><?php echo $usuario_page->getTelefone();?></td>
                                </tr>
                                <tr>
                                    <th>E-mail</th>
                                    <td><?php echo $usuario_page->getEmail();?></td>
                                </tr>
                                <tr>
                                    <th>Grupo</th>
                                    <td><?php echo $usuario_page->getGrupoNome();?></td>
                                </tr>
                                <tr>
                                    <th>Representa????o</th>
                                    <td><?php echo $usuario_page->getReprese();?></td>
                                </tr>
                                <tr>
                                    <th>Cidade</th>
                                    <td><?php echo $usuario_page->getCidade();?></td>
                                </tr>
                                <tr>
                                    <th>UF</th>
                                    <td><?php echo $usuario_page->getUF();?></td>
                                </tr>
                            </table>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-warning shadow-sm">
                                        <i class="fas fa-key"></i>
                                        Trocar senha
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-body shadow-sm">
                            <h4>
                                Minha loja
                            </h4>
                            <p>
                                <?php echo $usuario_page->getLoja();?>
                            </p>
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
                <h5 class="modal-title" id="exampleModalLabel">Est?? certo disso ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">??</span>
                </button>
            </div>
            <div class="modal-body">Tem certeza que deseja sair ? </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Voltar</button>
                <a class="btn btn-primary" href="../app/sair.php">Sair</a>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../assets/appv2.min.js?v=<?php echo $app->getVersao(); ?>"></script>
</html>