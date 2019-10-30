<?php

namespace Core;

/**
 * Description of ConfigController
 *
 * @author Hart
 */
class ConfigController {

    private $Url;
    private $UrlConjunto;
    private $UrlController;
    private $UrlParam;
    private static $Format;

    public function __construct() {

        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))):

            $this->Url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

            $this->limparUrl();

            $this->UrlConjunto = explode("/", $this->Url);
            

            if (isset($this->UrlConjunto[0])):
                $this->UrlController = $this->slugController($this->UrlConjunto[0]);
            else:
                $this->UrlController = CONTROLLER;
            endif;
            if (isset($this->UrlConjunto[1])):
                $this->UrlParam = $this->UrlConjunto[1];
            else:
                $this->UrlParam = null;
            endif;

//            echo "URL: {$this->Url} <br><br>";
//            echo "Controller:{$this->UrlController} <br><br>";

        else:

            $this->UrlController = CONTROLLER;
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
//        $UrlController = strtolower($slugController);
//        $UrlController = explode("-", $UrlController);
//        $UrlController = implode(" ", $UrlController);
//        $UrlController = ucwords($UrlController);
//        $UrlController = str_replace(" ", "", $UrlController);
        $UrlController = str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($slugController)))));
        return $UrlController;
    }

    public function carregar() {

        $classe = "\\Sts\\Controllers\\" . $this->UrlController;
        $classeCarregar = new $classe;
        $classeCarregar->index();
    }

}
