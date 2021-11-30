<?php

require_once __DIR__ . '/../class/gUsuario.php';

$gUsuario = new gUsuario();

try {
//COLUNAS
    $col = array(
        0 => 'tb_usuario.id_usuario',
        1 => 'tb_usuario.nome_completo_usuario',
        2 => 'tb_usuario.email_usuario',
        3 => 'tb_usuario.data_registro',
        4 => 'tb_usuario.id_situacao'
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

    foreach ($gUsuario->carregaTableUsuarios($filtro, $inicio, $quantidade, $order) AS $rst) {

        $totalData = $rst->totalData;

//BOTÕES
        $buttons = [];
        $buttons[] = '<div class="btn-group"><button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Visualizar dados" onclick="Usuarios.visualizarUsuario(' . $rst->id_usuario . ')"><i class="fa fa-eye"></i></button>';
        $buttons[] = '<button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Editar dados" onclick="Usuarios.editarUsuario(' . $rst->id_usuario . ')"><i class="fa fa-edit"></i></button>';
        if ($rst->id_situacao == 1) {
            $buttons[] = '<button class="btn btn-secondary btn-xs"  data-toggle="tooltip" title="Inativar" onclick="Usuarios.gerenciarSituacaoUsuario(' . $rst->id_usuario . ', 2)"><i class="fa fa-ban text-danger"></i></button>';
        } else {
            $buttons[] = '<button class="btn btn-secondary btn-xs"  data-toggle="tooltip" title="Ativar" onclick="Usuarios.gerenciarSituacaoUsuario(' . $rst->id_usuario . ', 1)"><i class="fa fa-check text-success"></i></button>';
        }
        if ($rst->id_situacao_senha == 1) {
            $buttons[] = '<button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Bloquear acesso" onclick="Usuarios.gerenciarAcessoUsuario(' . $rst->id_usuario . ', 3)"><i class="fa fa-unlock text-success"></i></button>';
        } else if ($rst->id_situacao_senha == 3) {
            $buttons[] = '<button class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Liberar acesso" onclick="Usuarios.gerenciarAcessoUsuario(' . $rst->id_usuario . ', 1)"><i class="fa fa-lock text-danger"></i></button>';
        }
        $buttons[] = '</div>';


        //DATAS
        $datas = [];
        if ($rst->data_registro) {
            $datas[] = '<span class = "form-text"><i class = "fa fa-calendar text-success"></i> ' . $rst->data_registro . '</span>';
        }
        if ($rst->data_alteracao) {
            $datas[] = '<span class = "form-text"><i class = "fa fa-calendar-check-o text-warning"></i> ' . $rst->data_alteracao . '</span>';
        }

        $nome = [];
        if ($rst->nome_completo_usuario) {
            $nome[] = '<span class="form-text">' . $rst->nome_completo_usuario . '</span>';
            $nome[] = '<span class="form-text">' . $gUsuario->set_mascara($rst->cpf_usuario, '###.###.###-##') . '</span>';
        }

        $dados = [];
        if ($rst->email_usuario) {
            $dados[] = '<span class="form-text">' . $rst->email_usuario . '</span>';
            $dados[] = '<span class="form-text">Situação senha: </span>';
            if ($rst->id_situacao_senha == 1) {
                $dados[] = '<span class="badge badge-success form-text"> ' . $rst->situacao_senha . ' <i class="fa fa-check-square"></i></span>';
            } elseif ($rst->id_situacao_senha == 2) {
                $dados[] = '<span class="badge badge-warning form-text"> ' . $rst->situacao_senha . ' <i class="fa fa-exclamation-circle"></i></span>';
            } else {
                $dados[] = '<span class="badge badge-danger form-text"> ' . $rst->situacao_senha . ' <i class="fa fa-ban"></i></span>';
            }
        }

        $subData = array();
        $subData[] = $rst->id_usuario;
        $subData[] = implode($nome, '');
        $subData[] = implode($dados, '');
        $subData[] = implode($datas, '');
        $subData[] = $gUsuario->labelSituacaoGeneric($rst->id_situacao);
        $subData[] = implode($buttons, '');

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
