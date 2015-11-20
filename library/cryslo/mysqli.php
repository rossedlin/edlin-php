<?php
namespace Cryslo;

//The point of this is to stop idiots leaving connections open, I recognise that making multiple queries it would be better
//to leave the connection open until you have finished.
//In addition you could using to add layers to the way you wish to communicate allowing future control over SQL interaction, at this moment it does not
//add much to what MySQLi already offers.
//You could add in a system to construct the queries instead of allowing direct querying, the would allow for control over inputs similar to how many frameworks do it, Zend etc...
//MySQL injection filtering and prevention could be added, scanning for particular words on each input.

//Injection prevention
/*
$stmt = $dbConnection->prepare('SELECT * FROM employees WHERE name = ?');
$stmt->bind_param('s', $name);

$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc())
{
    // do something with $row
}
*/

/*
READ THIS PLEASE!!!!!!!!
I just wrote this now, 2015-Mar-18 @14:30
Untested, reason to show you how I write first time!
Before I test.
*/
class MySQLiDB extends SQLDB
{
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
	
	public function Query($sql)
	{
		$this->Connect();
		$result = $this->connection->query($sql);
		if (!$result)
		{
			//die('Invalid query: ' . mysql_error());
			$this->Close();
			return false;
		}
		$this->Close();
		return true;
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
}
?>