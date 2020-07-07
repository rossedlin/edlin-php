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
}