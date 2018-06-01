<?php

namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 15/03/18
 * Time: 16:52
 *
 * Class Str
 * @package Cryslo\Core
 */
class Str
{
    /**
     * @param $key
     * @return string
     */
    public static function cacheFriendlyKey($key)
    {
        return trim(preg_replace('/[^a-zA-Z0-9.]+/', '-', $key), '-');
    }
}
