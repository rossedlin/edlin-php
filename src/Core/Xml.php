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
    public static function soapToArray(string $xmlString): array
    {
        /**
         * This is a special pattern from the internet to clean up SOAP responses
         * Allowing SimpleXMLElement to actually work
         * Without it, you just get a blank object
         *
         * See url below
         *
         * @url - https://stackoverflow.com/questions/21777075/how-to-convert-soap-response-to-php-array
         */
        $xmlString = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $xmlString);
        $xmlObject = new \SimpleXMLElement($xmlString);

        return self::convertToArrayFromSimpleXMLElement($xmlObject);
    }

    /**
     * @param $object
     *
     * @return array
     */
    private static function convertToArrayFromSimpleXMLElement($object)
    {
        /**
         * Convert the object into an array
         */
        if ($object instanceof \SimpleXMLElement) {
            $object = (array)$object;
        }

        /**
         * Loop through each array and call SELF again
         */
        if (is_array($object)) {
            foreach ($object as $key => $value) {
                if (is_string($key) && Str::startsWith($key, 'ns1')) {

                    /**
                     * ** Special case **
                     *
                     * Trim the ns1 prefix from the array key
                     */
                    $newKey          = ltrim($key, 'ns1');
                    $object[$newKey] = self::convertToArrayFromSimpleXMLElement($value);
                    unset($object[$key]);
                } else {

                    /**
                     * Normal
                     */
                    $object[$key] = self::convertToArrayFromSimpleXMLElement($value);
                }
            }
        }

        return $object;
    }
}
