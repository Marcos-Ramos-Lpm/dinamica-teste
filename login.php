<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <?php require_once 'assets/content/head.php'; ?>
    <link href="<?php echo Url::getBase() ?>assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo Url::getBase() ?>assets/css/login.css">
</head>

<body>
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <section>
        <div class="container">
            <div class="row" id="form-login">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                    <div class="card-body">
                        <form class="form-horizontal form-material" method="post" id="loginform" action="modulo/app/add/acessar-sistema.php">
                            <h3 class="box-title text-center mb-5">
                                
                            </h3>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" required name="email" placeholder="E-mail">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" required name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 font-14">
                                    <!-- <a href="#" id="recuperar-senha" onclick="Login.tipoForm()" class="text-dark pull-right">
                                        <i class="fa fa-lock m-r-5"></i> Esqueceu sua senha?
                                    </a> -->
                                </div>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-lg btn-sm text-uppercase waves-effect waves-light" type="submit">Entrar</button>
                                </div>
                            </div>
                        </form>
                        <form class="form-horizontal d-none" method="post" id="recuperarSenha" action="<?php echo Url::getBase() ?>modulo/app/add/recuperar-senha-usuario.php">
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <h3>Recuperação de senha</h3>
                                    <div class="alert alert-warning">
                                        <i class="fa fa-warning"></i> Informe o seu email para recuperação de senha!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <label for="email">Informe o email.</label>
                                    <input class="form-control" name="email" id="email" type="text" required="" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <small><i class="fa fa-warning"></i> Após o reset da senha, sera enviado uma senha provisoria ao email informado!</small>

                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-sm btn-block text-uppercase waves-effect waves-light" type="submit">Resetar senha</button>
                                </div>
                            </div>
                        </form>
                        <form method="post" class="d-none" id="trocar-senha-provisoria" name="form-senha-padrao" action="<?php echo Url::getBase() ?>modulo/app/add/mudar-senha-padrao.php">
                            <input type="hidden" name="emailLogin" />
                            <input type="hidden" name="senhaPadrao" />
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <div class="alert alert-warning">
                                        <i class="fa fa-warning"></i> A sua senha e uma senha provisória, digite uma nova senha!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <label for="primeiraSenha">Digite uma senha<span class="text-danger">*</span></label>
                                    <input class="form-control" name="primeiraSenha" id="primeiraSenha" type="password" required="" placeholder="Digite uma senha">
                                </div>
                                <div class="col-xs-12 mt-4">
                                    <label for="segundaSenha">Digite novamente a senha<span class="text-danger">*</span></label>
                                    <input class="form-control" name="segundaSenha" id="segundaSenha" type="password" required="" placeholder="Digite novamente a senha">
                                </div>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-sm btn-block text-uppercase waves-effect waves-light" type="submit">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="assets/js/custom.min.js"></script>
    <script src="modulo/app/js/boot.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>assets/plugins/jquery-validation-1.19.0/dist/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>assets/js/jquery.form.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>assets/plugins/toast-master/js/jquery.toast.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>assets/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>assets/plugins/blockUI/jquery.blockUI.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>modulo/app/js/login.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>modulo/app/js/resetar-senha-padrao.js" type="text/javascript"></script>
    <script src="<?php echo Url::getBase() ?>modulo/app/js/recuperar-senha.js" type="text/javascript"></script>
</body>

</html>