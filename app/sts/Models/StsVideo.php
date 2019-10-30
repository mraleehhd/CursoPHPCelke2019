<?php

namespace Sts\Models;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsVideo
 *
 * @author Hart
 */
class StsVideo {

    //put your code here
    private $Resultado;

    public function listar() {
        $listar = new \Sts\Models\helper\StsRead();
        $listar->exeRead('sts_video', 'LIMIT :limit', 'limit=1');
        $this->Resultado = $listar->getResult();
        return $this->Resultado;
    }

}
