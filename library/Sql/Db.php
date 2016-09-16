<?php
namespace Cryslo\Core\Sql;

use Cryslo\Core\Cryslo as Cryslo;
use Cryslo\Core\Object\Query as Query;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 25/12/2015
 * Time: 23:31
 */
class Db
{
	const DRIVER_MYSQLI = 'mysqli';

	/**
	 * @var _Sql
	 */
	private $db;

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
				$this->db = new Mysqli($ip, $username, $password, $database);
				break;
			default:
				Cryslo::die_r("Bad DB driver: " . $driver);
				break;
		}
	}

	/**
	 * @param $sql
	 *
	 * @return Query
	 */
	public function query($sql)
	{
		return $this->db->query($sql);
	}

	/**
	 * @param $str
	 *
	 * @return string
	 */
	public function escape($str)
	{
		return $this->db->escape($str);
	}
}