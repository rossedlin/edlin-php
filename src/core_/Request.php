<?php
namespace Cryslo\Core;
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 07/11/2015
 * Time: 19:45
 */

class Request
{
	/**
	 * Returns a validated array result if set, else the default
	 *
	 * @param array $array
	 * @param $key
	 * @param bool $default
	 *
	 * @return string
	 */
	public static function getFromArray(array &$array, $key, $default = false)
	{
		if (isset($array[$key])) return self::_clean($array[$key]);
		return self::_clean($default);
	}

	/**
	 * Returns a validated post result if set, else the default
	 *
	 * @param $key
	 * @param bool $default
	 *
	 * @return string
	 */
	static public function post($key, $default = false)
	{
		if (isset($_POST[$key])) return self::_clean($_POST[$key]);
		return self::_clean($default);
	}

	/**
	 * Returns a validated get result if set, else the default
	 *
	 * @param $key
	 * @param bool $default
	 *
	 * @return string
	 */
	static public function get($key, $default = false)
	{
		if (isset($_GET[$key])) return self::_clean($_GET[$key]);
		return self::_clean($default);
	}

	/**
	 * Returns a validated server result if set, else the default
	 *
	 * @param $key
	 * @param bool $default
	 *
	 * @return array|string
	 */
	static public function server($key, $default = false)
	{
		if (isset($_SERVER[$key])) return self::_clean($_SERVER[$key]);
		return self::_clean($default);
	}

	/**
	 * Returns a validated cookie result if set, else the default
	 *
	 * @param $key
	 * @param bool $default
	 *
	 * @return array|string
	 */
	static public function cookie($key, $default = false)
	{
		if (isset($_COOKIE[$key])) return self::_clean($_COOKIE[$key]);
		return self::_clean($default);
	}

	/**
	 * Returns a validated files result if set, else the default
	 *
	 * @param $key
	 * @param bool $default
	 *
	 * @return array|string
	 */
	static public function files($key, $default = false)
	{
		if (isset($_FILES[$key])) return self::_clean($_FILES[$key]);
		return self::_clean($default);
	}

	/**
	 * Cleans the data up
	 *
	 * @param $data
	 *
	 * @return array|string
	 */
	private static function _clean($data)
	{
		if ($data === false) return false;
		if ($data === true) return true;

		if (is_array($data))
		{
			foreach ($data as $key => $value)
			{
				unset($data[$key]);
				$data[self::_clean($key)] = self::_clean($value);
			}
		}
		else
		{
			$data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
		}

		return $data;
	}

	/**
	 * Check if we have post data
	 *
	 * @return bool
	 */
	public static function isPost()
	{
		return (self::server('REQUEST_METHOD') == 'POST');
	}

	/**
	 * @param string $type
	 *
	 * @return bool
	 */
	public static function isValidType($type)
	{
		switch ((string)$type)
		{
			case 'GET':
				return true;
			case 'POST':
				return true;
			case 'PUT':
				return true;
		}

		return false;
	}
}