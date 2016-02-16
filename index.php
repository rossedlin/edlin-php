<?php
define("CRYSLO_CORE_VERSION", "1.3");
define("DIR_ROOT", __DIR__);


define("NOW_TIMESTAMP", time());
define("NOW_DATETIME", date('Y-m-d H-i-s', NOW_TIMESTAMP));
define("NOW_DATE_AT_TIME", date('Y-m-d @ H-i-s', NOW_TIMESTAMP));
define("NOW_DATE", date('Y-m-d', NOW_TIMESTAMP));
define("NOW_TIME", date('H-i-s', NOW_TIMESTAMP));

//Loader
require_once(DIR_ROOT.'/library/loader.php');

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
 * @param bool $var
 */
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

//autoload
spl_autoload_register(function($class_name)
{
    //load pre defined autoloaded files
    $classes = include('autoload.php');
    if (isset($classes[$class_name]))
    {
        if (\Cryslo\Loader::load(DIR_ROOT.'/'.$classes[$class_name])) return;
    }

    die("Failed to load: ".DIR_ROOT.'/'.$classes[$class_name]);
});