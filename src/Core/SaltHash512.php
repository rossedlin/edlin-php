<?php

namespace Cryslo\Core;

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
 * @package Cryslo\Core\Encryption
 */
class SaltHash512
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
     * @param string      $password
     * @param string|null $salt
     *
     * @return array
     * @throws \Exception
     */
    public static function generateSaltHashFromPassword(string $password, string $salt = null): array
    {
        if ($salt === null)
        {
            $salt = self::generateSalt();
        }
        elseif (strlen($salt) !== 32)
        {
            throw new \Exception('Salt not 32 characters');
        }

        return [
            'salt' => $salt,
            'hash' => self::generateHash($salt . $password . $salt),
        ];
    }
}