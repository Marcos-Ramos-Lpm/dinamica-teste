<?php

require_once '../class/gApp.php';

$gApp = new gApp();

try {

    $info = $gApp->carregaMunicipios($_POST['estado']);

    $retorno = array('erro' => 0, 'info' => $info);
    die(json_encode($retorno));
} catch (Exception $ex) {
    $retorno = array('erro' => 1, 'mensagem' => $ex->getMessage());
    die(json_encode($retorno));
}
