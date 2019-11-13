<?php

namespace Sts\Models;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsArtigo
 *
 * @author Hart
 */
class StsArtigo {

    //put your code here

    private $Result;
    private $Artigo;

    public function viewArtigo($Artigo = null) {
        $this->Artigo = (string) $Artigo;
        $ViewArt = new \Sts\Models\helper\StsRead();
        $ViewArt->fullRead("SELECT id, titulo, conteudo, imagem FROM sts_artigos WHERE adms_sit_id =:adms_sit_id AND slug =:slug ORDER BY id DESC LIMIT :limit", "adms_sit_id=1&slug={$this->Artigo}&limit=1");
        $this->Result = $ViewArt->getResult();

        return $this->Result;
    }

}
