<?php
namespace Cryslo\Core\Api\Google;

use \Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 30/01/2017
 * Time: 15:37
 *
 * Class Analytics
 * @package Cryslo\Core\Api\Google
 */
class Analytics
{
	const URL_EXCLUDE_IP    = "google/analytics/exclude-ip/";
	const COOKIE_EXCLUDE_IP = 'exclude-ip';

	/**
	 * @return array
	 */
	public static function getExcludedIps()
	{
		$ips = Core\Api::get(self::URL_EXCLUDE_IP)->getPayload();

		$return = [];
		foreach ($ips as $ip)
		{
			if (Core\Utils::isValidIp($ip))
			{
				$return[] = $ip;
			}
		}

		return $return;
	}

	/**
	 * @return bool
	 */
	public static function isMyIpExcluded()
	{
		$myIP = Core\Request::server('REMOTE_ADDR');

		/**
		 * Check if we have a cookie set
		 * Refresh it if we do
		 */
		if (Core\Request::cookie(self::COOKIE_EXCLUDE_IP))
		{
			Core\Cookie::set(self::COOKIE_EXCLUDE_IP, true, time() + Core\Time::FOUR_WEEKS);
			return true;
		}

		/**
		 * Validate against API IP addresses
		 * Set a cookie for future use
		 */
		if (in_array($myIP, self::getExcludedIps()))
		{
			Core\Cookie::set(self::COOKIE_EXCLUDE_IP, true, time() + Core\Time::FOUR_WEEKS);
			return true;
		}

		return false;
	}

	/**
	 * @param string $code
	 *
	 * @return string - HTML
	 */
	public static function getHtml($code)
	{
		return Core\View::getHtml('Api/Google/Analytics', [
			'code' => $code,
		]);
	}

	/**
	 * @param string $code
	 *
	 * @return string - HTML
	 */
	public static function getHtmlIfIpAllowed($code)
	{
		if (!self::isMyIpExcluded())
		{
			return self::getHtml($code);
		}

		return "";
	}
}