<?php

namespace Sts\Models;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsServico
 *
 * @author Hart
 */
class StsServico {
    //put your code here
    
    private $Resultado;
    
    public function listar() {
        $listar = new \Sts\Models\helper\StsRead();
        $listar->exeRead('sts_servicos', 'LIMIT :limit', 'limit=1');
        $this->Resultado = $listar->getResult();
        
        return $this->Resultado;
    }
}
