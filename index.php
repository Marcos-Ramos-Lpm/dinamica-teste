<?php

require_once __DIR__ . '/modulo/app/class/Url.php';


$modulo = Url::getURL(0);

if ($modulo == null) {
    $modulo = "home";
} else {
    $submodulo = Url::getURL(1);
    if ($submodulo) {
        $modulo = 'modulo/' . $modulo . '/' . $submodulo;
    }
}

if (file_exists(__DIR__ . '/' . $modulo . ".php")) {
    require $modulo . ".php";
} else {
    require "404.php";
}