<?php

define("CRYSLO_CORE_VERSION", "1.1");
define("DIR_ROOT", $_SERVER['DOCUMENT_ROOT']);


define("TIMESTAMP", time());
define("DATETIME_NOW", date('Y-m-d H-i-s', TIMESTAMP));
define("DATE_NOW", date('Y-m-d', TIMESTAMP));
define("TIME_NOW", date('H-i-s', TIMESTAMP));

/**
 * @param bool|false $var
 */
function pre($var = false)
{
    if ($var)
    {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

function prt($var = false)
{
    if ($var)
    {
        if (is_array($var))
        {
            print_r($var); return;
        }

        if ($var instanceof stdClass)
        {
            print_r($var); return;
        }

        print $var."\n"; return;
    }
}

/**
 * @param bool|false $var
 */
function die_r($var = false)
{
    pre($var);
    exit;
}

/**
 * @param $path
 * @param $class
 * @return bool
 */
function loadClass($path, $class)
{
    $filename = str_replace("\\", "/", $class);
    $file = __DIR__ . $path . strtolower($filename) . '.php';

    return load($file);
}

/**
 * @param $filename
 * @return bool
 */
function load($filename)
{
    //core
    if (file_exists($filename))
    {
        include_once($filename);
        return true;
    }
    return false;
}

//autoload
spl_autoload_register(function($class)
{
    //load library
    if (loadClass('/library/', $class)) return;
});