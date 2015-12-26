<?php
namespace Cryslo;
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 25/12/2015
 * Time: 23:30
 */

final class Registry
{
    private static $instance;
    private static $data = array();

    public function __construct()
    {
        self::$instance = $this;
    }

    public static function instance()
    {
        return self::$instance;
    }

    public static function set($key, $value)
    {
        self::$data[$key] = $value;
    }

    //**************************************************************************************************************
    // getters
    //**************************************************************************************************************

    /**
     * @return Db
     */
    public static function getDb()
    {
        if (isset(self::$data['db']))
        {
            return self::$data['db'];
        }

        self::set('db', new Db(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE));
        return self::$data['db'];
    }
}