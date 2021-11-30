<?php

require_once '../class/gApp.php';

$gApp = new gApp(false);
try {


    $gApp->recuperarSenhaUsuario($_POST['email']);

    $retorno = array('erro' => 0);
    die(json_encode($retorno));
} catch (Exception $ex) {
    $retorno = array('erro' => 1, 'mensagem' => $ex->getMessage());
    die(json_encode($retorno));
}

