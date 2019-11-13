<?php

namespace App\Sts\Controllers;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of Home
 *
 * @author Hart
 */
class Home {

    private $Dados;

    //put your code here
    public function index() {

        $listarMenu = new \Sts\Models\StsMenu();
        $this->Dados['menu'] = $listarMenu->listarMenu();

        $listarSeo = new \Sts\Models\StsSeo();
        $this->Dados['seo'] = $listarSeo->listarSeo();
        
        $listar_car = new \Sts\Models\StsCarousel();
        $this->Dados['sts_carousels'] = $listar_car->listar();

        $listar_serv = new \Sts\Models\StsServico();
        $this->Dados['sts_servicos'] = $listar_serv->listar();

        $listar_video = new \Sts\Models\StsVideo();
        $this->Dados['sts_video'] = $listar_video->listar();

        $listar_art_home = new \Sts\Models\StsArtHome();
        $this->Dados['sts_artigos'] = $listar_art_home->listarArtHome();


        $carregarView = new \Core\ConfigView("sts/Views/home/home", $this->Dados);
        $carregarView->renderizar();
    }

}
