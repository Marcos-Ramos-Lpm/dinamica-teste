$(document).ready(function () {
    Boot.carregaModulos();


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
    $('#add-usuario').validate({
        ignore: [],
        rules: {
            cpf: {
                required: true
            },
            nomeUsuario: {
                required: true
            },
            emailUsuario: {
                required: true,
                email: true
            },
            imagem: {
                required: true
            },
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
            imagem: {
                required: 'Insira uma imagem!'
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
                message: 'Confirma o registro desse usuário?',
                callback: function (result) {
                    if (result) {
                        $(form).ajaxSubmit({
                            dataType: 'json',
                            beforeSend: function () {
                                Boot.blockUI({
                                    target: form,
                                    boxed: true,
                                    message: 'Adicionando usuario...'
                                });
                            },
                            complete: function () {
                                Boot.unblockUI(form);
                            },
                            success: function (data) {
                                if (data.erro == 0) {
                                    Boot.alert({
                                        container: form,
                                        type: 'success',
                                        message: 'Usuário adicionada com sucesso!',
                                        icon: 'fa fa-check',
                                        closeInSeconds: 2,
                                        callback: function () {
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
                                                message: 'Deseja adicionar novo usuário?',
                                                callback: function (result) {
                                                    if (result) {
                                                        form.reset();
                                                    } else {
                                                        history.back();
                                                    }
                                                }
                                            });
                                        }
                                    });
                                } else {
                                    Boot.alert({
                                        container: form,
                                        type: 'danger',
                                        message: data.mensagem,
                                        icon: 'fa fa-times',
                                        closeInSeconds: 3
                                    });
                                }
                            },
                            error: function () {
                                Boot.alert({
                                    container: form,
                                    type: 'danger',
                                    message: 'Ocorreu um erro inesperado ao adicionar usuário.',
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