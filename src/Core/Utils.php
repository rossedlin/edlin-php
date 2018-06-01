<?php

namespace Cryslo\Core;

class Utils
{
     /**
     * @param mixed      $object
     * @param string     $key
     * @param bool|mixed $default
     *
     * @return bool
     */
    public static function getMethodObject(&$object, $key, $default = false)
    {
        if (method_exists($object, $key)) {
            return $object->$key();
        }

        return $default;
    }

    /**
     * @param mixed      $object
     * @param string     $key
     * @param bool|mixed $default
     *
     * @return bool
     */
    public static function getVarObject(&$object, $key, $default = false)
    {
        /** @var $object \stdClass */
        if (isset($object->$key)) {
            return $object->$key;
        }

        return $default;
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

    /**
     * @param $path
     *
     * @return string
     */
    public static function addVersionToCssFile($path)
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . $path;
        if (file_exists($file)) {
            return $path . '?v=' . filemtime($file);
        }

        return "";
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
}
