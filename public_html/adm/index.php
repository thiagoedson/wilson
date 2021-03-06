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
<!DOCTYPE html>
<html lang="pt-br">
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
                    <div class="col-sm-8">
                        <div class="card card-body shadow-sm">

                            <div class="form-group">
                                <label for="tipo_tabela">
                                    Tipo
                                </label>
                                <select class="form-control" id="tipo_tabela" name="tipo_tabela">
                                    <option value="pronta_entrega">Pronta entrega</option>
                                    <option value="prevendass22">Pr??-venda SS22</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="input-id">
                                    <i class="fas fa-paperclip"></i>
                                    Anexo
                                </label>
                                <input id="input-id" name="arquivo" type="file" class="file" data-preview-file-type="text">
                                <div id="errorBlock" class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card card-body shadow-sm" id="importador_feed"></div>
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
<script src="../assets/appv2.min.js?v=<?php echo $app->getVersao(); ?>" type="text/javascript"></script>
<script>
    $("#input-id").fileinput({
        language: "pt-BR",
        theme: "explorer",
        uploadUrl: "consulta.php?ACAO=UploadFileNovo",
        uploadAsync: true,
        previewFileType: 'any',
        minFileCount: 0,
        maxFileCount: 1,
        allowedFileExtensions: ["txt", "pdf", "doc", "text", "xlsx", "rar", "zip", "oct", "docx", "xls", "cot", "COT"],
        maxFileSize: 250000,
        uploadExtraData: function (previewId, index) {

            let tipo = $("#tipo_tabela").val();
            let info = {
                tipo: tipo,
                codigo_grupo: "",
                ACAO: "UploadFileNovo"
            };
            return info;
        }
    });
</script>
</html>