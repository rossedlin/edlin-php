<?php
namespace Cryslo\Core\Sql;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 25/12/2015
 * Time: 23:22
 */
abstract Class _Sql
{
	protected $ip;
	protected $database;
	protected $username;
	protected $password;

	/**
	 * _Sql constructor.
	 *
	 * @param $ip
	 * @param $username
	 * @param $password
	 * @param $database
	 */
	public function __construct($ip, $username, $password, $database)
	{
		$this->ip       = $ip;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;

		$this->init();
	}

	/**
	 * @return void
	 */
	abstract protected function init();

	/**
	 * @param $sql
	 *
	 * @return \Cryslo\Core\Object\Query
	 */
	abstract public function query($sql);

	/**
	 * @param $str
	 *
	 * @return string
	 */
	abstract public function escape($str);
}