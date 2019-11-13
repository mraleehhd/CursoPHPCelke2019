<?php

namespace App\Sts\Controllers;

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

    private $Dados;
    private $Artigo;

    public function index($Artigo = null) {

        $listarMenu = new \Sts\Models\StsMenu();
        $this->Dados['menu'] = $listarMenu->listarMenu();
        
        $listarSeo = new \Sts\Models\StsSeo();
        $this->Dados['seo'] = $listarSeo->listarSeo();
        
        $this->Artigo = (string) $Artigo;
//        echo "<br><br><br>";
        $ViewArt = new \Sts\Models\StsArtigo();
        $this->Dados['sts_artigos'] = $ViewArt->viewArtigo($this->Artigo);

        $listarArtRecente = new \Sts\Models\StsArtRecentes();
        $this->Dados['artRecente'] = $listarArtRecente->listarArtRecente();

        $listarArtDestaque = new \Sts\Models\StsArtDestaque();
        $this->Dados['artDestaque'] = $listarArtDestaque->ListarArtDestaque();

        $viewAutor = new \Sts\Models\StsSobreAutor();
        $this->Dados['sobreAutor'] = $viewAutor->sobreAutor();

        if (!empty($this->Dados['sts_artigos'][0])):
            $artProxAnt = new \Sts\Models\StsArtigoProxAnt();
            $this->Dados['artProximo'] = $artProxAnt->artigoProximo($this->Dados['sts_artigos'][0]['id']);
            $this->Dados['artAnterior'] = $artProxAnt->artigoAnterior($this->Dados['sts_artigos'][0]['id']);

        endif;
//        echo "<pre>";
//        print_r($this->Dados);
//        echo "</pre>";
        $carregarView = new \Core\ConfigView('sts/Views/blog/artigo', $this->Dados);
        $carregarView->renderizar();
    }

}
