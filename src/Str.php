<?php

namespace Edlin;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 15/03/18
 * Time: 16:52
 *
 * Class Str
 * @package Edlin\Core
 */
class Str
{
    /**
     * @param $key
     *
     * @return string
     */
    public static function cacheFriendlyKey($key)
    {
        return trim(preg_replace('/[^a-zA-Z0-9.]+/', '-', $key), '-');
    }

    /**
     * @param $str
     *
     * @return string
     */
    public static function codify($str)
    {
        return strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $str), '-'));
    }

    /**
     * @param $haystack
     * @param $needle
     *
     * @return bool
     */
    public static function endsWith($haystack, $needle)
    {
        return $needle === "" || (
                ($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false
            );
    }

    /**
     * @param string $str
     *
     * @return string
     */
    public static function getOnlyLetters($str)
    {
        return preg_replace('/[^a-zA-Z]+/', '', $str);
    }

    /**
     * @param string $str
     *
     * @return string
     */
    public static function getOnlyNumbers($str)
    {
        return preg_replace('/[^0-9]+/', '', $str);
    }

    /**
     * @param string $str
     *
     * @return string
     */
    public static function getOnlyNumbersWithPlus($str)
    {
        return preg_replace('/[^+0-9]+/', '', $str);
    }

    /**
     * @param $str
     *
     * @return bool
     */
    public static function hasOnlyNumbers($str): bool
    {
        if (preg_match('/[^0-9]+/', $str)) {
            return false;
        }

        return true;
    }

    /**
     * @param string $str
     * @param string $multiple
     * @param string $one
     *
     * @return mixed
     * @throws \Exception
     */
    public static function replaceMultipleWithOne($str, $multiple, $one)
    {
        /**
         * Special Case
         */
        switch ((string)$multiple) {
            case ' ':
                return preg_replace('/\s+/', $one, $str);

            case '+':
                return preg_replace('/\++/', $one, $str);

            default:
                return preg_replace('!' . $multiple . '+!', $one, $str);
        }
    }

    /**
     * @param $haystack
     * @param $needle
     *
     * @return bool
     */
    public static function startsWith($haystack, $needle)
    {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }
}
