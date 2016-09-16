<?php
namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 25/08/15
 * Time: 12:52
 */
class Scramble
{
	const RANDOM_VALUE = "gb830ng03gh34087g9h394b798";

	/**
	 * @param $value
	 * @param $key
	 *
	 * @return string
	 */
	public static function generate($value, $key)
	{
		if (is_array($key))
		{
			$key = implode('-', $key);
		}

		return $value . '.' . md5($value . $key . self::RANDOM_VALUE);
	}

	/**
	 * @param $scrambled_value
	 * @param $key
	 *
	 * @return bool
	 */
	public static function validate($scrambled_value, $key)
	{
		$parts = explode('.', $scrambled_value);
		if (count($parts) === 2)
		{
			if (is_array($key))
			{
				$key = implode('-', $key);
			}

			$check = md5($parts[0] . $key . self::RANDOM_VALUE);
			if ($check == $parts[1])
			{
				return true;
			}
		}
		return false;
	}

	/**
	 * Gets the value if ONLY if it's valid
	 *
	 * @param $scrambled_value
	 * @param $key
	 *
	 * @return mixed
	 */
	public static function get_if_valid($scrambled_value, $key)
	{
		if (self::validate($scrambled_value, $key))
		{
			$parts = explode('.', $scrambled_value);
			return $parts[0];
		}
		return false;
	}

	/**
	 * Gets the un-validate value, this is UNSECURE!!!
	 *
	 * @param $scrambled_value
	 *
	 * @return mixed
	 */
	public static function get_unsecured($scrambled_value)
	{
		$parts = explode('.', $scrambled_value);
		return $parts[0];
	}
}