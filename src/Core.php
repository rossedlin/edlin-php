<?php

namespace Cryslo;

use Cryslo\Enums;

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
        if ($var === true)
        {
            echo '<pre>';
            print_r("TRUE (boolean)");
            echo '</pre>';

            return;
        }

        if ($var === false)
        {
            echo '<pre>';
            print_r("FALSE (boolean)");
            echo '</pre>';

            return;
        }

        if ($var === null)
        {
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
    public static function prt($var = false, $color = "")
    {
        if ($var === true)
        {
            if ($color === "") $color = Enums\Cli::Green;

            echo($color . "TRUE (boolean)\n" . Enums\Cli::_Close);
        }
        else if ($var === false)
        {
            if ($color === "") $color = Enums\Cli::Red;

            echo($color . "FALSE (boolean)\n" . Enums\Cli::_Close);
        }
        else if ($var === null)
        {
            if ($color === "") $color = Enums\Cli::Red;

            echo($color . "NULL\n" . Enums\Cli::_Close);
        }
        else if (is_array($var))
        {
            echo($color);
            print_r($var);
            echo(Enums\Cli::_Close);
            echo("\n");
        }
        else if ($var instanceof \stdClass)
        {
            echo($color);
            print_r($var);
            echo(Enums\Cli::_Close);
            echo("\n");
        }
        else if (is_object($var))
        {
            echo($color);
            print_r($var);
            echo(Enums\Cli::_Close);
            echo("\n");
        }
        else if ($var)
        {
            echo($color);
            echo($var);
            echo(Enums\Cli::_Close);
            echo("\n");
        }
        else
        {
            echo("\n");
        }
    }

    /**
     * @param bool $var
     */
    public static function die_r($var = false)
    {
        self::pre($var);
        exit;
    }
}