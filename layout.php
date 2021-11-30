<?php
require_once __DIR__ . '/modulo/app/class/gApp.php';
$gApp = new gApp();
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet" type="text/css"/>
        <?php require_once 'assets/content/head.php'; ?>
    </head>
    <body class="fix-header fix-sidebar logo-center card-no-border">
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <div id="main-wrapper">
            <?php require_once './assets/content/header.php'; ?>
            <?php require_once './assets/content/left-sidebar.php'; ?>
            <div class="page-wrapper">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Layout</h3>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo Url::getBase() ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                        </ol>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-2 col-lg-2 col-xs-12">
                                            <h6>Botões da GRID</h6>
                                            <div class="btn-group">
                                                <button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Visualizar dados"><i class="fa fa-eye"></i></button>
                                                <button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Editar dados"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-secondary btn-xs"  data-toggle="tooltip" title="Inativar"><i class="fa fa-ban text-danger"></i></button>
                                                <button class="btn btn-secondary btn-xs"  data-toggle="tooltip" title="Ativar"><i class="fa fa-check text-success"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-lg-3 col-xs-12">
                                            <h6>Botões do FORM</h6>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-secondary">Limpar <i class="fa fa-eraser"></i></button>
                                                <button class="btn btn-sm btn-secondary">Cancelar <i class="fa fa-times"></i></button>
                                                <button class="btn btn-sm btn-secondary">Salvar <i class="fa fa-send-o"></i></button>
                                            </div>
                                        </div>

                                        <div class="col-sm-2 col-lg-2 col-xs-12">
                                            <h6>Botões do CONFIRM</h6>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-secondary">Sim <i class="fa fa-check text-success"></i></button>
                                                <button class="btn btn-sm btn-secondary">Não <i class="fa fa-times text-danger"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-sm-4 col-lg-4 col-xs-12">
                                            <h6>Inputs validation Error</h6>
                                            <input type="text" class="form-control error" />
                                            <label class="error">Campo obrigatório</label>
                                        </div>
                                        <div class="col-sm-4 col-lg-4 col-xs-12">
                                            <h6>Inputs validation Sucesso</h6>
                                            <input type="text" class="form-control valid" />
                                        </div>
                                        <div class="col-sm-4 col-lg-4 col-xs-12">
                                            <h6>Select com funcionaliades</h6>
                                            <div class="input-group">
                                                <select class="form-control">
                                                    <option>Opção</option>
                                                    <option>Opção</option>
                                                    <option>Opção</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-xs btn-secondary" type="button"><i class="fa fa-plus-circle"></i></button>
                                                    <button class="btn btn-xs btn-secondary" type="button"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-12 col-lg-12 col-xs-12">
                                            <h6>Mensagens</h6>
                                            <div class="alert alert-success"><i class="fa fa-check"></i> Mensagem de sucesso</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12 col-xs-12">
                                            <div class="alert alert-danger"><i class="fa fa-times"></i> Mensagem de erro</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12 col-xs-12">
                                            <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Mensagem de alerta</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12 col-xs-12">
                                            <div class="alert alert-info"><i class="fa fa-info-circle"></i> Mensagem de informação</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12 col-lg-12 col-xs-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="btn-group w-100 pl-5 pr-5">
                                                <button class="btn btn-secondary" id="toast1">Toast Sucesso</button>
                                                <button class="btn btn-secondary" id="toast2">Toast Informativo</button>
                                                <button class="btn btn-secondary" id="toast3">Toast Alerta</button>
                                                <button class="btn btn-secondary" id="toast4">Toast Error</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Abas lateral</h4>
                                            <div class="vtabs customvtab">
                                                <ul class="nav nav-tabs tabs-vertical" role="tablist">
                                                    <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#home3" role="tab" aria-selected="true"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Aba</span> </a> </li>
                                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile3" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Aba</span></a> </li>
                                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages3" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Aba</span></a> </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane p-20 active show" id="home3" role="tabpanel">Aba 1</div>
                                                    <div class="tab-pane p-20" id="profile3" role="tabpanel">Aba 2</div>
                                                    <div class="tab-pane p-20" id="messages3" role="tabpanel">Aba 3</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body p-b-0">
                                            <h4 class="card-title">Aba horizontal</h4>
                                            <ul class="nav nav-tabs customtab" role="tablist">
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home2" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Aba</span></a> </li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Aba</span></a> </li>
                                                <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#messages2" role="tab" aria-selected="true"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Aba</span></a> </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane p-20" id="home2" role="tabpanel">Aba 1</div>
                                                <div class="tab-pane p-20" id="profile2" role="tabpanel">Aba 2</div>
                                                <div class="tab-pane p-20 active show" id="messages2" role="tabpanel">Aba 3</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12 col-lg-12 col-xs-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title float-left">Título do card (caso não seja o 1º card)</h4>
                                            <div class="float-right">
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-secondary">Novo <i class="fa fa-plus"></i></button>
                                                    <button class="btn btn-sm btn-secondary">Voltar <i class="fa fa-reply"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="example" class="table w-100 table-hover table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Position</th>
                                                            <th>Office</th>
                                                            <th>Age</th>
                                                            <th>Start date</th>
                                                            <th>Options</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Tiger Nixon</td>
                                                            <td>System Architect</td>
                                                            <td>Edinburgh</td>
                                                            <td>61</td>
                                                            <td>2011/04/25</td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Visualizar dados"><i class="fa fa-eye"></i></button>
                                                                    <button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Editar dados"><i class="fa fa-edit"></i></button>
                                                                    <button class="btn btn-secondary btn-xs"  data-toggle="tooltip" title="Inativar"><i class="fa fa-ban text-danger"></i></button>
                                                                    <button class="btn btn-secondary btn-xs"  data-toggle="tooltip" title="Ativar"><i class="fa fa-check text-success"></i></button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tiger Nixon</td>
                                                            <td>System Architect</td>
                                                            <td>Edinburgh</td>
                                                            <td>61</td>
                                                            <td>2011/04/25</td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Visualizar dados"><i class="fa fa-eye"></i></button>
                                                                    <button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Editar dados"><i class="fa fa-edit"></i></button>
                                                                    <button class="btn btn-secondary btn-xs"  data-toggle="tooltip" title="Inativar"><i class="fa fa-ban text-danger"></i></button>
                                                                    <button class="btn btn-secondary btn-xs"  data-toggle="tooltip" title="Ativar"><i class="fa fa-check text-success"></i></button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tiger Nixon</td>
                                                            <td>System Architect</td>
                                                            <td>Edinburgh</td>
                                                            <td>61</td>
                                                            <td>2011/04/25</td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Visualizar dados"><i class="fa fa-eye"></i></button>
                                                                    <button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Editar dados"><i class="fa fa-edit"></i></button>
                                                                    <button class="btn btn-secondary btn-xs"  data-toggle="tooltip" title="Inativar"><i class="fa fa-ban text-danger"></i></button>
                                                                    <button class="btn btn-secondary btn-xs"  data-toggle="tooltip" title="Ativar"><i class="fa fa-check text-success"></i></button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tiger Nixon</td>
                                                            <td>System Architect</td>
                                                            <td>Edinburgh</td>
                                                            <td>61</td>
                                                            <td>2011/04/25</td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Visualizar dados"><i class="fa fa-eye"></i></button>
                                                                    <button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Editar dados"><i class="fa fa-edit"></i></button>
                                                                    <button class="btn btn-secondary btn-xs"  data-toggle="tooltip" title="Inativar"><i class="fa fa-ban text-danger"></i></button>
                                                                    <button class="btn btn-secondary btn-xs"  data-toggle="tooltip" title="Ativar"><i class="fa fa-check text-success"></i></button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tiger Nixon</td>
                                                            <td>System Architect</td>
                                                            <td>Edinburgh</td>
                                                            <td>61</td>
                                                            <td>2011/04/25</td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Visualizar dados"><i class="fa fa-eye"></i></button>
                                                                    <button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Editar dados"><i class="fa fa-edit"></i></button>
                                                                    <button class="btn btn-secondary btn-xs"  data-toggle="tooltip" title="Inativar"><i class="fa fa-ban text-danger"></i></button>
                                                                    <button class="btn btn-secondary btn-xs"  data-toggle="tooltip" title="Ativar"><i class="fa fa-check text-success"></i></button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php require_once 'assets/content/footer.php'; ?>
                </div>
            </div>
        </div>
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <script src="assets/plugins/popper/popper.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/sidebarmenu.js"></script>
        <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/toast-master/js/jquery.toast.js"></script>
        <script src="assets/js/custom.js"></script>
        <script>
            $(document).ready(function() {
                //DATATABLE
                $('#example').DataTable();
                //TOASTS
                $("#toast2").click(function() {
                    $.toast({
                        heading: 'Welcome to Monster admin',
                        text: 'Use the predefined ones, or specify a custom position object.',
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'info',
                        hideAfter: 3000,
                        stack: 6
                    });
                });
                $("#toast3").click(function() {
                    $.toast({
                        heading: 'Welcome to Monster admin',
                        text: 'Use the predefined ones, or specify a custom position object.',
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'warning',
                        hideAfter: 3500,
                        stack: 6
                    });
                });
                $("#toast1").click(function() {
                    $.toast({
                        heading: 'Welcome to Monster admin',
                        text: 'Use the predefined ones, or specify a custom position object.',
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
                });
                $("#toast4").click(function() {
                    $.toast({
                        heading: 'Welcome to Monster admin',
                        text: 'Use the predefined ones, or specify a custom position object.',
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                });
            });
        </script>
    </body>
</html>
