<?php

namespace Sts\Models;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsArtHome
 *
 * @author Hart
 */
class StsArtHome {

    //put your code here

    private $Resultado;

    public function listarArtHome() {
        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead('SELECT id, titulo, descricao, imagem, slug FROM sts_artigos WHERE adms_sit_id =:adms_sit_id ORDER BY id DESC LIMIT :limit', 'adms_sit_id=1&limit=3');
        $this->Resultado = $listar->getResult();

        return $this->Resultado;
    }

}
