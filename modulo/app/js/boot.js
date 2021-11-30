var Boot = function () {


    return {
        baseURLdefault: function () {
            var baseURLdefault = $('input[name="baseURLdefault"]').val();
            return baseURLdefault;
        },
        alert: function (options) {
            options = $.extend(true, {
                container: "", // alerts parent container(by default placed after the page breadcrumbs)
                place: "append", // "append" or "prepend" in container
                type: 'success', // alert's type
                message: "", // alert's message
                close: true, // make alert closable
                reset: true, // close all previouse alerts first
                focus: true, // auto scroll to the alert after shown
                icon: "", // put icon before the message
                callback: ''
            }, options);
            var id = Boot.getUniqueID("bootalert");
            var html = '<div id="' + id + '" class="alert alert-' + options.type + ' mt-2">' + (options.close ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' : '') + (options.icon !== "" ? '<i class="' + options.icon + '"></i>  ' : '') + options.message + '</div>';
            if (options.reset) {
                $('.app-alerts').remove();
            }

            if (!options.container) {
                $('.page-wrapper').after(html);
            } else {
                if (options.place == "append") {
                    $(options.container).append(html);
                } else {
                    $(options.container).prepend(html);
                }
            }

            if (options.focus) {
                Boot.scrollTo('#' + id);
            }

            if (options.closeInSeconds > 0) {
                setTimeout(function () {
                    if (options.callback) {
                        options.callback();
                    }
                    $('div#' + id).remove();
                }, options.closeInSeconds * 1000);
            } else {
                setTimeout(function () {
                    if (options.callback) {
                        options.callback();
                    }
                }, 3000);
            }

            return id;
        },
        scrollTo: function (el) {
            $('html,body').animate({
                scrollTop: ($(el).offset().top) - 150
            }, 'slow');
        },
        getUniqueID: function (prefix) {
            return 'prefix_' + Math.floor(Math.random() * (new Date()).getTime());
        },
        blockUI: function (options) {
            options = $.extend(true, {}, options);
            var html = '';
            var colorIcon = (options.colorIcon) ? options.colorIcon : '#696a6b';
            if (options.animate) {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '">' + '<div class="block-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>' + '</div>';
            } else if (options.iconOnly) {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img src="assets/img/loading-spinner-grey.gif" align=""></div>';
            } else if (options.textOnly) {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
            } else {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><i class="fa fa-spinner fa-spin fa-2x" style="color: ' + colorIcon + '"></i><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + ' </span></div>';
            }


            if (options.target) { // element blocking
                var el = $(options.target);
                if (el.height() <= ($(window).height())) {
                    options.cenrerY = true;
                }
                el.block({
                    message: html,
                    baseZ: options.zIndex ? options.zIndex : 1000,
                    centerY: options.cenrerY !== undefined ? options.cenrerY : false,
                    css: {
                        top: '10%',
                        border: '0',
                        padding: '0',
                        backgroundColor: 'none'
                    },
                    overlayCSS: {
                        backgroundColor: options.overlayColor ? options.overlayColor : '#555',
                        opacity: options.boxed ? 0.05 : 0.1,
                        cursor: 'wait'
                    }
                });
            } else { // page blocking
                $.blockUI({
                    message: html,
                    baseZ: options.zIndex ? options.zIndex : 1000,
                    css: {
                        border: '0',
                        padding: '0',
                        backgroundColor: 'none'
                    },
                    overlayCSS: {
                        backgroundColor: options.overlayColor ? options.overlayColor : '#555',
                        opacity: options.boxed ? 0.05 : 0.1,
                        cursor: 'wait'
                    }
                });
            }
        },
        unblockUI: function (target) {
            if (target) {
                $(target).unblock({
                    onUnblock: function () {
                        $(target).css('position', '');
                        $(target).css('zoom', '');
                    }
                });
            } else {
                $.unblockUI();
            }
        },
        number_format: function (number, decimals, dec_point, thousands_sep) {
            var n = number,
                c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
            var d = dec_point == undefined ? "," : dec_point;
            var t = thousands_sep == undefined ? "." : thousands_sep,
                s = n < 0 ? "-" : "";
            var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;
            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        },
        dataHoje: function () {
            var data = new Date();
            var dataHoje = data.getFullYear() + '-' + data.getMonth() + '-' + data.getDate();
            return dataHoje;
        },
        ajustaValor: function (valor) {
            var v = valor.replace('.', ''); //remove os pontos de milhares
            v = v.replace(',', '.');
            v = v.replace('R$', '');
            v = v.replace(' ', '');
            return v;
        },
        updateCoords: function (c) {
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
            Boot.responsiveCoords(c, '#previsualizacao');
        },
        responsiveCoords: function (c, imgSelector) {

            var imgOrignalWidth = $(imgSelector).prop('naturalWidth');
            var imgOriginalHeight = $(imgSelector).prop('naturalHeight');
            var imgResponsiveWidth = parseInt($(imgSelector).css('width'));
            var imgResponsiveHeight = parseInt($(imgSelector).css('height'));
            var responsiveX = Math.ceil((c.x / imgResponsiveWidth) * imgOrignalWidth);
            var responsiveY = Math.ceil((c.y / imgResponsiveHeight) * imgOriginalHeight);
            var responsiveW = Math.ceil((c.w / imgResponsiveWidth) * imgOrignalWidth);
            var responsiveH = Math.ceil((c.h / imgResponsiveHeight) * imgOriginalHeight);
            $('#rx').val(responsiveX);
            $('#ry').val(responsiveY);
            $('#rw').val(responsiveW);
            $('#rh').val(responsiveH);
        },
        readURL: function (input) {
            $('#previsualizacao').removeAttr('src').parent('div').addClass('d-nonne');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#previsualizacao').attr('src', e.target.result).parent('div').removeClass('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
        extraiCodigoVideo: function (urlvideo) {

            var codvideo = Boot.isYoutubeVideo(urlvideo);

            if (!codvideo) {
                Boot.alert({
                    container: '#add-video',
                    type: 'danger',
                    icon: 'fa fa-times',
                    message: 'nao possui link',
                    closeInSeconds: 3

                });

            } else {
                $('input[name="codigoVideo"]').val(codvideo);
                $('#previsualizacao-youTube').attr('src', 'https://img.youtube.com/vi/' + codvideo + '/0.jpg');
                $('.estrutura-preview-imagem').removeClass('d-none');

            }
        },
        flgImagemYoutube: function (flg) {

            if (flg == 1) {
                $('#img-youtube').removeClass('d-none');
                $('#img-interna').addClass('d-none');
                $('#img-inserida').addClass('d-none');

            } else {
                $('#img-youtube').addClass('d-none');
                $('#img-interna').removeClass('d-none');
                $('#img-inserida').removeClass('d-none');
            }
        },
        isYoutubeVideo: function (url) {
            var v = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
            return (url.match(v)) ? RegExp.$1 : false;
        },
        updateCoords2: function (c) {
            $('#xYt').val(c.x);
            $('#yYt').val(c.y);
            $('#wYt').val(c.w);
            $('#hYt').val(c.h);
            Boot.responsiveCoords(c, '#previsualizacaoYt');
        },
        responsiveCoords2: function (c, imgSelector) {

            var imgOrignalWidth = $(imgSelector).prop('naturalWidth');
            var imgOriginalHeight = $(imgSelector).prop('naturalHeight');
            var imgResponsiveWidth = parseInt($(imgSelector).css('width'));
            var imgResponsiveHeight = parseInt($(imgSelector).css('height'));
            var responsiveX = Math.ceil((c.x / imgResponsiveWidth) * imgOrignalWidth);
            var responsiveY = Math.ceil((c.y / imgResponsiveHeight) * imgOriginalHeight);
            var responsiveW = Math.ceil((c.w / imgResponsiveWidth) * imgOrignalWidth);
            var responsiveH = Math.ceil((c.h / imgResponsiveHeight) * imgOriginalHeight);
            $('#rxYt').val(responsiveX);
            $('#ryYt').val(responsiveY);
            $('#rwYt').val(responsiveW);
            $('#rhYt').val(responsiveH);
        },
        readURL2: function (input) {
            $('#previsualizacaoYt').removeAttr('src').parent('div').addClass('d-nonne');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#previsualizacaoYt').attr('src', e.target.result).parent('div').removeClass('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
        readURLB: function (input) {
            $('#previsualizacaoFachada').removeAttr('src').parent('div').addClass('d-nonne');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#previsualizacaoFachada').attr('src', e.target.result).parent('div').removeClass('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
        updateCoordsB: function (c) {
            $('#xb').val(c.x);
            $('#yb').val(c.y);
            $('#wb').val(c.w);
            $('#hb').val(c.h);
            Boot.responsiveCoordsB(c, '#previsualizacaoFachada');
        },
        responsiveCoordsB: function (c, imgSelector) {

            var imgOrignalWidth = $(imgSelector).prop('naturalWidth');
            var imgOriginalHeight = $(imgSelector).prop('naturalHeight');
            var imgResponsiveWidth = parseInt($(imgSelector).css('width'));
            var imgResponsiveHeight = parseInt($(imgSelector).css('height'));
            var responsiveX = Math.ceil((c.x / imgResponsiveWidth) * imgOrignalWidth);
            var responsiveY = Math.ceil((c.y / imgResponsiveHeight) * imgOriginalHeight);
            var responsiveW = Math.ceil((c.w / imgResponsiveWidth) * imgOrignalWidth);
            var responsiveH = Math.ceil((c.h / imgResponsiveHeight) * imgOriginalHeight);
            $('#rxb').val(responsiveX);
            $('#ryb').val(responsiveY);
            $('#rwb').val(responsiveW);
            $('#rhb').val(responsiveH);
        },
        validarCpfUsuario: function (cpf) {
            $.ajax({
                dataType: 'json',
                url: Boot.baseURLdefault() + 'modulo/usuario/get/validar-cpf-usuario.php',
                type: 'POST',
                data: {
                    cpf: cpf
                },
                beforeSend: function () {

                    Boot.blockUI({
                        boxed: true,
                        message: 'Carrega postagem...'
                    });
                },
                complete: function () {
                    Boot.unblockUI();
                },
                success: function (data) {
                    if (data.erro == 0) {


                    } else {
                        $.toast({
                            heading: 'Atenção',
                            text: data.mensagem,
                            position: 'top-right',
                            loaderBg: '#28a745',
                            icon: 'error',
                            hideAfter: 2500
                        });
                        $('input[name="cpf"]').val('').focus();
                    }
                },
                error: function () {
                    Boot.alert({
                        type: 'danger',
                        icon: 'fa fa-times',
                        message: 'Ocorreu um erro inesperado ao validar CPF do usuário!',
                        closeInSeconds: 3
                    });
                }
            });
        },
        carregaModulos: function (callback) {
            $.ajax({
                dataType: 'json',
                url: Boot.baseURLdefault() + 'modulo/usuario/get/carrega-modulos.php',
                type: 'POST',
                beforeSend: function () {
                    Boot.blockUI({
                        target: '#listar-modulos',
                        boxed: true,
                        message: 'Carregando Modulos...'
                    });
                },
                complete: function () {
                    Boot.unblockUI('#listar-modulos');
                },
                success: function (data) {
                    if (data.erro == 0) {
                        var qtd = (data.info).length;
                        var html = [];
                        for (var i = 0; i < qtd; i++) {
                            html.push('<div class="form-cotrol"><input type="checkbox" name="modulos[]" id="modulo' + i + '" value="' + data.info[i].id_modulo + '" />');
                            html.push('<label for="modulo' + i + '">' + data.info[i].modulo + '</label></div>');
                        }
                        $('#listar-modulos').html(html.join(''));
                        if (callback) {
                            callback();
                        }

                    } else {
                        Boot.alert({
                            type: 'danger',
                            icon: 'fa fa-times',
                            message: data.mensagem,
                            closeInSeconds: 2,
                            callback: function () {

                            }
                        });
                    }
                },
                error: function () {
                    Boot.alert({
                        type: 'danger',
                        icon: 'fa fa-times',
                        message: '',
                        closeInSeconds: 2,
                        callback: function () {

                        }
                    });
                }
            });
        },
        getEnderecoCEP: function (cep) {
            $.ajax({
                dataType: 'json',
                url: Boot.baseURLdefault() + 'modulo/app/get/busca-cep.php',
                data: {
                    cep: cep
                },
                type: 'POST',
                beforeSend: function (xhr) {
                    Boot.blockUI({
                        boxed: true,
                        message: 'Buscando endereço...'
                    });
                },
                complete: function (jqXHR, textStatus) {
                    Boot.unblockUI();
                },
                success: function (data, textStatus, jqXHR) {
                    if ((data.erro == 0)) {

                        $('input[name="logradouro"]').val(data.info.logradouro);
                        $('input[name="bairro"]').val(data.info.bairro);

                        Boot.carregaEstadoAtivos(function () {
                            $('select[name="estado"] option[value="' + data.info.id_estado + '"]').attr('selected', true);
                        });

                        $('select[name="municipio"]').append('<option value="' + data.info.id_municipio + '">' + data.info.cidade + '/' + data.info.uf + '</option>');
                        $('input[name="numero"]').focus();
                    } else if (data.erro == 1) {
                        $.toast({
                            heading: 'Atenção',
                            text: 'CEP invalido! verifique e digite novamente!',
                            position: 'top-right',
                            loaderBg: '#fb3a3a',
                            icon: 'warning',
                            hideAfter: 2500
                        });
                        $('input[name="cep"]').val('').focus();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $.toast({
                        heading: 'Atenção',
                        text: 'CEP não encontrado! verifique e digite novamente!',
                        position: 'top-right',
                        loaderBg: '#fb3a3a',
                        icon: 'warning',
                        hideAfter: 2500
                    });
                    //                    $('input[name="cep"]').val('').focus();
                }
            });
        },
        carregaMunicipiosAtivos: function (estado, callback) {
            $.ajax({
                dataType: 'json',
                url: Boot.baseURLdefault() + 'modulo/app/get/carrega-municipios.php',
                type: 'POST',
                data: {
                    estado: estado
                },
                beforeSend: function () {

                    Boot.blockUI({
                        boxed: true,
                        message: 'Carrega Municipios...'
                    });
                },
                complete: function () {
                    Boot.unblockUI();
                },
                success: function (data) {
                    if (data.erro == 0) {

                        var qtd = data.info.length;
                        if (qtd > 0) {
                            var html = [];
                            $('select[name="municipio"]').removeAttr('disabled', true);
                            html.push('<option value="" selected="true" disabled="true">Selecione um Municipio ...</option>');
                            for (var i = 0; i < qtd; i++) {
                                html.push('<option value="' + data.info[i].id_municipio + '">' + data.info[i].cidade + ' - ' + data.info[i].uf + '</option>');
                            }
                            $('select[name="municipio"]').html(html.join(''));

                            if (callback) {
                                callback();
                            }

                        }

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
                        message: 'Ocorreu um erro inesperado ao carregar municipios!',
                        closeInSeconds: 3
                    });
                }
            });
        },
        carregaEstadoAtivos: function (callback) {
            $.ajax({
                dataType: 'json',
                url: Boot.baseURLdefault() + 'modulo/app/get/carrega-estados.php',
                type: 'POST',
                beforeSend: function () {

                    Boot.blockUI({
                        boxed: true,
                        message: 'Carrega Estado...'
                    });
                },
                complete: function () {
                    Boot.unblockUI();
                },
                success: function (data) {
                    if (data.erro == 0) {

                        var qtd = data.info.length;
                        if (qtd > 0) {
                            var html = [];

                            html.push('<option value="" selected="true" disabled="true">Selecione um Estado ...</option>');
                            for (var i = 0; i < qtd; i++) {
                                html.push('<option value="' + data.info[i].id_estado + '">' + data.info[i].estado + '</option>');
                            }
                            $('select[name="estado"]').html(html.join(''));

                            if (callback) {
                                callback();
                            }

                        }

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
                        message: 'Ocorreu um erro inesperado ao carregar municipios!',
                        closeInSeconds: 3
                    });
                }
            });
        },

        limitarCaracteres: function () {
            $('.char-count').keyup(function () {
                var maxLength = parseInt($(this).attr('maxlength'));
                var length = $(this).val().length;
                var newLength = maxLength - length;
                var name = $(this).attr('name');
                $('span[name="' + name + '"]').text(newLength);
            });
        },
        addPergunta: function () {
            var contador = $('input[name="contadorPerguntas"]').val();
            var count = (contador > 0) ? parseInt(contador) + 1 : 1;
            $('input[name="contadorPerguntas"]').val(count);
            var loop = [];
            loop = count;
            $('#add-pergunta').append('<input type="hidden" id="questao' + loop + '" name="questoes[]" value="' + loop + '" />');
            $('#lista-questao').append('<div class="card text-info bg-light mb-5 mt-5" id="pergunta' + count + '" data-item="' + count + '" style="box-shadow: 2px 0px 4px 2px var(--gray);"><div class="card-header">Pergunta <a  onclick="Boot.deletePergunta(' + count + ')"><i class="fa fa-times-circle pull-right text-danger" data-toggle="tooltip" title="Excluir esta pergunta"></i></a></div><div class="card-body"><div class="row"><div class="col-sm-1 col-lg-1 col-xs-1"><div class="form-group"> <label for="questao">Ordem<span class="text-danger">*</span></label> <input type="number" min="1" value="1" name="ordem[]" id="ordem" class="form-control" required="true" /></div></div><div class="col-sm-11 col-lg-11 col-xs-11"><div class="form-group"> <label for="questao">Titulo<span class="text-danger">*</span></label> <input type="text" name="pergunta[]" id="questao" class="form-control" required="true" /></div></div></div><div class="row"><div class="col-sm-6 col-lg-6 col-xs-12"><div class="form-group"> <label for="imagem">Imagem<span class="text-danger">*</span></label> <input type="file" name="imagem[]" id="imagem" class="form-control" /> <span class="help-block text-info"><i class="fa fa-info-circle"></i> Selecione imagens nas dimensões 420x320</span></div></div><div class="col-sm-6 col-lg-6 col-xs-12"><div class="form-group"> <label for="tipoQuestao">Tipo de resposta<span class="text-danger">*</span></label><select name="tipoQuestao[]" id="tipoQuestao' + count + '" class="form-control" required="true" onchange="Boot.tipoResposta(' + count + ')"><option data-hidden="true" hidden disabled="true" selected="true"> Selecione</option><option value="1"> Resposta curta</option><option value="2">Resposta longa</option><option value="3">Multipla escolha</option><option value="4">Multipla seleção</option><option value="5">Resposta em lista</option><option value="6">Upload de imagem</option> </select></div></div></div><div id="content-conteudo' + count + '"></div></div></div>');

        },
        tipoResposta: function (list, callback) {
            var tipo = $('#tipoQuestao' + list).val();
            var contadorOpcao = $('input[name="contadorOpcoes"]').val();
            var count = (contadorOpcao > 0) ? parseInt(contadorOpcao) + 1 : 1;
            $('input[name="contadorOpcoes"]').val(count);
            switch (parseInt(tipo)) {
                case 1:

                    $('#content-conteudo' + list).html('<div class="row"><div class="col-sm-12 col-lg-12 col-xs-12"> <label for="resposta">resposta</label><input type="text" class="form-control" readonly /></div></div>');

                    break;
                case 2:

                    $('#content-conteudo' + list).html('<div class="row"><div class="col-sm-12 col-lg-12 col-xs-12"><label for="resposta">resposta</label><textarea rows="3" class="form-control" readonly></textarea></div></div>');

                    break;
                case 3:

                    $('#content-conteudo' + list).html('<div class="row"><div class="col-sm-11 col-lg-11 col-xs-12"><input name="contador" type="hidden" value="1" /> <label for="resposta">resposta<span class="text-danger">*</span></label><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"> <i class="fa fa-circle-o" aria-hidden="true"></i></div></div> <input type="text" class="form-control" name="resposta[]" onchange="Boot.qtdOpcoesPorPergunta(' + list + ', this.value)"></div></div><div class="col-sm-1 col-lg-1 col-xs-12 mt-3"><div class="btn-group"> <button data-toggle="tooltip" title="Não e possivel excluir esta opção" type="button" id="linha' + count + '" disabled class="btn btn-sm btn-danger mt-3"><i class="fa fa-ban"></i></button><button type="button" id="linha' + count + '" data-toggle="tooltip" title="Adicionar nova opção" class="btn btn-sm btn-success mt-3 ml-1" onclick="Boot.adicionarOpcoes(' + list + ',' + tipo + ', ' + count + ')"><i class="fa fa-plus"></i></button></div></div></div></div>');

                    break;
                case 4:
                    $('#content-conteudo' + list).html('<div class="row"><div class="col-sm-11 col-lg-11 col-xs-12"><input name="contador" type="hidden" value="1" /> <label for="resposta">resposta<span class="text-danger">*</span></label><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"> <i class="fa fa-square-o" aria-hidden="true"></i></div></div> <input type="text" class="form-control" name="resposta[]" onchange="Boot.qtdOpcoesPorPergunta(' + list + ', this.value)"></div></div><div class="col-sm-1 col-lg-1 col-xs-12 mt-3"> <div class="btn-group"><button data-toggle="tooltip" title="Não e possivel excluir esta opção" type="button" id="linha' + count + '" disabled class="btn btn-sm btn-danger mt-3"><i class="fa fa-ban"></i></button><button type="button" id="linha' + count + '" data-toggle="tooltip" title="Adicionar nova opção" class="btn btn-sm btn-success mt-3 ml-1" onclick="Boot.adicionarOpcoes(' + list + ',' + tipo + ',' + count + ')"><i class="fa fa-plus"></i></button></div></div></div>');

                    break;
                case 5:

                    $('#content-conteudo' + list).html('<div class="row"><div class="col-sm-12 col-lg-13 col-xs-12"><label for="resposta">resposta</label><div class="input-group"><input type="text" class="form-control" readonly /></div>');
                    break;
                case 6:

                    $('#content-conteudo' + list).html('<div class="row"><div class="col-sm-12 col-lg-12 col-xs-12"><label for="resposta">resposta</label><input type="file" disabled="true" class="form-control"></div></div>');

                    break;

                default:
                    break;
            }
            if (callback) {
                callback();
            }

        },
        adicionarOpcoes: function (list, tipo, cont) {
            var contadorOpcao = $('input[name="contadorOpcoes"]').val();
            var count = (contadorOpcao > 0) ? parseInt(contadorOpcao) + 1 : 1;
            $('input[name="contadorOpcoes"]').val(count);

            switch (parseInt(tipo)) {

                case 3:
                    $('#content-conteudo' + list).append('<div class="row" id="linha' + count + '"><div class="col-sm-11 col-lg-11 col-xs-12"><input name="contador" type="hidden" value="1" /> <label for="resposta">resposta<span class="text-danger">*</span></label><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"> <i class="fa fa-circle-o" aria-hidden="true"></i></div></div> <input type="text" class="form-control" name="resposta[]" onchange="Boot.qtdOpcoesPorPergunta(' + list + ', this.value)"></div></div><div class="col-sm-1 col-lg-1 col-xs-12 mt-3"><div class="btn-group"><button type="button" id="' + count + '" data-toggle="tooltip" title="Excluir essa opção" class="btn btn-sm btn-danger mt-3" onclick="Boot.deleteItems(' + count + ')"><i class="fa fa-ban"></i></button></div></div>');

                    break;
                case 4:
                    $('#content-conteudo' + list).append('<div class="row" id="linha' + count + '"><div class="col-sm-11 col-lg-11 col-xs-12"><input name="contador" type="hidden" value="1" /> <label for="resposta">resposta<span class="text-danger">*</span></label><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"> <i class="fa fa-square-o" aria-hidden="true"></i></div></div> <input type="text" class="form-control" name="resposta[]" onchange="Boot.qtdOpcoesPorPergunta(' + list + ', this.value)"></div></div><div class="col-sm-1 col-lg-1 col-xs-12 mt-3"><div class="btn-group"> <button type="button" id="' + count + '" data-toggle="tooltip" title="Excluir essa opção" class="btn btn-sm btn-danger mt-3" onclick="Boot.deleteItems(' + count + ')"><i class="fa fa-ban"></i></button></div></div>');
                    break;

                default:
                    break;
            }
        },
        deleteItems: function (list) {
            $('#linha' + list + '').remove();
        },
        deletePergunta: function (list) {
            $('#questao' + list).remove();
            $('#pergunta' + list + '').remove();

            // console.log(element);
        },
        qtdOpcoesPorPergunta: function (list, opcao) {
            $('#add-pergunta').append('<input type="hidden" id="qtd' + list + '" name="qtdOpcao[' + list + ']"  />');
            var qtd = $('input[name="qtdOpcao[' + list + ']"]').val();
            var dados = (qtd) ? (parseInt(qtd) + 1) : 1;

            $('input[name="qtdOpcao[' + list + ']"]').val(dados);

        }
    }
}();