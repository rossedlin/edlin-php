<?php
/**
 * @author Ross Edlin <contact@rossedlin.com>
 * Date: 2020-07-07
 * Time: 15:38
 */

namespace Edlin;


class Arr
{
    /**
     * Takes an array of arrays and uses the given key to make the array keyed by that value
     *
     * @param $array
     * @param $key
     *
     * @return array
     */
    public static function keyBy(array $array, $key): array
    {
        $result = [];
        foreach ($array as $item) {
            $result[$item[$key]] = $item;
        }

        return $result;
    }

    /**
     * Returns a array result if set, else the default
     *
     * @param array $array
     * @param       $key
     * @param bool  $default
     *
     * @return mixed
     */
    public static function get(array &$array, $key, $default = false)
    {
        if (isset($array[$key])) {
            return $array[$key];
        }

        return $default;
    }
}