<?php
namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 *
 * User: rossedlin
 * Contact: <contact@rossedlin.com>
 *
 * Date: 20/03/18
 * Time: 12:08
 */
class Html
{
    /**
     * @param $a
     * @param $b
     *
     * @return string
     */
    public static function setFormInputSelected($a, $b): string
    {
        if ($a === $b)
        {
            return "selected";
        }

        return "";
    }
}