<?php
require_once __DIR__ . '/../app/class/gApp.php';
$gApp = new gApp();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <?php require_once 'assets/content/head.php'; ?>
    <link href="<?php echo Url::getBase() ?>assets/plugins/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Url::getBase() ?>assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Url::getBase() ?>assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="fix-header fix-sidebar logo-center card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
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
                    <h3 class="text-themecolor">ADICIONAR USUÁRIO</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo Url::getBase() ?>home">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo Url::getBase() ?>usuario/usuarios">Usuário</a></li>
                        <li class="breadcrumb-item active">Adicionar parceiro</li>
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
                                        <button onclick="history.back();" class="btn btn-sm btn-secondary">Voltar <i class="fa fa-reply"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data" id="add-usuario" action="<?php echo Url::getBase() ?>modulo/usuario/add/adicionar-usuario.php">
                                    <div class="row">
                                        <div class="col-sm-4 col-lg-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="cpf">CPF<span class="text-danger">*</span></label>
                                                <input type="tel" name="cpf" id="cpf" class="form-control" required="true" onchange="Boot.validarCpfUsuario(this.value)" />
                                            </div>
                                        </div>
                                        <div class="col-sm-8 col-lg-8 col-xs-12">
                                            <div class="form-group">
                                                <label for="nomeUsuario">Nome completo<span class="text-danger">*</span></label>
                                                <input type="text" name="nomeUsuario" id="nomeUsuario" class="form-control" required="true" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="emailUsuario">E-mail<span class="text-danger">*</span></label>
                                                <input type="email" name="emailUsuario" id="emailUsuario" class="form-control" required="true" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12 col-xs-12">
                                            <div class="form-group"> <label for="imagem">Imagem<span class="text-danger">*</span></label> <input type="file" name="imagem" id="imagem" class="form-control" /> <span class="help-block text-info"><i class="fa fa-info-circle"></i> Selecione imagens nas dimensões 220x220</span></div>
                                            <div class="d-none"> <label>X1 <input type="text" size="4" id="x" name="x" /> </label> <label>Y1 <input type="text" size="4" id="y" name="y" /> </label> <label>Y2 <input type="text" size="4" id="y2" name="y2" /> </label> <label>W <input type="text" size="4" id="w" name="w" /> </label> <label>H <input type="text" size="4" id="h" name="h" /> </label> <input id="rx" name="rx" type="hidden" value="" /> <input id="ry" name="ry" type="hidden" value="" /> <input id="rw" name="rw" type="hidden" value="" /> <input id="rh" name="rh" type="hidden" value="" /></div>
                                            <div class="row mb-5">
                                                <div class="col-sm-6 estrutura-preview-imagem hidden"><img src="" class="" id="previsualizacao" /></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12 col-xs-12">
                                            <div class="form-group" id="listar-modulos">

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <div class="btn-group right">
                                                <button type="reset" class="btn btn-sm btn-secondary">Limpar <i class="fa fa-eraser"></i></button>
                                                <button type="submit" class="btn btn-sm btn-secondary">Salvar <i class="fa fa-send-o"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
    <script src="<?php echo Url::getBase() ?>assets/js/custom.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>assets/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>assets/js/jquery.form.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>assets/plugins/jcrop/js/jquery.Jcrop.min.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>assets/plugins/jquery-validation-1.19.0/dist/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>assets/plugins/toast-master/js/jquery.toast.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>assets/plugins/blockUI/jquery.blockUI.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>assets/js/meiomask.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>modulo/app/js/boot.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>modulo/usuario/js/adicionar-usuario.js" type="text/javascript"></script>
</body>

</html>