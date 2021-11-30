<?php

require_once '../class/gApp.php';

$gApp = new gApp(false);

try {

    $user = $gApp->login($_POST['email'], $_POST['password']);
    //CRIA A SESSÃO DO USUÁRIO        
    if ($user->id_situacao_senha == 1) {

        $gApp->criarSessaoUsuario($user->id_usuario, $user->nome_completo_usuario, $user->cpf_usuario, $user->imagem);

        $retorno = array('erro' => 0);
        die(json_encode($retorno));
    } else if ($user->id_situacao_senha == 2) {
        $retorno = array('erro' => 2, 'messagem' => 'Senha de acesso não alterada!');
        die(json_encode($retorno));
    } else if ($user->id_situacao_senha == 3) {
        $retorno = array('erro' => 3, 'messagem' => 'Acesso suspenso!');
        die(json_encode($retorno));
    } else {
        $retorno = array('erro' => 3, 'messagem' => 'login ou senha invalida!');
        die(json_encode($retorno));
    }

    $retorno = array('erro' => 0);
    die(json_encode($retorno));
} catch (Exception $ex) {
    $retorno = array('erro' => 1, 'mensagem' => $ex->getMessage());
    die(json_encode($retorno));
}
