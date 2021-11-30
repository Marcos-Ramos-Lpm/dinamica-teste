<?php

require_once __DIR__ . '/modulo/app/class/gApp.php';
$gApp = new gApp();
try {
    $gApp->logout();
} catch (Exception $ex) {
    $retorno = array('erro' => 1, 'mensagem' => $ex->getMessage());
    die(json_encode($retorno));
}

