<?php

namespace Edlin;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 16/11/2020
 * Time: 10:44
 *
 * Class Session
 * @package Edlin
 */
class Session
{
    /**
     * Returns a validated result if set, else the default
     *
     * @param      $key
     * @param bool $default
     *
     * @return mixed
     */
    public static function get($key, $default = false)
    {
        if (isset($_SESSION[$key])) {
            return self::clean($_SESSION[$key]);
        }

        return self::clean($default);
    }

    /**
     * @param $key
     * @param $val
     */
    public static function set($key, $val)
    {
        $_SESSION[$key] = self::clean($val);
    }

    /**
     * @return array
     */
    public static function all()
    {
        return self::clean($_SESSION);
    }

    /**
     * Cleans the data up
     *
     * @param $data
     *
     * @return array|string
     */
    private static function clean($data)
    {
        /**
         * Core values
         */
        if ($data === true || $data === false || $data === null) {
            return $data;
        }

        /**
         * Filter through
         */
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                unset($data[$key]);
                $data[self::clean($key)] = self::clean($value);
            }
        } elseif (is_object($data)) {
            //do nothing
        } else {
            $data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
        }

        return $data;
    }
}
