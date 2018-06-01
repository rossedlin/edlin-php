<?php

namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 01/06/18
 * Time: 14:01
 *
 * Class Xml
 * @package Cryslo\Core
 */
/**
 * Created by PhpStorm.
 *
 * User: rossedlin
 * Contact: <contact@rossedlin.com>
 *
 * Date: 22/02/18
 * Time: 17:42
 */

class Xml
{
    /**
     * @param $raw
     *
     * @return array
     * @throws \Exception
     */
    public static function simpleToArray($raw): array
    {
        $obj  = simplexml_load_string($raw);
        $json = json_encode($obj);
        return json_decode($json, true);
    }

    /**
     * @param string $xmlString
     *
     * @return array
     * @throws \Exception
     */
    public static function toArray($raw): array
    {
        $obj  = simplexml_load_string($raw);
        $json = json_encode($obj);
        return json_decode($json, true);
    }
}
