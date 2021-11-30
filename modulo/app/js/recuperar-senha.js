$(document).ready(function () {

    $('#recuperarSenha').validate({
        ignore: [],
        rules: {
            email: {required: true}
        },
        messages: {
            email: {required: 'Informe um email!'}
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
                message: 'Confirma o reset da sua senha?',
                callback: function (result) {
                    if (result) {
                        $(form).ajaxSubmit({
                            dataType: 'json',
                            beforeSend: function () {
                                Boot.blockUI({
                                    target: form,
                                    boxed: true,
                                    message: 'Resetando a senha, aguarde...'
                                });
                            },
                            complete: function () {
                                Boot.unblockUI(form);
                            },
                            success: function (data) {
                                if (data.erro == 0) {
                                    $.toast({
                                        heading: 'sucesso',
                                        text: 'Usuário editado com sucesso!',
                                        position: 'top-right',
                                        loaderBg: '#28a745',
                                        icon: 'success',
                                        hideAfter: 2500
                                    });
                                    location.reload();
                                } else {
                                    $.toast({
                                        heading: 'Atenção',
                                        text: data.mensagem,
                                        position: 'top-right',
                                        loaderBg: '#28a745',
                                        icon: 'warning',
                                        hideAfter: 2500
                                    });
                                }
                            },
                            error: function () {
                                Boot.alert({
                                    container: form,
                                    type: 'danger',
                                    message: 'Ocorreu um erro inesperado ao resetar senha.',
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
