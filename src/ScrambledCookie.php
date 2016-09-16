<?php
namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 26/06/15
 * Time: 12:15
 */
class ScrambledCookie
{
	/**
	 * @param $cookie_name
	 * @param $value
	 * @param $key
	 * @param int $expiry_mins
	 *
	 * @return bool
	 */
	public static function set($cookie_name, $value, $key, $expiry_mins = 60)
	{
		$expiry = time() + ($expiry_mins * 60);
		if (setcookie($cookie_name, Scramble::generate($value, $key), $expiry, "/"))
		{
			return true;
		}
		return false;
	}

	/**
	 * @param $cookie_name
	 * @param $key
	 *
	 * @return bool
	 */
	public static function validate($cookie_name, $key)
	{
		$cookie = Request::cookie($cookie_name);
		if ($cookie)
		{
			return Scramble::validate($cookie, $key);
		}
		return false;
	}

	/**
	 * @param $cookie_name
	 * @param $key
	 *
	 * @return bool
	 */
	public static function get_if_valid($cookie_name, $key)
	{
		if (self::validate($cookie_name, $key))
		{
			return self::get($cookie_name);
		}
		return false;
	}

	/**
	 * @param $cookie_name
	 *
	 * @return bool
	 */
	public static function get($cookie_name)
	{
		$cookie = Request::cookie($cookie_name);
		if ($cookie)
		{
			$parts = explode('.', $cookie);
			return $parts[0];
		}

		return false;
	}
}