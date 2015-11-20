<?php
namespace Cryslo;

class Monitor
{
	private $_pid;
	private $_name;
	private $_type;
	
	function __construct($name, $type)
	{
			$this->_name = $name;
			$this->_type = $type;
	}
	
	public function GetPIDRaw()
	{
		exec("pgrep -f -l \"".$this->_name."\"", $result);
		return $result;
	}
	public function GetPID()
	{
		//if (isset($this->_pid)) return $this->_pid;

		exec("pgrep -f -l \"".$this->_name."\"", $result);
		if (count($result) > 0)
		{
			if (is_array($result))
			{
				foreach($result as $r)
				{
					$p = explode(" ", $r); //$p[0] == PID, $p[1] == type
					if ("screen" == trim($p[1]))
					{
						$this->_pid = trim($p[0]);
						return $this->_pid;
					}
				}
			}
		}
		return -1;
	}
	
	public function IsOnline()
	{
		$pid = $this->GetPID();
		if ($pid > 0)
		{
			return true;
		}
		return false;
	}
}