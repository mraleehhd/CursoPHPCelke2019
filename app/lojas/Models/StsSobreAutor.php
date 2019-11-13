<?php

namespace Sts\Models;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsSobreAutor
 *
 * @author Hart
 */
class StsSobreAutor {

    //put your code here
    private $Result;

    public function sobreAutor() {
        $viewSobAutor = new \Sts\Models\helper\StsRead();
        $viewSobAutor->fullRead("SELECT id, titulo, descricao, imagem FROM sts_sobres WHERE adms_sit_id =:adms_sit_id AND id =:id LIMIT :limit", "adms_sit_id=1&id=1&limit=1");
        $this->Result = $viewSobAutor->getResult();
        return $this->Result;
    }

}
