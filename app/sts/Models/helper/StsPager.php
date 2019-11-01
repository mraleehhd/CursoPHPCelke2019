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

    function __construct($Link) {
        $this->Link = $Link;
        echo "<br><br>$this->Link";
        $this->MaxLink = 2;
    }

    public function condition($Page, $LimitResult) {
        $this->Page = (int) $Page ? $Page : 1;
        $this->LimitResult = (int) $LimitResult;
        $this->OffSet = ($this->Page * $this->LimitResult ) - $this->LimitResult; 
    }

}
