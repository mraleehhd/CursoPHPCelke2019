<?php

namespace Sts\Controllers;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of Artigo
 *
 * @author Hart
 */
class Artigo {

    //put your code here

    public function index() {
        echo "Visualizar o artigo";
    }

}
