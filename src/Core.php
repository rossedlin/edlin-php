<?php

namespace Edlin;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 28/09/2016
 * Time: 13:13
 */
class Core
{
    /**
     * @param bool $var
     *
     * @return void
     */
    public static function pre($var = false)
    {
        if ($var === true) {
            echo Enums::PRE;
            print_r("TRUE (boolean)");
            echo Enums::PRE_END;

            return;
        }

        if ($var === false) {
            echo Enums::PRE;
            print_r("FALSE (boolean)");
            echo Enums::PRE_END;

            return;
        }

        if ($var === null) {
            echo Enums::PRE;
            print_r("NULL");
            echo Enums::PRE_END;

            return;
        }

        echo Enums::PRE;
        print_r($var);
        echo Enums::PRE_END;

        return;
    }

    /**
     * @param bool   $var
     * @param string $color
     */
    public static function prt($var = false, $color = Enums\Cli::BLUE)
    {
        /**
         * TRUE
         */
        if ($var === true) {
            echo Enums\Cli::GREEN . "TRUE (boolean)" . Enums\Cli::_CLOSE;
            echo Enums::LF;

            return;
        }

        /**
         * FALSE
         */
        if ($var === false) {
            echo Enums\Cli::RED . "FALSE (boolean)" . Enums\Cli::_CLOSE;
            echo Enums::LF;

            return;
        }

        /**
         * Null
         */
        if ($var === null) {
            echo Enums\Cli::RED . "NULL" . Enums\Cli::_CLOSE;
            echo Enums::LF;

            return;
        }

        /**
         * Everything else
         */
        if ($var) {
            echo $color;
            print_r($var);
            echo Enums\Cli::_CLOSE;
        }

        echo Enums::LF;
        return;
    }
}
