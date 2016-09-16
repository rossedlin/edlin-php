<?php
namespace Cryslo;

use Cryslo\Object\Query;

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

	protected function init()
	{
		$this->connection = new \mysqli($this->ip, $this->username, $this->password, $this->database);
	}

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

	public function escape($str)
	{
		return $this->connection->real_escape_string($str);
	}


	/*
	function __construct($ip, $database, $username, $password)
	{
		//echo 'MySQLiDB<br />';
		$this->ip = $ip;
		$this->database = $database;
		$this->username = $username;
		$this->password = $password;
	}









	
	private function Connect()
	{
		$this->connection = new mysqli($this->ip, $this->username, $this->password);
		if (!$this->connection)
		{
			//die("Connection failed: " . mysqli_connect_error());
			return false;
		}
		return true;
	}
	
	private function Close()
	{
		if (!$this->connection) return;
		$this->connection->close();
	}
	
	public function GetMultipleRows($sql)
	{
		$this->Connect();
		$result = $this->connection->query($sql);
		
		$rows = array();
		while($row = $result->fetch_assoc())
		{
			$rows[] = $row;
		}
		$this->Close();
		return $rows;
	}
	
	public function GetSingleRow($sql)
	{
		$this->Connect();
		$result = $this->connection->query($sql);
		
		$row = $result->fetch_assoc();
		$this->Close();
		return $row;
	}
	*/
}

?>