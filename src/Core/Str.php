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
     * @param string $multiple
     * @param string $one
     *
     * @return mixed
     */
    public static function replaceMultipleWithOne($str, $multiple, $one)
    {
        /**
         * Special Case
         */
        switch ((string)$multiple) {
            case ' ':
                return preg_replace('/\s+/', ' ', $str);

            case '+':
                return preg_replace('/\++/', '+', $str);
        }

        /**
         * Default
         */
        try {
            return preg_replace('!' . $multiple . '+!', $one, $str);
        } catch (\Exception $e) {
            return $str;
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
