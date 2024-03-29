<?php

namespace Sts\Models;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsPaginas
 *
 * @author Hart
 */
class StsPaginas {

    //put your code here
    private $Result;
    private $UrlController;

    public function listarPaginas($UrlController = null) {

        $this->UrlController = (string) $UrlController;
        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead("SELECT pg.id,
                tpg.tipo tipo_tpg 
                FROM sts_paginas pg
                INNER JOIN sts_tps_pgs tpg ON tpg.id=pg.sts_tps_pg_id
                WHERE pg.sts_situacaos_pg_id =:sts_situacaos_pg_id AND pg.controller =:controller LIMIT :limit", "sts_situacaos_pg_id=1&controller={$this->UrlController}&limit=1");
        $this->Result = $listar->getResult();

//        echo "<pre>>";
//        print_r($this->Result);
//        echo "</pre>";

        return $this->Result;
    }

}
