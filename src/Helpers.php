<?php
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 24/01/2017
 * Time: 14:07
 */

if (!function_exists('pre')) {
    /**
     * @param bool $var
     */
    function pre($var = false)
    {
        \Edlin\Core::pre($var);
    }
}

if (!function_exists('prt')) {
    /**
     * @param mixed  $var
     * @param string $color
     */
    function prt($var = false, $color = \Edlin\Enums\Cli::BLUE)
    {
        \Edlin\Core::prt($var, $color);
    }
}
