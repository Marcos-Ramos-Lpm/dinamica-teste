<?php

require_once __DIR__ . '/../class/gUsuario.php';

$gUsuario = new gUsuario();

try {
//COLUNAS
    $col = array(
        0 => 'tb_historico_usuario.id_usuario',
        1 => 'tb_historico_usuario.nome_completo_usuario',
    );

//FILTRO
    if ($_POST['search']['value']) {
        $filtro = $_POST['search']['value'];
    } else {
        $filtro = null;
    }

    $inicio = $_POST['start'];
    $quantidade = $_POST['length'];

    $order = $col[$_POST['order'][0]['column']] . " " . $_POST['order'][0]['dir'];

    $data = array();
    $totalData = 0;

    foreach ($gUsuario->carregaTableHistoricoUsuarios() AS $rst) {

        //DATAS
        $datas = [];
        if ($rst->data_registro) {
            $datas[] = '<span class = "form-text"><i class = "fa fa-calendar text-success"></i> ' . $rst->data_registro . '</span>';
        }
        

        $nome = [];
        if ($rst->nome_completo_usuario) {
            $nome[] = '<span class="form-text">' . $rst->nome_completo_usuario . '</span>';
        }


        $subData = array();
        $subData[] = $rst->id_usuario;
        $subData[] = implode($nome, '');
        $subData[] = implode($datas, '');

        $data[] = $subData;
    }

    $json_data = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalData),
        "data" => $data
    );
    echo json_encode($json_data);
} catch (Exception $ex) {
    $retorno = array('erro' => 1, 'mensagem' => $ex->getMessage());
    die(json_encode($retorno));
}
