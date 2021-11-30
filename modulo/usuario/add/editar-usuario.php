<?php

require_once '../class/gUsuario.php';

$gUsuario = new gUsuario();
try {

    if ((isset($_FILES['imagem'])) && ($_FILES['imagem']['error'] != 4)) {
        $upload = new uploadImg($_FILES['imagem']);
        $imagem = $upload->enviar_jcrop(500, 500, 90, $_POST['rx'], $_POST['ry'], $_POST['rw'], $_POST['rh']);
        $newImg = true;
        $oldImg = $_POST['imagemAtual'];
    } else {
        $imagem = $_POST['imagemAtual'];
        $oldImg = $_POST['imagemAtual'];
        $newImg = false;
    }


    $gUsuario->editarUsuario($_POST['codigo'], $_POST['cpf'], $_POST['nomeUsuario'], $_POST['emailUsuario'], $_POST['modulos'], $imagem, $newImg, $oldImg);

    $retorno = array('erro' => 0);
    die(json_encode($retorno));
} catch (Exception $ex) {
    $retorno = array('erro' => 1, 'mensagem' => $ex->getMessage());
    die(json_encode($retorno));
}
