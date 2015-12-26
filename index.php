<?php

define("CRYSLO_CORE_VERSION", "1.1");
define("DIR_ROOT", $_SERVER['DOCUMENT_ROOT']);

define("DB_DRIVER", 'mysqli');
define("DB_HOSTNAME", 'localhost');
define("DB_USERNAME", 'cryslo');
define("DB_PASSWORD", 'K4HFK98UJODoQGnrhpTB');
define("DB_DATABASE", 'cryslo_api');

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