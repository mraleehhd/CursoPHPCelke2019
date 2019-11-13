<?php

namespace Sts\Models;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsContato
 *
 * @author Hart
 */
class StsContato {

    private $Result;
    private $Dados;
    
    function getResult() {
        return $this->Result;
    }

    
    public function cadContato(array $Dados) {
        $this->Dados = $Dados;
        $this->validarDados();
        if ($this->Result):
            $this->inserir();
        endif;
    }

    private function validarDados() {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Para enviar a mensagem preencha todos os campos!</div>";
            $this->Result = false;
        else:
            if (filter_var($this->Dados['email'], FILTER_VALIDATE_EMAIL)):
                $this->Result = true;
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: E-mail inválido!</div>";
                $this->Result = false;
            endif;

        endif;
    }

    private function inserir() {
        $cadContato = new \Sts\Models\helper\StsCreate();
        $cadContato->exeCreate('sts_contatos', $this->Dados);
        if ($cadContato->getResultado()):
            $_SESSION['msg'] = "<div class='alert alert-success'>Mensagem enviada com sucesso!</div>";
            $this->Result = true;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Ërro: Mensagem não foi enviada!</div>";
            $this->Result = false;
        endif;
    }

}
