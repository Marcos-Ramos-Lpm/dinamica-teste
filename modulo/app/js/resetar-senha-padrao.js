$(document).ready(function () {

    $('#trocar-senha-provisoria').validate({
        ignore: [],
        rules: {
            primeiraSenha: {required: true},
            segundaSenha: {equalTo: '#primeiraSenha'}
        },
        messages: {
            primeiraSenha: {required: 'Informe uma nova senha'},
            segundaSenha: {required: 'Digite novamente a senha'},
            segundaSenha: {equalTo: 'A primeira senha e a segunda não são compatíveis! Digite Novamente'}
        },
        submitHandler: function (form) {
            $(form).ajaxSubmit({
                dataType: 'json',
                beforeSend: function () {
                    Boot.blockUI({
                        target: form,
                        boxed: true,
                        message: 'Modificando senha padrão...'
                    });
                },
                complete: function () {
                    Boot.unblockUI(form);
                },
                success: function (data) {
                    if (data.erro == 0) {
                        location.reload();
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
                        message: 'Erro INESPERADO ao resetar senha padrão!',
                        icon: 'fa fa-times',
                        closeInSeconds: 3
                    });
                }
            });

        }
    });
});