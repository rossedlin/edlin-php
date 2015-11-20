<?php
namespace Cryslo;

class MySQLDB
{
	protected $ip;
	protected $database;
	protected $username;
	protected $password;
	protected $connection;
	
	function __construct($ip, $database, $username, $password)
	{
		//echo 'MySQLDB<br />';
		$this->ip = $ip;
		$this->database = $database;
		$this->username = $username;
		$this->password = $password;
		$this->Connect();
		$this->SelectDB();
	}
	
	private function Connect()
	{
		if ($this->connection = mysql_connect($this->ip, $this->username, $this->password)) return true;
		return false;
	}
	
	private function SelectDB()
	{
		if (mysql_select_db($this->database)) return true;
		return false;
	}
	
	public function Query($sql)
	{
		$sql = str_replace("\n", "", $sql);
		$result = mysql_query($sql, $this->connection);
		if (!$result)
		{
			die('Invalid query: ' . mysql_error());
			return false;
		}
		return true;
	}
	
	public function GetMultipleRows($sql)
	{
		$result = mysql_query($sql, $this->connection);
		if (!$result) die('Invalid query: ' . mysql_error());
		
		$rows = array();
		while($row = mysql_fetch_assoc($result))
		{
			$rows[] = $row;
		}
		return $rows;
	}
	
	public function GetSingleRow($sql)
	{
		$result = mysql_query($sql, $this->connection);
		if (!$result) die('Invalid query: ' . mysql_error());
		
		$row = mysql_fetch_assoc($result);
		return $row;
	}
	
	public function SQLDump($sql)
	{
		$myFile = "dump.sql";
		$fh = fopen($myFile, 'w') or die("can't open file");
		fwrite($fh, $sql);
		fclose($fh);
	}
	
	public function FilterVar($var)
	{
		$var = str_replace("'", "''", $var);
		return $var;
	}
}
?>