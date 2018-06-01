<?php

namespace Cryslo\Core;

class Utils
{
    /**
     * @param $haystack
     * @param $needle
     *
     * @return bool
     */
    public static function endsWith($haystack, $needle)
    {
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
    }

    /**
     * @param array $args
     * @param array $keys
     *
     * @return array
     */
    public static function getArrayFromArguments(array $args, array $keys = [])
    {
        $array = [];
        foreach ($args as $key => $arg) {
            if (in_array($arg, $keys)) {
                $k = self::getFromArray($args, $key);
                $v = self::getFromArray($args, $key + 1);

                if ($k && $v) {
                    $array[trim($k, '-')] = $v;
                }
            }
        }

        return $array;
    }

    /**
     * @param      $array
     * @param      $key
     * @param bool $default
     *
     * @return bool
     */
    public static function getFromArray(&$array, $key, $default = false)
    {
        if (isset($array[$key])) {
            return $array[$key];
        }

        return $default;
    }

    /**
     * @return mixed
     */
    public static function getClientIp()
    {
        /**
         * Check ip from share internet
         */
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        /**
         * To check ip is pass from proxy
         */
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $_SERVER['REMOTE_ADDR'];
    }

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
     * @param string $str
     *
     * @return string
     */
    public static function getOnlyLetters($str)
    {
        return preg_replace('/[^a-zA-Z]+/', '', $str);
    }

    /**
     * @param string $str
     *
     * @return string
     */
    public static function getOnlyNumbers($str)
    {
        return preg_replace('/[^0-9]+/', '', $str);
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
     * @param $ip
     *
     * @return bool
     */
    public static function isValidIp($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return true;
        }

        return false;
    }

    /**
     * @param $timestamp
     *
     * @return bool
     */
    public static function isValidTimeStamp($timestamp)
    {
        return ((string)(int)$timestamp === $timestamp)
               && ($timestamp <= PHP_INT_MAX)
               && ($timestamp >= ~PHP_INT_MAX);
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
     * @param $haystack
     * @param $needle
     *
     * @return bool
     */
    public static function startsWith($haystack, $needle)
    {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

    /**
     * @param $file
     *
     * @return int
     */
    public static function getFileModifyTime($file)
    {
        return filemtime($file);
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

    /**
     * @param $str
     *
     * @return string
     */
    public static function codify($str)
    {
        return strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $str), '-'));
    }

    /**
     * @param string $str
     * @param string $multiple
     * @param string $one
     *
     * @return mixed
     */
    public static function replaceMultipleWithOne($str, $multiple, $one)
    {
        /**
         * Special Case
         */
        switch ((string)$multiple) {
            case ' ':
                return preg_replace('/\s+/', ' ', $str);

            case '+':
                return preg_replace('/\++/', '+', $str);
        }

        /**
         * Default
         */
        try {
            return preg_replace('!' . $multiple . '+!', $one, $str);
        } catch (\Exception $e) {
            return $str;
        }
    }

    /**
     * @param $xmlRaw
     *
     * @return mixed
     */
    public static function xmlToArray($xmlRaw)
    {
        $xmlObj = simplexml_load_string($xmlRaw);
        $json   = json_encode($xmlObj);
        return json_decode($json, true);
    }

    /**
     * @param $url
     *
     * @return string
     */
    public static function addHttp($url)
    {
        if (self::startsWith($url, 'http://')) {
            return $url;
        }

        if (self::startsWith($url, 'https://')) {
            return $url;
        }

        return 'http://' . $url;
    }
}
