<?php

namespace Sts\Controllers;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of Blog
 *
 * @author Hart
 */
class Blog {

    //put your code here
    public function index() {

        echo "Página blog";
    }

}
