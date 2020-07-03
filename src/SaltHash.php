<?php

namespace Edlin;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 11/10/2017
 * Time: 11:49
 *
 * Class SaltHash
 *
 * @package Edlin\Core
 */
class SaltHash
{
    /**
     * @param $value
     *
     * @return string
     */
    public static function generateHash($value)
    {
        return \openssl_digest($value, 'sha512');
    }

    /**
     * @return string
     */
    public static function generateSalt()
    {
        return substr(md5(uniqid(rand(), true)), 0, 32);
    }

    /**
     * @param string $password
     *
     * @return array
     */
    public static function generateSaltHash(string $password): array
    {
        $salt = self::generateSalt();

        return [
            'salt' => $salt,
            'hash' => self::generateHash($salt . $password . $salt),
        ];
    }

    /**
     * @param string $password
     * @param string $salt
     *
     * @return array
     */
    public static function validateSaltHash(string $password, string $salt): array
    {
        return [
            'salt' => $salt,
            'hash' => self::generateHash($salt . $password . $salt),
        ];
    }
}
