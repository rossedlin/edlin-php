<?php
namespace Cryslo\Core;

class Utils
{
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
	 * @param mixed      $object
	 * @param string     $instanceOf
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
}