$(document).ready(function () {

    //DATATABLES
    $('#tabela-usuario').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": Boot.baseURLdefault() + "modulo/usuario/table/table-usuarios.php",
            "type": 'POST'
        },
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "Nenhum registro encontrado!",
            "info": "Mostrando a página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "loadingRecords": "Carregando registros...",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Pesquisar por:",
            "processing": "Processando",
            "paginate": {
                "first": "Primeiro",
                "last": "Último",
                "next": "Próximo",
                "previous": "Anterior"
            }
        },
        "columnDefs": [

            {
                "targets": 5,
                "orderable": false
            }

        ]
    });
});

var Usuarios = function () {
    return {
        editarUsuario: function (codigo) {
            //CARREGA OS DADOS DO CINEMA
            $.ajax({
                dataType: 'json',
                url: Boot.baseURLdefault() + 'modulo/usuario/get/carrega-cadastro-usuario.php',
                data: {
                    codigo: codigo
                },
                type: 'POST',
                beforeSend: function () {
                    Boot.blockUI({
                        boxed: true,
                        message: 'Carregando dados...'
                    });
                },
                complete: function () {
                    Boot.unblockUI();
                },
                success: function (data) {
                    if (data.erro == 0) {
                        var modal = bootbox.dialog({
                            title: 'EDITAR USUÁRIO ',
                            message: '<form method="post" enctype="multipart/form-data" id="editar-usuario" action="' + Boot.baseURLdefault() + 'modulo/usuario/add/editar-usuario.php"> <input type="hidden" name="codigo" /> <input type="hidden" name="imagemAtual" /><div class="row"><div class="col-sm-4 col-lg-4 col-xs-12"><div class="form-group"> <label for="cpf">CPF<span class="text-danger">*</span></label> <input type="tel" onchange="Boot.validarCpfUsuario(this.value)" name="cpf" id="cpf" class="form-control" /></div></div><div class="col-sm-8 col-lg-8 col-xs-12"><div class="form-group"> <label for="nomeUsuario">Nome completo<span class="text-danger">*</span></label> <input type="text" name="nomeUsuario" id="nomeUsuario" class="form-control" required="true" /></div></div></div><div class="row"><div class="col-sm-12 col-lg-12 col-xs-12"><div class="form-group"> <label for="emailUsuario">E-mail<span class="text-danger">*</span></label> <input type="email" name="emailUsuario" id="emailUsuario" class="form-control" required="true" /></div></div></div><div class="row"><div class="col-sm-12 col-lg-12 col-xs-12"><div class="form-group"> <label for="imagem">Imagem<span class="text-danger">*</span></label> <input type="file" name="imagem" id="imagem" class="form-control" /> <span class="help-block text-info"><i class="fa fa-info-circle"></i> Selecione imagens nas dimensões 220x220</span></div><div class="d-none"> <label>X1 <input type="text" size="4" id="x" name="x" /> </label> <label>Y1 <input type="text" size="4" id="y" name="y" /> </label> <label>Y2 <input type="text" size="4" id="y2" name="y2" /> </label> <label>W <input type="text" size="4" id="w" name="w" /> </label> <label>H <input type="text" size="4" id="h" name="h" /> </label> <input id="rx" name="rx" type="hidden" value="" /> <input id="ry" name="ry" type="hidden" value="" /> <input id="rw" name="rw" type="hidden" value="" /> <input id="rh" name="rh" type="hidden" value="" /></div></div></div><div class="row"><div class="col-sm-6"><div class="estrutura-preview-imagem hidden"><img src="" class="w-100" id="previsualizacao" /></div></div></div><div class="row"><div class="col-sm-12 col-lg-12 col-xs-12"><div class="form-group" id="listar-modulos"></div></div></div><hr /><div class="row"><div class="col-sm-12 text-center"><div class="btn-group right"> <button type="reset" class="btn btn-sm btn-secondary">Limpar <i class="fa fa-eraser"></i></button> <button type="button" onclick="bootbox.hideAll()" class="btn btn-sm btn-secondary">Cancelar <i class="fa fa-times"></i></button> <button type="submit" class="btn btn-sm btn-secondary">Salvar <i class="fa fa-send-o"></i></button></div></div></div></form>',
                            size: 'extra-large'
                        });
                        modal.init(function () {
                            //                            CARREGAR MODULOS VINCULADOS AO USUARIOS
                            Boot.carregaModulos(function () {
                                var qtdmodulo = (data.info.modulos).length;
                                for (var m = 0; m < qtdmodulo; m++) {

                                    $('input[name="modulos[]"][value="' + data.info.modulos[m].id_modulo + '"]').attr('checked', true);

                                }
                            });
                            //ALIMENTAR OS CAMPOS
                            $('input[name="codigo"]').val(codigo);
                            $('input[name="cpf"]').val(data.info.cpf_usuario);
                            $('input[name="nomeUsuario"]').val(data.info.nome_completo_usuario);
                            $('input[name="emailUsuario"]').val(data.info.email_usuario);
                            $('#previsualizacao').attr('src', Boot.baseURLdefault() + 'modulo/usuario/img/' + data.info.imagem);
                            $('input[name="imagemAtual"]').val(data.info.imagem);
                            $('input[name="cpf"]').setMask('999.999.999-99');

                            //JCROP
                            $('input[name="imagem"]').on('change', function () {
                                if ($('#previsualizacao').data('Jcrop')) {
                                    $('#previsualizacao').data('Jcrop').destroy();
                                    $('#previsualizacao').removeAttr('style');
                                }

                                var width2 = jQuery('#cropbox').prop('naturalWidth');
                                var height2 = jQuery('#cropbox').prop('naturalHeight');
                                Boot.readURL(this);

                                $('#previsualizacao').Jcrop({
                                    onSelect: Boot.updateCoords,
                                    onSelect: Boot.updateCoords,
                                    bgColor: 'black',
                                    bgOpacity: .4,
                                    setSelect: [0, 0, 220, 220],
                                    allowResize: true,
                                    maxSize: [220, 220],
                                    minSize: [width2, height2],
                                    onRelease: Boot.readURL(this)
                                });
                            });
                            //VALIDAÇÃO
                            $('#editar-usuario').validate({
                                ignore: [],
                                rules: {
                                    cpf: {
                                        required: true
                                    },
                                    nomeUsuario: {
                                        required: true
                                    },
                                    emailUsuario: {
                                        required: true
                                    },
                                    'modulos[]': {
                                        required: true
                                    }

                                },
                                messages: {
                                    cpf: {
                                        required: 'Informe um CPF!'
                                    },
                                    nomeUsuario: {
                                        required: 'Informe o nome completo!'
                                    },
                                    emailUsuario: {
                                        required: 'Informe um email!'
                                    },
                                    'modulos[]': {
                                        required: 'Informe um modulo!'
                                    }
                                },
                                submitHandler: function (form) {
                                    bootbox.confirm({
                                        buttons: {
                                            confirm: {
                                                label: 'Sim <i class="fa fa-check text-success"></i>',
                                                className: 'btn btn-sm btn-secondary'
                                            },
                                            cancel: {
                                                label: 'Não <i class="fa fa-times text-danger"></i>',
                                                className: 'btn btn-sm btn-secondary'
                                            }
                                        },
                                        message: 'Confirma a edição do cadastro?',
                                        callback: function (result) {
                                            if (result) {
                                                $(form).ajaxSubmit({
                                                    dataType: 'json',
                                                    beforeSend: function () {
                                                        Boot.blockUI({
                                                            target: form,
                                                            boxed: true,
                                                            message: 'Alterando dados...'
                                                        });
                                                    },
                                                    complete: function () {
                                                        Boot.unblockUI(form);
                                                    },
                                                    success: function (data) {
                                                        if (data.erro == 0) {
                                                            bootbox.hideAll();
                                                            $('#tabela-usuario').DataTable().ajax.reload();
                                                            $.toast({
                                                                heading: 'sucesso',
                                                                text: 'Usuário editado com sucesso!',
                                                                position: 'top-right',
                                                                loaderBg: '#28a745',
                                                                icon: 'success',
                                                                hideAfter: 2500
                                                            });
                                                        } else {
                                                            $('#tabela-usuario').DataTable().ajax.reload();
                                                            $.toast({
                                                                heading: 'sucesso',
                                                                text: data.mensagem,
                                                                position: 'top-right',
                                                                loaderBg: '#28a745',
                                                                icon: 'success',
                                                                hideAfter: 2500
                                                            });
                                                        }
                                                    },
                                                    error: function () {
                                                        Boot.alert({
                                                            container: form,
                                                            type: 'danger',
                                                            message: 'Ocorreu um erro inesperado ao editar os dados.',
                                                            icon: 'fa fa-times',
                                                            closeInSeconds: 3
                                                        });
                                                    }
                                                });
                                            }
                                        }
                                    });
                                }
                            });
                        });
                    } else {
                        Boot.alert({
                            type: 'danger',
                            icon: 'fa fa-times',
                            message: data.mensagem,
                            closeInSeconds: 3
                        });
                    }
                },
                error: function () {
                    Boot.alert({
                        type: 'danger',
                        icon: 'fa fa-times',
                        message: 'Ocorreu um erro inesperado ao carregar dados do usuário',
                        closeInSeconds: 3
                    });
                }
            });
        },
        visualizarUsuario: function (codigo) {
            //CARREGA OS DADOS DO CINEMA
            $.ajax({
                dataType: 'json',
                url: Boot.baseURLdefault() + 'modulo/usuario/get/carrega-cadastro-usuario-visualizar.php',
                data: {
                    codigo: codigo
                },
                type: 'POST',
                beforeSend: function () {
                    Boot.blockUI({
                        boxed: true,
                        message: 'Carregando dados...'
                    });
                },
                complete: function () {
                    Boot.unblockUI();
                },
                success: function (data) {
                    if (data.erro == 0) {
                        var modal = bootbox.dialog({
                            title: 'VISUALIZAR USUÁRIO',
                            message: '<form method="post" enctype="multipart/form-data" id="editar-usuario"> <input type="hidden" name="codigo" /><div class="row"><div class="col-sm-4 col-lg-4 col-xs-12"><div class="form-group"> <label for="cpf">CPF<span class="text-danger">*</span></label> <input type="tel" disabled="true" name="cpf" id="cpf" class="form-control" /></div></div><div class="col-sm-8 col-lg-8 col-xs-12"><div class="form-group"> <label for="nomeUsuario">Nome completo<span class="text-danger">*</span></label> <input type="text" name="nomeUsuario" disabled="true" id="nomeUsuario" class="form-control" required="true" /></div></div></div><div class="row"><div class="col-sm-12 col-lg-12 col-xs-12"><div class="form-group"> <label for="emailUsuario">E-mail<span class="text-danger">*</span></label> <input type="email" name="emailUsuario" disabled="true" id="emailUsuario" class="form-control" required="true" /></div></div></div><div class="row"><div class="col-sm-12 col-lg-12 col-xs-12"><div class="row mb-5"><div class="col-sm-6 estrutura-preview-imagem hidden"><img src="" class="w-50" id="previsualizacao" /></div></div></div></div><div class="row"><div class="col-sm-12 col-lg-12 col-xs-12"><div class="form-group" id="listar-modulos"></div></div></div></form>',
                            size: 'large'
                        });
                        modal.init(function () {
                            //ALIMENTAR OS CAMPOS
                            //ALIMENTAR OS CAMPOS
                            $('input[name="codigo"]').val(codigo);
                            $('input[name="cpf"]').val(data.info.cpf_usuario);
                            $('input[name="nomeUsuario"]').val(data.info.nome_completo_usuario);
                            $('input[name="emailUsuario"]').val(data.info.email_usuario);
                            $('#previsualizacao').attr('src', Boot.baseURLdefault() + 'modulo/usuario/img/' + data.info.imagem);
                            $('input[name="cpf"]').setMask('999.999.999-99');

                            //                            CARREGAR MODULOS VINCULADOS AO USUARIOS

                            var qtd = (data.info.modulos).length;
                            var html = [];
                            for (var i = 0; i < qtd; i++) {
                                html.push('<input type="checkbox" name="modulos[]" disabled="true" id="modulo' + i + '" value="' + data.info.modulos[i].id_modulo + '" checked="true" />');
                                html.push('<label for="modulo' + i + '">' + data.info.modulos[i].modulo + '</label>');
                                html.push('<div id="lista-sub-modulos' + data.info.modulos[i].id_modulo + '">');
                                html.push('</div>');
                            }
                            $('#listar-modulos').html(html.join(''));


                        });
                    } else {
                        Boot.alert({
                            type: 'danger',
                            icon: 'fa fa-times',
                            message: data.mensagem,
                            closeInSeconds: 3
                        });
                    }
                },
                error: function () {
                    Boot.alert({
                        type: 'danger',
                        icon: 'fa fa-times',
                        message: 'Ocorreu um erro inesperado ao carregar dados do usuário',
                        closeInSeconds: 3
                    });
                }
            });
        },
        gerenciarSituacaoUsuario: function (codigo, tipoAcao) {

            //            CASO O CADASTRO ESTIVER INATIVO , ATIVE
            if (tipoAcao == 1) {
                bootbox.confirm({
                    buttons: {
                        confirm: {
                            label: 'Sim <i class="fa fa-check text-success"></i>',
                            className: 'btn btn-sm btn-secondary'
                        },
                        cancel: {
                            label: 'Não <i class="fa fa-times text-danger"></i>',
                            className: 'btn btn-sm btn-secondary'
                        }
                    },
                    message: 'DESEJA ATIVAR ESSE CADASTRO?',
                    callback: function (result) {
                        if (result) {
                            $.ajax({
                                dataType: 'json',
                                url: Boot.baseURLdefault() + 'modulo/usuario/add/gerenciar-situacao-usuario.php',
                                data: {
                                    codigo: codigo,
                                    tipoAcao: tipoAcao
                                },
                                type: 'POST',
                                beforeSend: function () {
                                    Boot.blockUI({
                                        boxed: true,
                                        message: 'Ativando Usuário...'
                                    });
                                },
                                complete: function () {
                                    Boot.unblockUI();
                                },
                                success: function (data) {
                                    if (data.erro == 0) {
                                        $.toast({
                                            heading: 'sucesso',
                                            text: 'Usuário ativado com sucesso!',
                                            position: 'top-right',
                                            loaderBg: '#28a745',
                                            icon: 'success',
                                            hideAfter: 2500
                                        });
                                        $('#tabela-usuario').DataTable().ajax.reload();
                                    } else {
                                        Boot.alert({
                                            type: 'danger',
                                            icon: 'fa fa-times',
                                            message: data.mensagem,
                                            closeInSeconds: 3
                                        });
                                    }
                                },
                                error: function () {
                                    Boot.alert({
                                        type: 'danger',
                                        icon: 'fa fa-times',
                                        message: 'Ocorreu um erro INESPERADO ao Ativar cadastro do usuario!',
                                        closeInSeconds: 3
                                    });
                                }
                            });
                        }

                    }
                });
            } else {
                //                CASO O CADASTRO ESTIVE ATIVO, DESATIVAR
                bootbox.confirm({
                    buttons: {
                        confirm: {
                            label: 'Sim <i class="fa fa-check text-success"></i>',
                            className: 'btn btn-sm btn-secondary'
                        },
                        cancel: {
                            label: 'Não <i class="fa fa-times text-danger"></i>',
                            className: 'btn btn-sm btn-secondary'
                        }
                    },
                    message: 'DESEJA DESATIVAR ESSE CADASTRO?',
                    callback: function (result) {
                        if (result) {
                            $.ajax({
                                dataType: 'json',
                                url: Boot.baseURLdefault() + 'modulo/usuario/add/gerenciar-situacao-usuario.php',
                                data: {
                                    codigo: codigo,
                                    tipoAcao: tipoAcao
                                },
                                type: 'POST',
                                beforeSend: function () {
                                    Boot.blockUI({
                                        boxed: true,
                                        message: 'Desativando Usuário...'
                                    });
                                },
                                complete: function () {
                                    Boot.unblockUI();
                                },
                                success: function (data) {
                                    if (data.erro == 0) {
                                        $.toast({
                                            heading: 'sucesso',
                                            text: 'Usuário desativado com sucesso!',
                                            position: 'top-right',
                                            loaderBg: '#28a745',
                                            icon: 'success',
                                            hideAfter: 2500
                                        });
                                        $('#tabela-usuario').DataTable().ajax.reload();
                                    } else {
                                        Boot.alert({
                                            type: 'danger',
                                            icon: 'fa fa-times',
                                            message: data.mensagem,
                                            closeInSeconds: 3
                                        });
                                    }
                                },
                                error: function () {
                                    Boot.alert({
                                        type: 'danger',
                                        icon: 'fa fa-times',
                                        message: 'Ocorreu um erro INESPERADO ao desativar cadastro do usuario!',
                                        closeInSeconds: 3
                                    });
                                }
                            });
                        }

                    }
                });
            }
        },
        gerenciarAcessoUsuario: function (codigo, tipoAcao) {
            bootbox.confirm({
                buttons: {
                    confirm: {
                        label: 'Sim <i class="fa fa-check text-success"></i>',
                        className: 'btn btn-sm btn-secondary'
                    },
                    cancel: {
                        label: 'Não <i class="fa fa-times text-danger"></i>',
                        className: 'btn btn-sm btn-secondary'
                    }
                },
                message: 'DESEJA GERENCIAR O ACESSO DO USUÁRIO?',
                callback: function (result) {
                    if (result) {
                        $.ajax({
                            dataType: 'json',
                            url: Boot.baseURLdefault() + 'modulo/usuario/add/gerenciar-acesso-usuario.php',
                            data: {
                                codigo: codigo,
                                tipoAcao: tipoAcao
                            },
                            type: 'POST',
                            beforeSend: function () {
                                Boot.blockUI({
                                    boxed: true,
                                    message: 'gerenciando acesso do usuário...'
                                });
                            },
                            complete: function () {
                                Boot.unblockUI();
                            },
                            success: function (data) {
                                if (data.erro == 0) {
                                    $.toast({
                                        heading: 'sucesso',
                                        text: 'Acesso do usuario gerenciado com sucesso!',
                                        position: 'top-right',
                                        loaderBg: '#28a745',
                                        icon: 'success',
                                        hideAfter: 2500
                                    });
                                    $('#tabela-usuario').DataTable().ajax.reload();
                                } else {
                                    Boot.alert({
                                        type: 'danger',
                                        icon: 'fa fa-times',
                                        message: data.mensagem,
                                        closeInSeconds: 3
                                    });
                                }
                            },
                            error: function () {
                                Boot.alert({
                                    type: 'danger',
                                    icon: 'fa fa-times',
                                    message: 'Ocorreu um erro INESPERADO ao gerenciar acesso do usuario!',
                                    closeInSeconds: 3
                                });
                            }
                        });
                    }

                }
            });
        },
    }
}();