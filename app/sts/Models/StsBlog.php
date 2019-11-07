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
    private $ResultadoPg;
    private $LimitResult = 2;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function ListarArtigos($PageId = null) {
        $this->PageId = (int) $PageId;
        $pagination = new \Sts\Models\helper\StsPager(URL . 'blog');
        $pagination->condition($this->PageId, $this->LimitResult);
        $pagination->paginator('SELECT COUNT(id) AS num_result FROM sts_artigos WHERE adms_sit_id =:adms_sit_id', 'adms_sit_id=1');
        $this->ResultadoPg = $pagination->getResultado();

        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead('SELECT id, titulo, descricao, imagem, slug FROM sts_artigos WHERE adms_sit_id =:adms_sit_id ORDER BY id DESC LIMIT :limit OFFSET :offset', "adms_sit_id=1&limit={$this->LimitResult}&offset={$pagination->getOffSet()}");
        $this->Result = $listar->getResult();
        return $this->Result;
    }

}
