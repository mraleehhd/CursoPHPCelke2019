<?php

namespace Sts\Models\helper;

use PDO;

if (!defined("URL")):
    header("Location: /");
    exit();
endif;

/**
 * Description of StsConn
 *
 * @author Hart
 */
class StsConn {

    public static $Host = HOST;
    public static $User = USER;
    public static $Pass = PASS;
    public static $DbName = DBNAME;
    private static $Connect = null;

    private static function Conectar() {
        try {
            if (self::$Connect == null):

                self::$Connect = new PDO('mysql:host=' . self::$Host . ';dbname=' . self::$DbName, self::$User, self::$Pass);

            endif;
        } catch (Exception $ex) {
            echo "Mensagem " . $ex->getMessage();
            die;
        }

        return self::$Connect;
    }

    public function getConn() {
        return self::Conectar();
    }

}
