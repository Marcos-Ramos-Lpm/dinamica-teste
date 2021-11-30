<?php

require_once '../class/gUsuario.php';

$gUsuario = new gUsuario();

try {

    $info = $gUsuario->carregaDadosUsuario($_POST['codigo']);

    $retorno = array('erro' => 0, 'info' => $info);
    die(json_encode($retorno));
} catch (Exception $ex) {
    $retorno = array('erro' => 1, 'mensagem' => $ex->getMessage());
    die(json_encode($retorno));
}
