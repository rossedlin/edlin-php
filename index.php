<?php

define("DIR_ROOT", $_SERVER['DOCUMENT_ROOT']);

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