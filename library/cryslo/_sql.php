<?php
namespace Cryslo;
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 25/12/2015
 * Time: 23:22
 */

abstract Class _Sql
{
    protected $_ip;
    protected $_database;
    protected $_username;
    protected $_password;

    /**
     * _Sql constructor.
     * @param $ip
     * @param $username
     * @param $password
     * @param $database
     */
    public function __construct($ip, $username, $password, $database)
    {
        $this->_ip = $ip;
        $this->_username = $username;
        $this->_password = $password;
        $this->_database = $database;

        $this->init();
    }

    abstract protected function init();

    abstract public function query($sql);
}