<?php

namespace Sts\Models\helper;

use PDO;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsRead
 *
 * @author Hart
 */
class StsRead extends StsConn {

    //put your code here

    private $Select;
    private $Values;
    private $Result;
    private $Query;
    private $Conn;

    function getResult() {
        return $this->Result;
    }

    public function exeRead($Tabela, $Termos = null, $ParseString = null) {

        if (!empty($ParseString)):
            parse_str($ParseString, $this->Values);
        endif;
        $this->Select = "SELECT * FROM {$Tabela} {$Termos}";
//        echo "$this->Select <br>";
        $this->exeInstrucao();
    }

    public function fullRead($Query, $ParseString = null) {
        $this->Select = (string) $Query;
        if (!empty($ParseString)):
            parse_str($ParseString, $this->Values);
        endif;
        $this->exeInstrucao();
    }

    private function exeInstrucao() {
        $this->conn();
        try {
            $this->getInstrucao();
            $this->Query->execute();
            $this->Result = $this->Query->fetchAll();
        } catch (Exception $ex) {
            $this->Result = null;
        }
    }

    private function conn() {
        $this->Conn = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Select);
        $this->Query->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function getInstrucao() {
        if ($this->Values):
            foreach ($this->Values as $Link => $Valor) :

                if ($Link == 'limit' || $Link == 'offset'):
                    $Valor = (int) $Valor;
                endif;
                $this->Query->bindValue(":$Link", $Valor, (is_int($Valor) ? PDO::PARAM_INT : PDO::PARAM_STR));

            endforeach;
        endif;
    }

}
