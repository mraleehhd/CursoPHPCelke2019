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
    
    public function cadContato(array $Dados) {
        $this->Dados = $Dados;
        $cadContato = new \Sts\Models\helper\StsCreate();
        $cadContato->exeCreate('sts_contatos', $this->Dados);
    }
}
