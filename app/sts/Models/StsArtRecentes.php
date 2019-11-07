<?php

namespace Sts\Models;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsArtRecentes
 *
 * @author Hart
 */
class StsArtRecentes {

    private $Result;

    public function listarArtRecente() {
        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead("SELECT titulo, slug FROM sts_artigos WHERE adms_sit_id =:adms_sit_id ORDER BY id DESC LIMIT :limit", "adms_sit_id=1&limit=7");
        $this->Result = $listar->getResult();
        return $this->Result;
    }

}
