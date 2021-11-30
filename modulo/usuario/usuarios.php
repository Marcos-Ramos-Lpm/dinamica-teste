<?php
require_once __DIR__ . '/../app/class/gApp.php';
$gApp = new gApp();
?>
<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <?php require_once 'assets/content/head.php'; ?>
        <link href="<?php echo Url::getBase() ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo Url::getBase() ?>assets/plugins/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo Url::getBase() ?>assets/plugins/summernote/dist/summernote.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo Url::getBase() ?>assets/plugins/fancybox/jquery.fancybox.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo Url::getBase() ?>assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet" type="text/css"/>
    </head>

    <body class="fix-header fix-sidebar logo-center card-no-border">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <?php require_once './assets/content/header.php'; ?>
            <?php require_once './assets/content/left-sidebar.php'; ?>
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">USUÁRIOS</h3>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo Url::getBase() ?>home">Home</a></li>
                            <li class="breadcrumb-item active">Usuários</li>
                        </ol>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="col-sm-12 col-lg-12 col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-right">
                                        <div class="btn-group">
                                            <a href="adicionar-usuario"  class="btn btn-sm btn-secondary">Novo <i class="fa fa-plus"></i></a>
                                            <button class="btn btn-sm btn-secondary" onclick="history.back()">Voltar <i class="fa fa-reply"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tabela-usuario" class="table w-100 table-hover table-bordered table-striped" >
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>NOME</th>
                                                    <th>DADOS</th>
                                                    <th>DATA</th>
                                                    <th>SITUAÇÃO</th>
                                                    <th>OPÇÕES</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once 'assets/content/footer.php'; ?>
            </div>
        </div>

        <!-- ============================================================== -->
        <script src="<?php echo Url::getBase() ?>assets/plugins/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/plugins/popper/popper.min.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/js/jquery.slimscroll.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/js/waves.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/js/sidebarmenu.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/js/custom.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/js/jquery.form.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/plugins/blockUI/jquery.blockUI.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/plugins/jcrop/js/jquery.Jcrop.min.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/plugins/jquery-validation-1.19.0/dist/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/plugins/summernote/dist/summernote.min.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/js/meiomask.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>modulo/app/js/boot.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/plugins/toast-master/js/jquery.toast.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>assets/plugins/fancybox/jquery.fancybox.min.js" type="text/javascript"></script>
        <script src="<?php echo Url::getBase() ?>modulo/usuario/js/usuarios.js" type="text/javascript"></script>
    </body>

</html>
