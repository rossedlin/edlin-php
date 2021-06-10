<?php

namespace Edlin;

/**
 * @author  Ross Edlin <contact@rossedlin.com>
 * Date: 10/06/2021
 * Time: 13:15
 *
 * Class Time
 * @package Edlin
 */
class Time
{
    /**
     * @param string $time
     *
     * @return bool
     */
    public static function isValidHHSS(string $time): bool
    {
        if (!preg_match("/^([0-2][0-9].[0-5][0-9])$/", $time)) {
            return false;
        }

        return true;
    }
}
