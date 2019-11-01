<?php

namespace Sts\Controllers;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/* * sdsd
 * Description of Blog
 *
 * @author Hart
 */

class Blog {

    private $Dados;
    private $PageId;

    //put your code here
    public function index() {
        $this->PageId = filter_input(INPUT_GET, 'pg', FILTER_SANITIZE_NUMBER_INT);
        $this->PageId = $this->PageId ? $this->PageId : 1;
//        echo "<br><br><br>" . $this->PageId;
        $listar_art = new \Sts\Models\StsBlog();
        $this->Dados['artigos'] = $listar_art->ListarArtigos($this->PageId);

        $carregarView = new \Core\ConfigView('sts/Views/blog/blog', $this->Dados);
        $carregarView->renderizar();
    }

}
