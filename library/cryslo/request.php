<?php
namespace Cryslo;
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 07/11/2015
 * Time: 19:45
 */

class Request
{
    static public function get($key, $default = false)
    {
        if (isset($_GET[$key])) return $_GET[$key];
        return $default;
    }
}