<?php

namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 30/01/2017
 * Time: 15:45
 *
 * Class View
 *
 * @package Cryslo\Core
 */
class View
{
    //*********************************************************************************
    //
    // Css
    //
    //*********************************************************************************
    /**
     * @param       $file
     * @param array $args
     *
     * @return string
     * @throws \Exception
     */
    public static function getCss($file, $args = [])
    {
        if (self::cssExists($file)) {
            return self::get(self::getCssFile($file), $args);
        }

        throw new \Exception("CSS File missing: " . $file);
    }

    /**
     * @param $file
     *
     * @return bool
     */
    public static function cssExists($file)
    {
        return file_exists(self::getCssFile($file));
    }

    /**
     * @param $file
     *
     * @return string
     */
    private static function getCssFile($file)
    {
        return __DIR__ . '/../../view/' . $file . '.css';
    }

    //*********************************************************************************
    //
    // Html
    //
    //*********************************************************************************
    /**
     * @param       $file
     * @param array $args
     *
     * @return string
     * @throws \Exception
     */
    public static function getHtml($file, $args = [])
    {
        if (self::htmlExists($file)) {
            return self::get(self::getHtmlFile($file), $args);
        }

        throw new \Exception("HTML File missing: " . $file);
    }

    /**
     * @param $file
     *
     * @return bool
     */
    public static function htmlExists($file)
    {
        return file_exists(self::getHtmlFile($file));
    }

    /**
     * @param $file
     *
     * @return string
     */
    private static function getHtmlFile($file)
    {
        return __DIR__ . '/../../view/' . $file . '.html';
    }

    //*********************************************************************************
    //
    // Core
    //
    //*********************************************************************************

    /**
     * @param       $file
     * @param array $args
     *
     * @return string
     * @throws \Exception
     */
    private static function get($file, array $args = [])
    {
        try {
            ob_start();
            require($file);
            $contents = ob_get_contents();

            foreach ($args as $key => $arg) {
                $contents = str_replace('{{' . $key . '}}', $arg, $contents);
            }

            ob_end_clean();

            return (string)$contents;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
