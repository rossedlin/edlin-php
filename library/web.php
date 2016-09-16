<?php
namespace Cryslo;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 16/09/2016
 * Time: 14:32
 */
class Web
{
	public static function pre($var = false)
	{
		if ($var)
		{
			echo '<pre>';
			print_r($var);
			echo '</pre>';
		}
	}
}