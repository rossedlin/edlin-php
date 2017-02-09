<?php
namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 01/01/2016
 * Time: 14:57
 *
 * Class Math
 * @package Cryslo\Core
 */
class Math
{
	/**
	 * @param $a
	 * @param $b
	 *
	 * @return mixed
	 */
	public static function add($a, $b)
	{
		return $a + $b;
	}

	/**
	 * @param $num
	 *
	 * @return bool
	 */
	public static function isOdd($num)
	{
		return !self::isEven($num);
	}

	/**
	 * @param $num int
	 *
	 * @return bool
	 */
	public static function isEven($num)
	{
		if ($num % 2 == 0)
		{
			return true;
		}
		return false;
	}
}