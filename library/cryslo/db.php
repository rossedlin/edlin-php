<?php
namespace Cryslo;
/**
 * Created by PhpStorm.
 * User: rosse
 * Date: 25/12/2015
 * Time: 23:31
 */

class Db
{
    const DRIVER_MYSQLI = 'mysqli';

    private $_db;

    /**
     * @param $driver
     * @param $ip
     * @param $username
     * @param $password
     * @param $database
     */
    public function __construct($driver, $ip, $username, $password, $database)
    {
        switch ($driver)
        {
            case self::DRIVER_MYSQLI:
                $this->_db = new Mysqli($ip, $username, $password, $database);
                break;
            default:
                die_r("Bad DB driver: ".$driver);
                break;
        }
    }

    /**
     * @param $sql
     * @return Object\Query
     */
    public function query($sql)
    {
        return $this->_db->query($sql);
    }

    public function escape($str)
    {
        return $this->_db->escape($str);
    }
}