<?php
namespace Cryslo\Core;

use \Cryslo\Core\Sql\Db as Db;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 25/12/2015
 * Time: 23:30
 */

final class Registry
{
	/** @var Db */
	private static $db;

	/**
	 * @return Db
	 */
	public static function getDb()
	{
		if (!isset(self::$db))
		{
			if (!defined('DB_DRIVER')) define("DB_DRIVER", 'mysqli');
			if (!defined('DB_HOSTNAME')) die("DB_HOSTNAME not set!");
			if (!defined('DB_USERNAME')) die("DB_USERNAME not set!");
			if (!defined('DB_PASSWORD')) die("DB_PASSWORD not set!");
			if (!defined('DB_DATABASE')) define("DB_DATABASE", false);

			self::$db = new Db(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		}

		return self::$db;
	}
}