<?php
namespace Cryslo\Core;

class Utils
{
	/**
	 * @param $haystack
	 * @param $needle
	 *
	 * @return bool
	 */
	static public function endsWith($haystack, $needle)
	{
		// search forward starting from end minus needle length characters
		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
	}

	/**
	 * @param array $args
	 * @param array $keys
	 *
	 * @return array
	 */
	static public function getArrayFromArguments(array $args, array $keys = [])
	{
		$array = [];
		foreach ($args as $key => $arg)
		{
			if (in_array($arg, $keys))
			{
				$k = self::getFromArray($args, $key);
				$v = self::getFromArray($args, $key + 1);

				if ($k && $v)
				{
					$array[trim($k, '-')] = $v;
				}
			}
		}

		return $array;
	}

	/**
	 * @param      $array
	 * @param      $key
	 * @param bool $default
	 *
	 * @return bool
	 */
	static public function getFromArray(&$array, $key, $default = false)
	{
		if (isset($array[$key]))
		{
			return $array[$key];
		}

		return $default;
	}

	/**
	 * @return mixed
	 */
	public static function getClientIp()
	{
		/**
		 * Check ip from share internet
		 */
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			return $_SERVER['HTTP_CLIENT_IP'];
		}

		/**
		 * To check ip is pass from proxy
		 */
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}

		return $_SERVER['REMOTE_ADDR'];
	}

	/**
	 * @param mixed      $object
	 * @param string     $key
	 * @param bool|mixed $default
	 *
	 * @return bool
	 */
	static public function getMethodObject(&$object, $key, $default = false)
	{
		if (method_exists($object, $key))
		{
			return $object->$key();
		}

		return $default;
	}

	/**
	 * @param string $str
	 *
	 * @return string
	 */
	public static function getOnlyLetters($str)
	{
		return preg_replace('/[^a-zA-Z]+/', '', $str);
	}

	/**
	 * @param string $str
	 *
	 * @return string
	 */
	public static function getOnlyNumbers($str)
	{
		return preg_replace('/[^0-9]+/', '', $str);
	}

	/**
	 * @param mixed      $object
	 * @param string     $key
	 * @param bool|mixed $default
	 *
	 * @return bool
	 */
	static public function getVarObject(&$object, $key, $default = false)
	{
		/** @var $object \stdClass */
		if (isset($object->$key))
		{
			return $object->$key;
		}

		return $default;
	}

	/**
	 * @param $ip
	 *
	 * @return bool
	 */
	public static function isValidIp($ip)
	{
		if (filter_var($ip, FILTER_VALIDATE_IP))
		{
			return true;
		}

		return false;
	}

	/**
	 * @param $timestamp
	 *
	 * @return bool
	 */
	static public function isValidTimeStamp($timestamp)
	{
		return ((string)(int)$timestamp === $timestamp)
		&& ($timestamp <= PHP_INT_MAX)
		&& ($timestamp >= ~PHP_INT_MAX);
	}

	/**
	 * @param $str
	 *
	 * @return string
	 */
	static public function snakeCaseToPascalCase($str)
	{
		return ucfirst(self::snakeCaseToCamelCase($str));
	}

	/**
	 * @param $str
	 *
	 * @return mixed
	 */
	static public function snakeCaseToCamelCase($str)
	{
		$func = create_function('$c', 'return strtoupper($c[1]);');
		return preg_replace_callback('/_([a-z])/', $func, $str);
	}

	/**
	 * @param $haystack
	 * @param $needle
	 *
	 * @return bool
	 */
	static public function startsWith($haystack, $needle)
	{
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
	}
}