<?php
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 26/12/2015
 * Time: 18:43
 */

final class Loader
{
    public static function load($file)
    {
        if (file_exists($file))
        {
            include_once($file);
            return true;
        }
        return false;
    }

    public static function loadClass($path, $class)
    {
        $filename = str_replace("\\", "/", $class);
        $file = DIR_ROOT . $path . strtolower($filename) . '.php';

        return self::load($file);
    }
}