<?php
namespace Cryslo\Core\Api;

use \Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 25/01/2017
 * Time: 19:04
 *
 * Class CheckPulse
 * @package Cryslo\Core\Api
 */
class CheckPulse
{
	const URL = "check-pulse/";

	/**
	 * @param $code
	 *
	 * @return bool
	 */
	public static function isOnline($code)
	{
		if (Core\Api::get(self::URL . $code)->getPayload()->online)
		{
			return true;
		}
		
		return false;
	}
}