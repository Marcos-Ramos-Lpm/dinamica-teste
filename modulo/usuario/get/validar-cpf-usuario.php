<?php

require_once '../class/gUsuario.php';

$gUsuario = new gUsuario();

try {

    $gUsuario->validacaoCPFUsuario($_POST['cpf']);

    $retorno = array('erro' => 0);
    die(json_encode($retorno));
} catch (Exception $ex) {
    $retorno = array('erro' => 1, 'mensagem' => $ex->getMessage());
    die(json_encode($retorno));
}

