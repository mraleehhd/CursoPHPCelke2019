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

    private $Dados;

    //put your code here
    public function index() {

        $listar_art = new \Sts\Models\StsBlog();
        $this->Dados['artigos'] = $listar_art->ListarArtigos();
             
        $carregarView = new \Core\ConfigView('sts/Views/blog/blog', $this->Dados);
        $carregarView->renderizar();
    }

}
