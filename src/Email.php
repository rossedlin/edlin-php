<?php

namespace Edlin;

/**
 * @author  Ross Edlin <contact@rossedlin.com>
 * Date: 10/06/2021
 * Time: 14:30
 *s
 * Class Email
 * @package Edlin
 */
class Email
{
    /**
     * @param string $email
     *
     * @return bool
     */
    public static function isValid(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }
}
