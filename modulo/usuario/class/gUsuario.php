<?php

require_once __DIR__ . '/../../app/class/PDOHandler.php';
require_once __DIR__ . '/../../app/class/gApp.php';
require_once __DIR__ . '/../../app/class/upload.class.php';

/**
 * Description of gUsuario
 *
 * @author BOOTSISTEMAS
 */
class gUsuario extends gApp
{

    var $con;

    public function __construct($validar = true)
    {
        parent::__construct($validar);

        $this->con = new PDOHandler();
    }

    public function carregaTableUsuarios($filtro, $inicio, $quantidade, $ordenacao)
    {
        try {

            $query = "SELECT tb_usuario.id_usuario,tb_usuario.id_situacao,tb_usuario.nome_completo_usuario,tb_usuario.cpf_usuario,tb_usuario.email_usuario,tb_usuario.password_usuario,tb_usuario.id_situacao_senha,(SELECT COUNT(tb_usuario.id_usuario) FROM tb_usuario WHERE tb_usuario.id_situacao IN (1,2)) AS totalData,tb_situacao.situacao,DATE_FORMAT(tb_usuario.data_registro,'%d/%m/%Y') AS data_registro,DATE_FORMAT(tb_usuario.data_alteracao,'%d/%m/%Y') AS data_alteracao,tb_situacao_senha.situacao_senha FROM tb_usuario LEFT JOIN tb_situacao ON tb_usuario.id_situacao=tb_situacao.id_situacao LEFT JOIN tb_situacao_senha ON tb_usuario.id_situacao_senha=tb_situacao_senha.id_situacao_senha WHERE tb_usuario.id_situacao IN (1,2)";

            if ($filtro) {
                $query .= " AND (tb_usuario.id_usuario LIKE ('%" . trim($filtro) . "%') OR tb_usuario.nome_completo_usuario LIKE ('%" . trim($filtro) . "%') OR tb_usuario.cpf_usuario LIKE ('%" . trim($filtro) . "%') OR tb_usuario.email_usuario LIKE ('%" . trim($filtro) . "%') OR tb_situacao.situacao LIKE ('%" . trim($filtro) . "%'))";
            }

            $query .= " ORDER BY " . $ordenacao;

            $query .= " LIMIT " . $inicio . " , " . $quantidade;



            $this->con->query($query);
            $this->con->execute();

            $info = [];

            foreach ($this->con->result_set() as $rst) {
                $info[] = (object) array(
                    'id_usuario' => $rst->id_usuario,
                    'id_situacao' => $rst->id_situacao,
                    'nome_completo_usuario' => $rst->nome_completo_usuario,
                    'cpf_usuario' => $rst->cpf_usuario,
                    'email_usuario' => $rst->email_usuario,
                    'password_usuario' => $rst->password_usuario,
                    'id_situacao_senha' => $rst->id_situacao_senha,
                    'totalData' => $rst->totalData,
                    'situacao' => $rst->situacao,
                    'data_registro' => $rst->data_registro,
                    'data_alteracao' => $rst->data_alteracao,
                    'situacao_senha' => $rst->situacao_senha
                );
            }

            return $info;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function adicionarUsuario($cpf, $nomeUsuario, $emailUsuario, $modulo, $imagem)
    {
        $this->con->begin_transaction();
        try {

            $this->con->query("INSERT INTO tb_usuario(id_situacao,nome_completo_usuario,cpf_usuario,email_usuario,password_usuario,id_situacao_senha,data_registro,imagem)VALUES(1, '" . ucwords(strtolower($nomeUsuario)) . "', '" . $this->apenas_numeros($cpf) . "', '" . addslashes($emailUsuario) . "', '" . md5($this->apenas_numeros($cpf)) . "', 2, '" . date('Y-m-d H:i:s') . "', '" . $imagem . "')");
            $this->con->execute();

            $idUsuario = $this->con->last_inserted_id();

            $this->AdicionarModuloUsuario($modulo, $idUsuario);

            $this->con->commit();
            return true;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    private function AdicionarModuloUsuario($modulo, $idUsuario)
    {
        try {

            foreach ($modulo as $rst) {
                $this->con->query("INSERT INTO tb_usuario_modulo(id_modulo, id_usuario)VALUES(" . $rst . ", " . $idUsuario . ")");
                $this->con->execute();
            }
            return true;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function carregaDadosUsuario($codigo)
    {
        try {

            $this->con->query("SELECT tb_usuario.id_usuario,tb_usuario.id_situacao,tb_usuario.nome_completo_usuario,tb_usuario.cpf_usuario,tb_usuario.email_usuario,tb_usuario.password_usuario,tb_usuario.id_situacao_senha,tb_usuario.data_registro,tb_usuario.data_alteracao,tb_usuario.imagem FROM tb_usuario WHERE tb_usuario.id_usuario = " . $codigo);
            $this->con->execute();

            $info = [];

            foreach ($this->con->result_set() as $rst) {
                $info = (object) array(
                    'id_usuario' => $rst->id_usuario,
                    'id_situacao' => $rst->id_situacao,
                    'nome_completo_usuario' => $rst->nome_completo_usuario,
                    'cpf_usuario' => $rst->cpf_usuario,
                    'email_usuario' => $rst->email_usuario,
                    'password_usuario' => $rst->password_usuario,
                    'id_situacao_senha' => $rst->id_situacao_senha,
                    'data_registro' => $rst->data_registro,
                    'data_alteracao' => $rst->data_alteracao,
                    'imagem' => $rst->imagem,
                    'modulos' => $this->carregaModulosSubmoduloUsuarioEditar($codigo),
                );
            }

            return $info;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function carregaModulosSubmoduloUsuarioEditar($usuario)
    {
        try {

            $this->con->query("SELECT tb_usuario_modulo.id_usuario,tb_usuario_modulo.id_modulo,tb_modulo.modulo,tb_modulo.id_situacao FROM tb_usuario_modulo LEFT JOIN tb_modulo ON tb_usuario_modulo.id_modulo=tb_modulo.id_modulo WHERE tb_modulo.id_situacao=1 AND tb_usuario_modulo.id_usuario=" . $usuario);
            $this->con->execute();

            $info = [];
            foreach ($this->con->result_set() as $rst) {
                $info[] = (object) array(
                    'id_modulo' => $rst->id_modulo,
                    'modulo' => $rst->modulo,
                );
            }

            return $info;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function carregaSubModulosUsuario($usuario)
    {

        try {
            $this->con->query("SELECT tb_submodulo_usuario.id_submodulo_usuario,tb_submodulo_usuario.id_submodulo,tb_submodulo_usuario.id_usuario,tb_submodulo.submodulo FROM tb_submodulo_usuario LEFT JOIN tb_submodulo ON tb_submodulo_usuario.id_submodulo=tb_submodulo.id_submodulo WHERE tb_submodulo_usuario.id_usuario = " . $usuario);
            $this->con->execute();

            $info = [];

            foreach ($this->con->result_set() as $rst) {
                $info[] = (object) array(
                    'id_submodulo_usuario' => $rst->id_submodulo_usuario,
                    'id_submodulo' => $rst->id_submodulo,
                    'id_usuario' => $rst->id_usuario,
                    'submodulo' => $rst->submodulo
                );
            }

            return $info;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function editarUsuario($codigo, $cpf, $nomeUsuario, $emailUsuario, $modulos, $imagem, $newImg, $oldImg)
    {
        $this->con->begin_transaction();
        try {

            $this->con->query("UPDATE tb_usuario SET id_situacao = 1,nome_completo_usuario = '" . ucwords(strtolower($nomeUsuario)) . "',cpf_usuario = '" . $this->apenas_numeros($cpf) . "',email_usuario = '" . $emailUsuario . "',data_alteracao = '" . date('Y-m-d H:i:s') . "', imagem='" . $imagem . "' WHERE id_usuario =" . $codigo);
            $this->con->execute();

            $this->editarModuloUsuario($modulos, $codigo);

            if ($newImg) {
                if (file_exists('../img/' . $oldImg)) {
                    unlink('../img/' . $oldImg);
                }
            }

            $this->con->commit();
            return true;
        } catch (Exception $ex) {
            $this->con->rollback();
            if ($newImg) {
                if (file_exists('../img/' . $imagem)) {
                    unlink('../img/' . $imagem);
                }
            }
            throw new Exception($ex->getMessage());
        }
    }

    private function editarModuloUsuario($modulo, $codigo)
    {
        try {

            $this->con->query("DELETE FROM tb_usuario_modulo WHERE id_usuario = " . $codigo);
            $this->con->execute();


            foreach ($modulo as $value) {
                $this->con->query("INSERT INTO tb_usuario_modulo(id_modulo, id_usuario)VALUES(" . $value . ", " . $codigo . ")");
                $this->con->execute();
            }

            return true;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function gerenciarSituacaoUsuario($codigo, $tipoAcao)
    {
        try {

            if ($tipoAcao == 1) {
                $this->con->query("UPDATE tb_usuario SET id_situacao = " . $tipoAcao . ", data_alteracao = '" . date('Y-m-d H:i:s') . "' WHERE id_usuario = " . $codigo);
                $this->con->execute();
            } elseif ($tipoAcao == 2) {
                $this->con->query("UPDATE tb_usuario SET id_situacao = " . $tipoAcao . ", data_alteracao = '" . date('Y-m-d H:i:s') . "', id_situacao_senha = 3 WHERE id_usuario = " . $codigo);
                $this->con->execute();
            }


            return true;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function validacaoCPFUsuario($cpf)
    {
        try {

            $this->con->query("SELECT tb_usuario.id_usuario,tb_usuario.cpf_usuario,tb_usuario.id_situacao FROM tb_usuario WHERE tb_usuario.cpf_usuario = '" . $this->apenas_numeros($cpf) . "'");
            $this->con->execute();

            if ($this->con->row_count() == 0) {
                return true;
            } else {
                throw new Exception('O Usuário ja possui um cadastro com esse CPF!');
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function gerenciarAcessoUsuario($codigo, $tipoAcao)
    {
        try {

            $this->con->query("UPDATE tb_usuario SET id_situacao_senha = " . $tipoAcao . ", data_alteracao = '" . date('Y-m-d H:i:s') . "' WHERE id_usuario = " . $codigo);
            $this->con->execute();


            return true;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function carregaModulosUsuarios()
    {
        try {

            $this->con->query("SELECT tb_modulo.id_modulo,tb_modulo.id_situacao,tb_modulo.modulo,tb_modulo.link,tb_modulo.icone,tb_modulo.flg_submodulo FROM tb_modulo WHERE tb_modulo.id_situacao=1");
            $this->con->execute();

            $info = [];

            foreach ($this->con->result_set() as $rst) {
                $info[] = (object) array(
                    'id_modulo' => $rst->id_modulo,
                    'id_situacao' => $rst->id_situacao,
                    'modulo' => $rst->modulo,
                    'link' => $rst->link,
                    'icone' => $rst->icone,
                    'is_submodulo' => $rst->flg_submodulo,
                    'sub_modulo' => $this->carrgarSubModulos($rst->id_modulo),
                );
            }
            return $info;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    private function carrgarSubModulos($idModulo)
    {
        try {

            $this->con->query("SELECT tb_submodulo.id_submodulo,tb_submodulo.id_modulo,tb_submodulo.id_situacao,tb_submodulo.submodulo,tb_submodulo.link_submodulo,tb_submodulo.icone_submodulo FROM tb_submodulo WHERE tb_submodulo.id_situacao=1 AND tb_submodulo.id_modulo = " . $idModulo);
            $this->con->execute();

            $info = [];

            foreach ($this->con->result_set() as $rst) {
                $info[] = (object) array(
                    'id_submodulo' => $rst->id_submodulo,
                    'id_modulo' => $rst->id_modulo,
                    'id_situacao' => $rst->id_situacao,
                    'submodulo' => $rst->submodulo,
                    'link_submodulo' => $rst->link_submodulo,
                    'icone_submodulo' => $rst->icone_submodulo
                );
            }
            return $info;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function carregarVisualizarUsuario($codigo)
    {
        try {

            $this->con->query("SELECT tb_usuario.id_usuario,tb_usuario.id_situacao,tb_usuario.nome_completo_usuario,tb_usuario.cpf_usuario,tb_usuario.email_usuario,tb_usuario.password_usuario,tb_usuario.id_situacao_senha,tb_usuario.data_registro,tb_usuario.data_alteracao,tb_usuario.imagem FROM tb_usuario WHERE tb_usuario.id_usuario = " . $codigo);
            $this->con->execute();

            $info = [];

            foreach ($this->con->result_set() as $rst) {
                $info = (object) array(
                    'id_usuario' => $rst->id_usuario,
                    'id_situacao' => $rst->id_situacao,
                    'imagem' => $rst->imagem,
                    'nome_completo_usuario' => $rst->nome_completo_usuario,
                    'cpf_usuario' => $rst->cpf_usuario,
                    'email_usuario' => $rst->email_usuario,
                    'password_usuario' => $rst->password_usuario,
                    'id_situacao_senha' => $rst->id_situacao_senha,
                    'data_registro' => $rst->data_registro,
                    'data_alteracao' => $rst->data_alteracao,
                    'modulos' => $this->moduloUsuarioVisualizar($codigo)
                );
            }
            return $info;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    private function moduloUsuarioVisualizar($codigo)
    {
        try {
            $this->con->query("SELECT tb_modulo.id_modulo,tb_modulo.id_situacao,tb_modulo.modulo,tb_modulo.link,tb_modulo.icone,tb_modulo.flg_submodulo,tb_usuario_modulo.id_usuario,tb_usuario_modulo.id_usuario_modulo FROM tb_modulo LEFT JOIN tb_usuario_modulo ON tb_usuario_modulo.id_modulo=tb_modulo.id_modulo WHERE tb_usuario_modulo.id_usuario =" . $codigo);
            $this->con->execute();

            $info = [];

            foreach ($this->con->result_set() as $rst) {
                $info[] = (object) array(
                    'id_usuario_modulo' => $rst->id_usuario_modulo,
                    'id_modulo' => $rst->id_modulo,
                    'id_usuario' => $rst->id_usuario,
                    'modulo' => $rst->modulo,
                    'is_submodulo' => $rst->flg_submodulo
                );
            }

            return $info;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function carregaTableHistoricoUsuarios()
    {
        try {
            $this->con->query("SELECT tb_historico_usuario.id_historico_usuario,tb_historico_usuario.id_usuario,tb_historico_usuario.historico_usuario,DATE_FORMAT(tb_historico_usuario.data_registro,'%d/%m/%Y %H:%i:%s') data_registro,tb_usuario.nome_completo_usuario FROM tb_historico_usuario LEFT JOIN tb_usuario ON tb_historico_usuario.id_usuario=tb_usuario.id_usuario ORDER BY tb_historico_usuario.data_registro DESC LIMIT 1");
            $this->con->execute();

            $info = $this->con->result_set();

            return $info;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

}
