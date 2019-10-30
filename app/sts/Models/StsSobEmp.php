<?php

namespace Sts\Models;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsSobEmp
 *
 * @author Hart
 */
class StsSobEmp {

    //put your code here
    private $Resultado;

    public function listarSobEmp() {
        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead('SELECT id, titulo, descricao, imagem FROM sts_sobs_emp WHERE adms_sit_id =:adms_sit_id ORDER BY ordem ASC', 'adms_sit_id=1');
        $this->Resultado = $listar->getResult();

        return $this->Resultado;
    }

}
