<?php

namespace App\Sts\Controllers;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of SobreEmpresa
 *
 * @author Hart
 */
class SobreEmpresa {

    private $Dados;

    //put your code here
    public function index() {

        $listarMenu = new \Sts\Models\StsMenu();
        $this->Dados['menu'] = $listarMenu->listarMenu();

        $listarSeo = new \Sts\Models\StsSeo();
        $this->Dados['seo'] = $listarSeo->listarSeo();
        
        $listarSobEmp = new \Sts\Models\StsSobEmp();
        $this->Dados['sts_sobs_emp'] = $listarSobEmp->listarSobEmp();

        $carregarView = new \Core\ConfigView('sts/Views/sobEmp/sobEmp', $this->Dados);
        $carregarView->renderizar();
    }

}
