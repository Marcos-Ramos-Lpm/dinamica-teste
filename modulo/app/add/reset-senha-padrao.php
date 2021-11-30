<?php

require_once '../class/gApp.php';

$gApp = new gApp();

try {

    $info = $gApp->resetarSenhaPadrao($_POST['novaSenha'], $_POST['emailLogin'], $_POST['senhaPadrao']);

    $retorno = array('erro' => 0);
    die(json_encode($retorno));
} catch (Exception $ex) {
    $retorno = array('erro' => 1, 'mensagem' => $ex->getMessage());
    die(json_encode($retorno));
}

