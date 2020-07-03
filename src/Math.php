<?php
namespace Edlin\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 01/01/2016
 * Time: 14:57
 *
 * Class Math
 * @package Edlin\Core
 */
class Math
{
	/**
	 * @param int $a
	 * @param int $b
	 *
	 * @return int
	 */
	public static function add($a, $b)
	{
		return (int)$a + (int)$b;
	}

	/**
	 * @param $num
	 *
	 * @return bool
	 */
	public static function isOdd($num)
	{
		return !self::isEven((int)$num);
	}

	/**
	 * @param $num int
	 *
	 * @return bool
	 */
	public static function isEven($num)
	{
		if ((int)$num % 2 == 0)
		{
			return true;
		}
		return false;
	}
}