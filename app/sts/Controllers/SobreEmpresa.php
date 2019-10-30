<?php

namespace Sts\Controllers;

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

        $listarSobEmp = new \Sts\Models\StsSobEmp();
        $this->Dados['sts_sobs_emp'] = $listarSobEmp->listarSobEmp();

        $carregarView = new \Core\ConfigView('sts/Views/sobEmp/sobEmp', $this->Dados);
        $carregarView->renderizar();
    }

}
