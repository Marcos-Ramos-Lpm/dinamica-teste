<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <?php
        require_once __DIR__ . '/assets/content/head.php';
        ?>
    </head>

    <body class="fix-header card-no-border logo-center">
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <section id="wrapper" class="error-page">
            <div class="error-box">
                <div class="error-body text-center">
                    <h1>404</h1>
                    <h3 class="text-uppercase">Página não encontrada!</h3>
                    <p class="text-muted m-t-30 m-b-30"></p>
                    <button onclick="history.back()" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Voltar</button> </div>
                <footer class="footer text-center">© 2019 Boot Sistemas.</footer>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="<?php echo Url::getBase() ?>assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="<?php echo Url::getBase() ?>assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="<?php echo Url::getBase() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <!--Wave Effects -->
        <script src="<?php echo Url::getBase() ?>assets/js/waves.js"></script>
    </body>

</html>
