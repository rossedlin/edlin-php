<?php
namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 25/08/15
 * Time: 12:52
 *
 * Class Scramble
 * @package Cryslo\Core
 */
class Scramble
{
	const SCRAMBLE_KEY = "scramble_key";

	/**
	 * @param $key
	 *
	 * @return bool
	 */
	public static function isValidKey($key)
	{
		if (strlen($key) !== 32)
		{
			return false;
		}

		return true;
	}

	/**
	 * @return bool
	 *
	 * @throws \Exception
	 */
	public static function getKey()
	{
		$key = Config::get(self::SCRAMBLE_KEY);
		if (!self::isValidKey($key))
		{
			throw new \Exception("Scramble - Not Valid Key");
		}

		return $key;
	}

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

		return $value . '.' . md5($value . $key . self::getKey());
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

			$check = md5($parts[0] . $key . self::getKey());
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
	public static function getIfValid($scrambled_value, $key)
	{
		if (self::validate($scrambled_value, $key))
		{
			$parts = explode('.', $scrambled_value);
			return $parts[0];
		}
		return false;
	}

	/**
	 * Gets the un-validate value, this is UN-SECURE!!!
	 *
	 * @param $scrambled_value
	 *
	 * @return mixed
	 */
	public static function getUnsecured($scrambled_value)
	{
		$parts = explode('.', $scrambled_value);
		return $parts[0];
	}
}