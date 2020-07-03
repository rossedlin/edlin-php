<?php

namespace Edlin;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 26/01/2017
 * Time: 10:51
 */
class Cookie
{
    public static function set($key, $value, $expire)
    {
        setcookie($key, $value, $expire, '/');
    }
}