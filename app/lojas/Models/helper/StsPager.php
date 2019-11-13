<?php

namespace Sts\Models\helper;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsPager
 *
 * @author Hart
 */
class StsPager {

    private $Link;
    private $MaxLink;
    private $Page;
    private $LimitResult;
    private $OffSet;
    private $Query;
    private $ParseString;
    private $ResultBd;
    private $Resultado;
    private $TotalPaginas;

    function getResultado() {
        return $this->Resultado;
    }

    function getOffSet() {
        return $this->OffSet;
    }

    function __construct($Link) {
        $this->Link = $Link;
        //        echo "<br><br>$this->Link";
        $this->MaxLink = 2;
    }

    public function condition($Page, $LimitResult) {
        $this->Page = (int) $Page ? $Page : 1;
        $this->LimitResult = (int) $LimitResult;
        $this->OffSet = ($this->Page * $this->LimitResult ) - $this->LimitResult;
    }

    public function paginator($Query, $ParseString = null) {
        $this->Query = (string) $Query;
        $this->ParseString = (string) $ParseString;
        $contar = new \Sts\Models\helper\StsRead();
        $contar->fullRead($this->Query, $this->ParseString);
        $this->ResultBd = $contar->getResult();
        if ($this->ResultBd[0]['num_result'] > $this->LimitResult):
            $this->instrucaoPaginacao();
        else:
            $this->Resultado = null;
        endif;
    }

    private function instrucaoPaginacao() {
        $this->TotalPaginas = ceil($this->ResultBd[0]['num_result'] / $this->LimitResult);
        if ($this->TotalPaginas >= $this->Page):
            $this->LayoltPagination();
        else:
            header("Location: {$this->Link}");
        endif;
    }

    private function LayoltPagination() {
        $this->Resultado = "<nav aria-label='...'>";
        $this->Resultado .= "<ul class = 'pagination justify-content-center'>";
        $this->Resultado .= "<li class='page-item'>";
        $this->Resultado .= "<a class='page-link' href=\"{$this->Link}\" tabindex='-1'>Primeira</a>";
        $this->Resultado .= "</li>";
        for ($iPag = $this->Page - $this->MaxLink; $iPag <= $this->Page - 1; $iPag ++):
            if ($iPag >= 1):

                $this->Resultado .= "<li class='page-item'><a class='page-link' href=\"{$this->Link}?pg={$iPag}\">{$iPag}</a></li>";
            else:

            endif;
        endfor;

        $this->Resultado .= "<li class = 'page-item active'>";
        $this->Resultado .= "<a class = 'page-link' href = '#'>{$this->Page} <span class = 'sr-only'>(current)</span></a>";
        $this->Resultado .= "</li>";

        for ($dPag = $this->Page + 1; $dPag <= $this->Page + $this->MaxLink; $dPag++):
            if ($dPag <= $this->TotalPaginas):

                $this->Resultado .= "<li class = 'page-item'><a class = 'page-link' href = \"{$this->Link}?pg={$dPag}\">{$dPag}</a></li>";
            else:

            endif;

        endfor;

        $this->Resultado .= "<li class = 'page-item'>";
        $this->Resultado .= "<a class = 'page-link' href = \"{$this->Link}?pg={$this->TotalPaginas}\"#>ültima</a>";
        $this->Resultado .= "</li>";
        $this->Resultado .= "</ul>";
        $this->Resultado .= "</nav>";
    }

}
