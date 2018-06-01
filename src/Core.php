<?php

namespace Cryslo;

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
            echo '<pre>';
            print_r("TRUE (boolean)");
            echo '</pre>';

            return;
        }

        if ($var === false) {
            echo '<pre>';
            print_r("FALSE (boolean)");
            echo '</pre>';

            return;
        }

        if ($var === null) {
            echo '<pre>';
            print_r("NULL");
            echo '</pre>';

            return;
        }

        echo '<pre>';
        print_r($var);
        echo '</pre>';

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
