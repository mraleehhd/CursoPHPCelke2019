<?php

namespace Sts\Controllers;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of Contato
 *
 * @author Hart
 */
class Contato {

    private $Dados;
    //put your code here
    public function index() {
        $this->Dados = ['nome' => 'Teste', 'email' => 'mraleehhd@gmail.com', 'assunto' => 'teste1', 'mensagem' => 'msgTeste 1', 'created' => date('Y-m-d H:i:s')];
//        print_r($this->Dados);
        $cadContato = new \Sts\Models\StsContato();
        $cadContato->cadContato($this->Dados);
        
    }

}
