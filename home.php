<?php
require_once __DIR__ . '/modulo/app/class/gApp.php';
$gApp = new gApp();
?>
<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <?php require_once 'assets/content/head.php'; ?>
    </head>

    <body class="fix-header fix-sidebar logo-center card-no-border">
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <div id="main-wrapper">
            <?php require_once __DIR__.'./assets/content/header.php'; ?>
            <?php require_once './assets/content/left-sidebar.php'; ?>
            <div class="page-wrapper">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Página Inicial</h3>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        </ol>
                    </div>
                </div>
               
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <div class="alert alert-warning">
                                        <i class="fa fa-info"></i> Sistema em modo de desenvolvimento!
                                    </div>
                                    <div class="alert alert-warning">
                                        Bem vindo codigo : <strong><?php echo $gApp->getUser() ?></strong><?php ?><br>
                                        Bem vindo Nome:  <strong><?php echo $gApp->getNameUser() ?></strong><?php ?><br>
                                        Bem vindo CPF: <strong><?php echo $gApp->getCpfUser() ?></strong><?php ?><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <?php require_once 'assets/content/footer.php'; ?>
            </div>
            
        </div>
       
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/sidebarmenu.js"></script>
        <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
        <script src="assets/js/custom.js"></script>
    </body>

</html>
