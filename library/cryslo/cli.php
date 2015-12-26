<?php
namespace Cryslo;
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 25/12/2015
 * Time: 17:39
 */

class Cli
{

    static public function getArgument($key, $default = false)
    {
        GLOBAL $argv;

        if (isset($argv[$key]))
        {
            return $argv[$key];
        }

        return $default;
    }

    /**
     * Gets the arguments and builds them in an array
     * Using the $keys, it will search for the key in the $argv array and the next index will be the value
     *
     * @param array $keys
     * @return array
     */
    static public function getArguments(array $keys = [])
    {
        GLOBAL $argv;
        return Utils::getArrayFromArguments($argv, $keys);
    }
}