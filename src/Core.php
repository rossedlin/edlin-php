<?php
namespace Cryslo;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 28/09/2016
 * Time: 13:13
 */
class Core
{
	/**
	 * @param bool $var
	 *
	 * @return void
	 */
	public static function pre($var = false)
	{
		if ($var)
		{
			echo '<pre>';
			print_r($var);
			echo '</pre>';
		}
	}

	/**
	 * @param bool $var
	 */
	public static function prt($var = false)
	{
		if ($var)
		{
			if (is_array($var))
			{
				print_r($var);
				return;
			}

			if ($var instanceof \stdClass)
			{
				print_r($var);
				return;
			}

			print $var . "\n";
			return;
		}
	}

	/**
	 * @param bool $var
	 */
	public static function die_r($var = false)
	{
		self::pre($var);
		exit;
	}
}