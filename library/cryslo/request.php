<?php
namespace Cryslo;
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 07/11/2015
 * Time: 19:45
 */

class Request
{
    /**
     * Returns a validated post result if set, else the default
     *
     * @param $key
     * @param bool $default
     * @return string
     */
    static public function post($key, $default = false)
    {
        if (isset($_POST[$key])) return self::_validate($_POST[$key]);
        return self::_validate($default);
    }

    /**
     * Returns a validated get result if set, else the default
     *
     * @param $key
     * @param bool $default
     * @return string
     */
    static public function get($key, $default = false)
    {
        if (isset($_GET[$key])) return self::_validate($_GET[$key]);
        return self::_validate($default);
    }

    /**
     * Validates the data passed
     *
     * @param $data
     * @return string
     */
    static private function _validate($data)
    {
        return strip_tags(trim($data));
    }
}