<?php

namespace Edlin;

class Utils
{
    /**
     * @param $file
     * @param $version
     *
     * @return string
     * @codeCoverageIgnore
     */
    public static function addVersionToFile($file, $version)
    {
        return $file . '?v=' . $version;
    }

    /**
     * Converts an object like StdClass into an array
     * Nested so sub-objects will convert too
     *
     * @param $object
     *
     * @return array
     */
    public static function convertToArrayFromStdClass($object)
    {
        //convert the object into an array
        if ($object instanceof \stdClass) {
            $object = (array)$object;
        }

        //loop through each array and call ME again
        if (is_array($object)) {
            foreach ($object as $key => $value) {
                $object[$key] = self::convertToArrayFromStdClass($value);
            }
        }

        return $object;
    }

    /**
     * @param $str
     *
     * @return string
     */
    public static function snakeCaseToPascalCase($str)
    {
        return ucfirst(self::snakeCaseToCamelCase($str));
    }

    /**
     * @param $str
     *
     * @return mixed
     */
    public static function snakeCaseToCamelCase($str)
    {
        $func = create_function('$c', 'return strtoupper($c[1]);');

        return preg_replace_callback('/_([a-z])/', $func, $str);
    }
}
