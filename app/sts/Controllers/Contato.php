<?php

namespace Sts\Controllers;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of Contato
 *
 * @author Hart
 */
class Contato {

    private $Dados;

    //put your code here
    public function index() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//        echo "<br><br><br>";
//        print_r($this->Dados);

        if (!empty($this->Dados['CadMsgCont'])):
            unset($this->Dados['CadMsgCont']);
            $cadContato = new \Sts\Models\StsContato();
            $cadContato->cadContato($this->Dados);
            if ($cadContato->getResult()):
                $this->Dados['form'] = null;
            else:
                $this->Dados['form'] = $this->Dados;
            endif;

        endif;
        $carregarView = new \Core\ConfigView('sts/Views/contato/contato', $this->Dados);
        $carregarView->renderizar();
    }

}
