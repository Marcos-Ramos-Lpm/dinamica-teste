<?php

require_once '../class/gUsuario.php';

$gUsuario = new gUsuario();

try {

    //        VERIFICA IMAGEM SE FOI INFORMADA FAZ O UPLOAD
    if ((isset($_FILES['imagem'])) && ($_FILES['imagem']['error'] != 4)) {
        //SIGNIFICA QUE O USUÁRIO SELECIONOU UMA NOVA IMAGEM NO INPUT FILE
        $upload = new uploadImg($_FILES['imagem'], '../img/');
        $imagem = $upload->enviar_jcrop(220, 220, 90, $_POST['rx'], $_POST['ry'], $_POST['rw'], $_POST['rh']);
    } else {

        $imagem = NULL;
    }

    $gUsuario->adicionarUsuario($_POST['cpf'], $_POST['nomeUsuario'], $_POST['emailUsuario'], $_POST['modulos'], $imagem);

    $retorno = array('erro' => 0);
    die(json_encode($retorno));
} catch (Exception $ex) {
    $retorno = array('erro' => 1, 'mensagem' => $ex->getMessage());
    die(json_encode($retorno));
}
