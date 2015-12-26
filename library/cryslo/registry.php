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
    /** @var Db  */
    private static $db;

    /**
     * @return Db
     */
    public static function getDb()
    {
        if (!isset(self::$db))
        {
            self::$db = new Db(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        }

        return self::$db;
    }
}