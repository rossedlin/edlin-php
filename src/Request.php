<?php

namespace Edlin;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 07/11/2015
 * Time: 19:45
 *
 * Class Request
 * @package Edlin\Core
 */
class Request
{
    /**
     * Returns a validated array result if set, else the default
     *
     * @param array $array
     * @param       $key
     * @param bool  $default
     *
     * @return mixed
     */
    public static function getFromArray(array &$array, $key, $default = false)
    {
        if (isset($array[$key])) {
            return self::clean($array[$key]);
        }

        return self::clean($default);
    }

    /**
     * Returns a validated post result if set, else the default
     *
     * @param      $key
     * @param bool $default
     *
     * @return string
     */
    public static function post($key, $default = false)
    {
        if (isset($_POST[$key])) {
            return self::clean($_POST[$key]);
        }

        return self::clean($default);
    }

    /**
     * Returns a validated get result if set, else the default
     *
     * @param      $key
     * @param bool $default
     *
     * @return string
     */
    public static function get($key, $default = false)
    {
        if (isset($_GET[$key])) {
            return self::clean($_GET[$key]);
        }

        return self::clean($default);
    }

    /**
     * Returns a validated server result if set, else the default
     *
     * @param      $key
     * @param bool $default
     *
     * @return array|string
     * @codeCoverageIgnore
     */
    public static function server($key, $default = false)
    {
        if (isset($_SERVER[$key])) {
            return self::clean($_SERVER[$key]);
        }

        return self::clean($default);
    }

    /**
     * Returns a validated cookie result if set, else the default
     *
     * @param      $key
     * @param bool $default
     *
     * @return array|string
     * @codeCoverageIgnore
     */
    public static function cookie($key, $default = false)
    {
        if (isset($_COOKIE[$key])) {
            return self::clean($_COOKIE[$key]);
        }

        return self::clean($default);
    }

    /**
     * Returns a validated files result if set, else the default
     *
     * @param      $key
     * @param bool $default
     *
     * @return array|string
     * @codeCoverageIgnore
     */
    public static function files($key, $default = false)
    {
        if (isset($_FILES[$key])) {
            return self::clean($_FILES[$key]);
        }

        return self::clean($default);
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
        } else {
            $data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
        }

        return $data;
    }

    /**
     * Check if we have post data
     *
     * @return bool
     */
    public static function isPost()
    {
        return (self::server('REQUEST_METHOD') === 'POST');
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public static function isValidType($type)
    {
        switch ((string)$type) {
            case 'GET':
                return true;
            case 'POST':
                return true;
            case 'PUT':
                return true;
            default:
                return false;
        }
    }

    /**
     * @return mixed
     * @codeCoverageIgnore
     */
    public static function getClientIp()
    {
        /**
         * Check ip from share internet
         */
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        /**
         * To check ip is pass from proxy
         */
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * @param $ip
     *
     * @return bool
     */
    public static function isValidIp($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return true;
        }

        return false;
    }
}
