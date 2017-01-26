<?php
namespace Cryslo\Core\Api\Google\Analytics;

use \Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 26/01/2017
 * Time: 10:26
 *
 * Class CheckPulse
 * @package Cryslo\Core\Api
 */
class ExcludeIP
{
	const URL = "google/analytics/exclude-ip/";

	/**
	 * @return array
	 */
	public static function getIPs()
	{
		$ips = Core\Api::get(self::URL)->getPayload();

		$return = [];
		foreach ($ips as $ip)
		{
			if (Core\Utils::isValidIP($ip))
			{
				$return[] = $ip;
			}
		}

		return $return;
	}
}