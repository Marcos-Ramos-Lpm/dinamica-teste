$(document).ready(function () {
    $('#loginform').validate({
        ignore: [],
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: 'Informe seu e-mail',
                email: 'Informe um e-mail válido'
            },
            password: {
                required: 'Informe sua senha'
            }
        },
        submitHandler: function (form) {
            $(form).ajaxSubmit({
                dataType: 'json',
                beforeSend: function () {
                    Boot.blockUI({
                        target: form,
                        boxed: true,
                        message: 'Acessando...'
                    });
                },
                complete: function () {
                    Boot.unblockUI(form);
                },
                success: function (data) {
                    switch (data.erro) {
                        case 0:
                            window.location = "home";
                            break;
                        case 1:
                            Boot.alert({
                                container: form,
                                type: 'danger',
                                message: data.mensagem,
                                icon: 'fa fa-times',
                                closeInSeconds: 3
                            });
                            break;
                        case 2:
                            $('#trocar-senha-provisoria').removeClass('d-none');
                            $('#loginform').addClass('d-none');
                            var emaillog = $('input[name="email"]').val();
                            var senhaPadrao = $('input[name="password"]').val();

                            $('input[name="emailLogin"]').val(emaillog);
                            $('input[name="senhaPadrao"]').val(senhaPadrao);
                            break;
                        case 3:
                            Boot.alert({
                                container: form,
                                type: 'danger',
                                message: data.messagem,
                                icon: 'fa fa-times',
                                closeInSeconds: 3
                            });
                            break;
                    }

                },
                error: function () {
                    Boot.alert({
                        container: form,
                        type: 'danger',
                        message: 'Erro INESPERADO ao validar acesso ao sistema!',
                        icon: 'fa fa-times',
                        closeInSeconds: 3
                    });
                }
            });

        }
    });
});

var Login = function () {
    return{
        tipoForm: function () {
            $('#recuperarSenha').removeClass('d-none');
            $('#loginform').addClass('d-none');
        }

    }
}();
