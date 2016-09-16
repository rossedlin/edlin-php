<?php
namespace Cryslo\Core\Sql;

use Cryslo\Core\Object\Query;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 25/12/2015
 * Time: 23:22
 *
 * Class Mysqli
 * @package Cryslo
 */
class Mysqli extends _Sql
{
	/** @var \mysqli */
	private $connection;

	/**
	 * @return void
	 */
	protected function init()
	{
		$this->connection = new \mysqli($this->ip, $this->username, $this->password, $this->database);
	}

	/**
	 * @param $sql
	 *
	 * @return Query
	 */
	public function query($sql)
	{
		$result = $this->connection->query($sql);

		$rows = [];
		if ($result instanceof \mysqli_result)
		{
			while ($row = $result->fetch_assoc())
			{
				$rows[] = $row;
			}
		}

		return new Query($rows);
	}

	/**
	 * @param $str
	 *
	 * @return string
	 */
	public function escape($str)
	{
		return $this->connection->real_escape_string($str);
	}
}