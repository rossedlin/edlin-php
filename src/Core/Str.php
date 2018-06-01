<?php

namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 *
 * User: rossedlin
 * Contact: <contact@rossedlin.com>
 *
 * Date: 15/03/18
 * Time: 16:52
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