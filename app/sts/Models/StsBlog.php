<?php

namespace Sts\Models;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsBlog
 *
 * @author Hart
 */
class StsBlog {

    private $Result;
    private $PageId;

    public function ListarArtigos($PageId = null) {
        $this->PageId = (int) $PageId;
        $pagination = new \Sts\Models\helper\StsPager(URL . 'blog');
        $pagination->condition($PageId, 3);

        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead('SELECT id, titulo, descricao, imagem, slug FROM sts_artigos WHERE adms_sit_id =:adms_sit_id ORDER BY id DESC LIMIT :limit', 'adms_sit_id=1&limit=5');
        $this->Result = $listar->getResult();
        return $this->Result;
    }

}
