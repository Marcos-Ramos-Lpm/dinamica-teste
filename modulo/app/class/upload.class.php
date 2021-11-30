<?php

class uploadImg {

    var $file;
    var $path;

    function __construct($file, $path = '../img/') {
        if (empty($file)) {
            throw new Exception('Nenhum arquivo recebido...');
        } else {
            $this->file = $file;
            $this->path = $path;
        }
    }

    public function enviar() {

        // Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = $this->path;

        // Tamanho máximo do arquivo (em Bytes)
        $_UP['tamanho'] = '62914560';

        // Array com as extensões permitidas
        $_UP['extensoes'] = array('jpg', 'png', 'gif', 'doc', 'pdf', 'xls', 'docx', 'xlsx', 'mp4', '3gp', 'avi', 'jpeg');

        // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
        $_UP['renomeia'] = true;

        // Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 0;
        $_UP['erros'][1] = 1;
        $_UP['erros'][2] = 2;
        $_UP['erros'][3] = 3;
        $_UP['erros'][4] = 4;

        // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
        if ($this->file['error'] != 0) {
            throw new Exception('Erro no upload' . $_UP['erros'][$this->file['error']], 1);
        }

        // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
        // Faz a verificação da extensão do arquivo

        $extensao = explode('.', $this->file['name']);
        $extensao = $extensao[1];
        if (array_search($extensao, $_UP['extensoes']) === false) {
            throw new Exception('Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif', 2);
        }

        // Faz a verificação do tamanho do arquivo
        if ($_UP['tamanho'] < $this->file['size']) {
            throw new Exception('O arquivo enviado é muito grande, envie arquivos de até 60Mb.', 3);
        }

        // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
        // Primeiro verifica se deve trocar o nome do arquivo
        if ($_UP['renomeia'] == true) {
            // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
            $nome_final = md5(time()) . '.' . $extensao;
        } else {
            // Mantém o nome original do arquivo
            $nome_final = $this->file['name'];
        }

        // Depois verifica se é possível mover o arquivo para a pasta escolhida
        if (move_uploaded_file($this->file['tmp_name'], $_UP['pasta'] . $nome_final)) {
            // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
            return $nome_final;
        } else {
            // Não foi possível fazer o upload, provavelmente a pasta está incorreta
            throw new Exception('Erro ao realizar upload.', 13);
        }
    }

    function enviar_jcrop($targ_w, $targ_h, $jpeg_quality, $x, $y, $w, $h) {
        try {
            $src = $this->file['tmp_name'];

            $extensoes_permitidas = array('jpg', 'png', 'gif', 'jpeg');
            $expl = explode('.', $this->file['name']);
            $extensao = $expl[1];
            if (array_search(strtolower($extensao), $extensoes_permitidas) === false) {
                throw new Exception('Extenção não permitida');
            }

            if (strtolower($extensao) == 'jpg') {
                $img_r = imagecreatefromjpeg($src);
            } else if ($extensao == 'png') {
                $img_r = imagecreatefrompng($src);
            } else if ($extensao == 'gif') {
                $img_r = imagecreatefromgif($src);
            } else if ($extensao == 'jpeg') {
                $img_r = imagecreatefromjpeg($src);
            }

            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
            $nome_final = md5(time()) . '.jpg';
            imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $targ_w, $targ_h, $w, $h);
            imagejpeg($dst_r, $this->path . $nome_final, $jpeg_quality);
            return $nome_final;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

}

/*
  erros do upload:
  1-> O arquivo no upload é maior do que o limite do PHP';
  2-> O arquivo ultrapassa o limite de tamanho especifiado no HTML';
  3-> O upload do arquivo foi feito parcialmente';
  4-> Não foi feito o upload do arquivo';
 */






