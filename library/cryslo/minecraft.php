<?php
namespace Cryslo;

class Minecraft extends Monitor
{
	private $_ip;
	private $_port;
	private $_ping;
	private $_dir;
	private $_jar;
	private $_ram;
	
	function __construct($name, $type, $ip, $port, $dir, $ram, $jar)
	{
		parent::__construct($name, $type);
		$this->_ip = $ip;
		$this->_port = $port;
		$this->_dir = $dir;
		$this->_ram = $ram;
		$this->_jar = $jar;
	}
	
	public function Ping()
	{
		$this->_ping = json_decode(file_get_contents('http://api.minetools.eu/ping/' . $this->_ip . '/' . $this->_port . ''), true);
	}
	
	public function GetPing()
	{
		return $this->_ping;
	}
	
	public function IsOnline()
	{
		if (parent::IsOnline())
		{
			$this->Ping();
			if (isset($this->_ping['version']['name']))
			{
				return true;
			}
		}
		return false;
	}
	
	public function IsPIDOnline()
	{
		return parent::IsOnline();
	}
	
	public function IsPingOnline()
	{
		$this->Ping();
		if (isset($this->_ping['version']['name']))
		{
			return true;
		}
		return false;
	}
	
	public function StartServer()
	{
		$command = "cd ".$this->_dir." && screen -A -m -d -S cryslo6 -d -m java -Xincgc -Xmx".$this->_ram."m -jar ".$this->_jar;
		
		echo $command."\n";
		exec($command); //Will wait for response, must run in a screen or command will hang
	}
}