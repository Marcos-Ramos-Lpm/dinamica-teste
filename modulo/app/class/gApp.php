<?php

require_once __DIR__ . '/PDOHandler.php';
require_once __DIR__ . '/Url.php';


class gApp
{

    var $con;
    var $url_raiz;

    public function __construct($validar = true)
    {
        ob_start();

        $this->url_raiz = Url::getBase();

        if ($validar == true) {
            if (!isset($_SESSION)) {
                $this->validar_sessao();
            }
        }
        $this->con = new PDOHandler();
    }

    public function validar_sessao()
    {
        session_start();

        if ((empty($_SESSION['code_user'])) || (empty($_SESSION['name_user'])) || (empty($_SESSION['menu']))) {
            header("Location: " . $this->url_raiz . "login");
        } else {
            return true;
        }
    }

    public function login($email, $password)
    {
        try {

            //BUSCAR DADOS NA TABELA DE USUÁRIOS
            
            $this->con->query("SELECT tb_usuario.id_usuario,tb_usuario.id_situacao,tb_usuario.nome_completo_usuario,tb_usuario.cpf_usuario,tb_usuario.email_usuario,tb_usuario.password_usuario,tb_usuario.id_situacao_senha,tb_usuario.imagem FROM tb_usuario WHERE tb_usuario.id_situacao=1 AND tb_usuario.email_usuario='" . addslashes(mb_strtolower($email)) . "' AND tb_usuario.password_usuario='" . md5($password) . "' LIMIT 1");
            $this->con->execute();

            if ($this->con->row_count() == 0) {
                throw new Exception('Nenhum usuário encontrado com as credenciais informadas. Verifique seu e-mail ou senha.');
            } else {
                $rst = $this->con->result_set();
                return $rst[0];

            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function resetarSenhaPadrao($novaSenha, $emailLogin, $senhaPadrao)
    {
        try {

            $this->con->query("UPDATE tb_usuario SET id_situacao = 1, email_usuario = '" . addslashes(mb_strtolower($emailLogin)) . "', password_usuario = '" . md5($novaSenha) . "', id_situacao_senha = 1 WHERE email_usuario = '" . addslashes(mb_strtolower($emailLogin)) . "' AND password_usuario = '" . md5($senhaPadrao) . "'");
            $this->con->execute();


            return true;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function criarSessaoUsuario($codeUser, $nomeUser, $cpfUser, $foto)
    {
        try {
            if (($codeUser) && ($nomeUser) && ($cpfUser)) {
                session_start();
                $_SESSION['code_user'] = $codeUser;
                $_SESSION['name_user'] = $nomeUser;
                $_SESSION['cpf_user'] = $cpfUser;
                $_SESSION['foto_perfil'] = $foto;
                $_SESSION['menu'] = $this->carregaMenu();

                return true;
            } else {
                throw new Exception('Dados da sessão do usuario imcompletos!');
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    private function carregaMenu()
    {
        try {
            $this->con->query("SELECT tb_modulo.id_modulo,tb_modulo.id_situacao,tb_modulo.modulo,tb_modulo.link,tb_modulo.icone,tb_modulo.flg_submodulo,tb_usuario_modulo.id_usuario FROM tb_modulo LEFT JOIN tb_usuario_modulo ON tb_usuario_modulo.id_modulo=tb_modulo.id_modulo WHERE tb_modulo.id_situacao=1 AND tb_usuario_modulo.id_usuario=" . $this->getUser());
            $this->con->execute();

            $info = [];

            foreach ($this->con->result_set() as $rst) {
                $info[] = (object) array(
                    'modulo' => $rst->modulo,
                    'icone' => $rst->icone,
                    'link' => $rst->link,
                    'id_modulo' => $rst->id_modulo,
                    'id_usuario' => $rst->id_usuario,
                    'flg_submodulo' => $rst->flg_submodulo,
                    'sub' => ($rst->flg_submodulo == 1) ? $this->carregaSubmodulosUsuario($rst->id_modulo) : null
                );
            }

            $this->adicionarHistoricoUsuario($this->getUser(), 'O usuario '.$this->getNameUser().', entrou online');

            return $info;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    private function carregaSubmodulosUsuario($modulo)
    {
        try {
            $this->con->query("SELECT tb_submodulo.id_submodulo,tb_submodulo.id_modulo,tb_submodulo.id_situacao,tb_submodulo.submodulo,tb_submodulo.link_submodulo,tb_submodulo.icone_submodulo FROM tb_submodulo WHERE tb_submodulo.id_situacao=1 AND tb_submodulo.id_modulo=" . $modulo);
            $this->con->execute();

            $info = [];

            foreach ($this->con->result_set() as $rst) {
                $info[] = (object) array(
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

    public function getUser()
    {
        try {
            if ($_SESSION['code_user']) {
                return $_SESSION['code_user'];
            } else {
                throw new Exception('Código do usuário não definido!');
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
    public function getFotoPerfil()
    {
        try {
            if ($_SESSION['foto_perfil']) {
                return $_SESSION['foto_perfil'];
            } else {
                throw new Exception('A imagem do usuário não definido!');
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function getNameUser()
    {
        try {
            if ($_SESSION['name_user']) {
                return $_SESSION['name_user'];
            } else {
                throw new Exception('Nome do usuário não definido!');
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function getCpfUser()
    {
        try {
            if ($_SESSION['cpf_user']) {
                return $_SESSION['cpf_user'];
            } else {
                throw new Exception('CPF do usuário não definido!');
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
   

    public function getMenu()
    {
        try {
            if ($_SESSION['menu']) {
                return $_SESSION['menu'];
            } else {
                throw new Exception('Menu não definido!');
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function logout()
    {
        if (session_destroy()) {
            header("Location: " . Url::getBase() . "login");
        }
    }

    public function apenas_numeros($string)
    {
        return preg_replace('/[^0-9]/', '', $string);
    }

    public function ajusta_valor($valor_recebido)
    {

        $valor = str_replace('R$ ', '', $valor_recebido);

        $valor = str_replace('.', '', $valor_recebido);
        $valor = str_replace(',', '.', $valor);
        return $valor = number_format((float) $valor, 2, '.', '');
    }

    public function calculo_data($operacao, $tipo, $qtd, $data, $format)
    {
        return date($format, strtotime($operacao . $qtd . $tipo, strtotime($data)));
    }

    public function set_mascara($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k]))
                    $maskared .= $val[$k++];
            } else {
                if (isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    function transformaDataEUAparaBR($dataEUA, $separadorEntrada, $separadorSsaida)
    {
        $p = explode($separadorEntrada, $dataEUA);
        return $p[2] . $separadorSsaida . $p[1] . $separadorSsaida . $p[0];
    }

    function transformaDataBRparaEUA($dataBR, $separadorEntrada, $separadorSsaida)
    {
        $p = explode($separadorEntrada, $dataBR);
        return $p[2] . $separadorSsaida . $p[1] . $separadorSsaida . $p[0];
    }

    function labelSituacaoGeneric($situ)
    {
        try {
            switch ($situ) {
                case 1:
                    return '<span class="label label-success">Ativo <i class="fa fa-check"></i></span>';
                    break;
                case 2:
                    return '<span class="label label-danger">Inativo <i class="fa fa-times"></i></span>';
                    break;
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }



    public function primeiro_nome($nomecompleto)
    {
        $partes = explode(' ', $nomecompleto);

        return $partes[0];
    }

    public function sobrenome($nomecompleto)
    {
        $primeiro_nome = $this->primeiro_nome($nomecompleto);
        return str_replace($primeiro_nome, '', $nomecompleto);
    }

    public function limitarTexto($texto, $limite)
    {
        $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
        return $texto;
    }


    public function adicionarHistoricoUsuario($usuarioCodigo, $historico, $data = true)
    {
        try {

            $data = ($data) ? date('Y-m-d H:i:s') : $data;

            $this->con->query("INSERT INTO tb_historico_usuario (id_usuario,historico_usuario,data_registro) VALUES (" . $usuarioCodigo . ", '" . addslashes($historico) . "', '" . $data . "')");
            $this->con->execute();

            return true;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    private function consultarUsuarioEmail($email)
    {
        try {

            $this->con->query("SELECT tb_usuario.id_usuario,tb_usuario.id_situacao,tb_usuario.nome_completo_usuario,tb_usuario.cpf_usuario,tb_usuario.email_usuario,tb_usuario.password_usuario,tb_usuario.id_situacao_senha,tb_usuario.tipo_usuario,tb_usuario.data_registro,tb_usuario.data_alteracao FROM tb_usuario WHERE tb_usuario.email_usuario = '" . addslashes($email) . "' ");
            $this->con->execute();

            if ($this->con->row_count() == 0) {
                throw new Exception('Nenhuma usuario registrado com esse email!');
            }

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
                    'tipo_usuario' => $rst->tipo_usuario,
                    'data_registro' => $rst->data_registro,
                    'data_alteracao' => $rst->data_alteracao
                );
            }
            return $info;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = true)
    {
        /**
         * Função para gerar senhas aleatórias
         * @param integer $tamanho Tamanho da senha a ser gerada
         * @param boolean $maiusculas Se terá letras maiúsculas
         * @param boolean $numeros Se terá números
         * @param boolean $simbolos Se terá símbolos
         * @return string A senha gerada
         */
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';
        $caracteres .= $lmin;
        if ($maiusculas)
            $caracteres .= $lmai;
        if ($numeros)
            $caracteres .= $num;
        if ($simbolos)
            $caracteres .= $simb;
        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }
        return $retorno;
    }

    
}
