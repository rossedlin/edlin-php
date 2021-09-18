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

    /**
     * @param array $a
     * @param array $b
     *
     * @return array
     */
    public static function compare(array $a, array $b): array
    {
        $diff = [];

        foreach ($a as $aKey => $aValue) {

            /**
             * Check exists
             */
            if (!isset($b[$aKey])) {
                $diff[$aKey] = null;
                continue;
            }

            /**
             * Check Int
             */
            if (is_int($aValue) && $aValue !== $b[$aKey]) {
                $diff[$aKey] = $aValue;
            }

            /**
             * Check String
             */
            if (is_string($aValue) && $aValue !== $b[$aKey]) {
                $diff[$aKey] = $aValue;
            }

            /**
             * Check Array
             */
            if (is_array($aValue)) {
                $r = self::compare($aValue, $b[$aKey]);
                if (!empty($r)) {
                    $diff[$aKey] = $r;
                }
            }
        }

        return $diff;
    }
}
