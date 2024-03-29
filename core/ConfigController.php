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
    private $Classe;
    private $Paginas;

    public function __construct() {

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
//        $UrlController = strtolower($slugController);
//        $UrlController = explode("-", $UrlController);
//        $UrlController = implode(" ", $UrlController);
//        $UrlController = ucwords($UrlController);
//        $UrlController = str_replace(" ", "", $UrlController);
        $UrlController = str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($slugController)))));
        return $UrlController;
    }

    public function carregar() {

//        echo "<br><br><br>";

        $listarPg = new \Sts\Models\StsPaginas();
        $this->Paginas = $listarPg->listarPaginas($this->UrlController);

        if ($this->Paginas):
            extract($this->Paginas[0]);
            $this->Classe = "\\App\\{$tipo_tpg}\\Controllers\\" . $this->UrlController;
            if (class_exists($this->Classe)):
                $this->carregarMetodo();
            else:
                $this->UrlController = $this->slugController(CONTROLLER);
                $this->carregar();
            endif;
        else:
            $this->UrlController = $this->slugController(CONTROLLER);
            $this->carregar();
        endif;
    }

    private function carregarMetodo() {
        $classeCarregar = new $this->Classe;

        if (method_exists($classeCarregar, "index")):
            if ($this->UrlParam !== null):
                $classeCarregar->index($this->UrlParam);
            else:

                $classeCarregar->index();
            endif;
        else:
            $this->UrlController = $this->slugController(CONTROLLER);
            $this->carregar();
        endif;
    }

}
