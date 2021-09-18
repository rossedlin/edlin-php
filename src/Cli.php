<?php
/**
 * @author Ross Edlin <contact@rossedlin.com>
 * Date: 18/09/2021
 * Time: 17:56
 */

namespace Edlin;

class Cli
{
    const PREFIX = '--';

    /**
     * @param string $key
     * @param null   $default
     *
     * @return mixed|null
     */
    public static function get(string $key, $default = null)
    {
        foreach (Request::server('argv', []) as $i => $item) {

            if ($i === 0) {
                continue;
            }

            $parts = explode('=', $item);
            if (count($parts) === 2 && $parts[0] === self::PREFIX . $key) {
                return $parts[1];
            }
        }

        return $default;
    }
}
