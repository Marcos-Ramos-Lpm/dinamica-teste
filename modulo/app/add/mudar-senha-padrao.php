<?php

require_once __DIR__ . '/../class/gApp.php';

$gApp = new gApp(false);

try {
//    die();

    $gApp->resetarSenhaPadrao($_POST['segundaSenha'], $_POST['emailLogin'], $_POST['senhaPadrao']);


    $retorno = array('erro' => 0);
    die(json_encode($retorno));
} catch (Exception $ex) {
    $retorno = array('erro' => 1, 'mensagem' => $ex->getMessage());
    die(json_encode($retorno));
}

