<?php

require_once '../class/gApp.php';

$gApp = new gApp();

try {

    
    $info = $gApp->carregaEnderecoCEP($_POST['cep']);

    if ($info) {
        $retorno = array('erro' => 0, 'info' => $info);
        die(json_encode($retorno));
    } else {
        throw new Exception('CEP não localizado!');
    }
} catch (Exception $ex) {
    $retorno = array('erro' => 1, 'mensagem' => $ex->getMessage());
    die(json_encode($retorno));
}