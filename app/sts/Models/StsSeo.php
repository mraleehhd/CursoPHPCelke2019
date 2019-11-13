<?php

namespace Sts\Models;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsSeo
 *
 * @author Hart
 */
class StsSeo {

    //put your code here
    private $Result;
    private $UrlController;
    private $Url;
    private $UrlConjunto;
    private $UrlParam;
    private static $Format;

    public function listarSeo() {
        $this->monstarUrl();
        echo $this->UrlController;
        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead("SELECT pg.endereco, pg.titulo_site, pg.keywords, pg.description, pg.author, pg.imagem, robo.tipo tipo_rob FROM sts_paginas pg INNER JOIN sts_robots robo ON robo.id=pg.sts_robot_id WHERE pg.controller =:controller ORDER BY pg.id ASC LIMIT :limit", "controller={$this->UrlController}&limit=1");
        $this->Result = $listar->getResult();
        
        return $this->Result;
    }

    private function monstarUrl() {
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))):

            $this->Url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

            $this->limparUrl();

            $this->UrlConjunto = explode("/", $this->Url);


            if (isset($this->UrlConjunto[0])):
                $this->UrlController = $this->slugController($this->UrlConjunto[0]);
            else:
                $this->UrlController = $this->slugController(CONTROLLER);
            endif;
            if (isset($this->UrlConjunto[1])):
                $this->UrlParam = $this->UrlConjunto[1];
            else:
                $this->UrlParam = null;
            endif;

//            echo "URL: {$this->Url} <br><br>";
//            echo "Controller:{$this->UrlController} <br><br>";

        else:

            $this->UrlController = $this->slugController(CONTROLLER);
            $this->UrlParam = null;


        endif;
    }

    private function limparUrl() {
        //Eliminar as tags
        $this->Url = strip_tags($this->Url);
        //Eliminar espaços em branco
        $this->Url = trim($this->Url);
        //Elimitar a barra no final da URL
        $this->Url = rtrim($this->Url, "/");

        self::$Format = array();
        self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
        $this->Url = strtr(utf8_decode($this->Url), utf8_decode(self::$Format['a']), self::$Format['b']);
    }

    private function slugController($slugController) {
        $UrlController = str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($slugController)))));
        return $UrlController;
    }

}
