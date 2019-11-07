<?php

namespace Sts\Models;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsArtDestaque
 *
 * @author Hart
 */
class StsArtDestaque {

    //put your code here

    private $Result;

    public function ListarArtDestaque() {

        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead("SELECT titulo, slug FROM sts_artigos WHERE adms_sit_id =:adms_sit_id ORDER BY qnt_acesso DESC LIMIT :limit", "adms_sit_id=1&limit=7");
        $this->Result = $listar->getResult();

        return $this->Result;
    }

}
