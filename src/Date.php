<?php
namespace Cryslo\Core;
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 09/01/2017
 * Time: 13:33
 *
 * Class Pid
 * @package Cryslo\Core
 */
class Date
{
	public static function yearsFrom($date)
	{
		$date     = new \DateTime($date);
		$today    = new \DateTime();
		$interval = $today->diff($date);
		return $interval->format('%y');
	}
}