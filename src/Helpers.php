<?php
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 24/01/2017
 * Time: 14:07
 */

if (!function_exists('pre'))
{
	/**
	 * @param bool $var
	 */
	function pre($var = false)
	{
		\Cryslo\Core::pre($var);
	}
}

if (!function_exists('prt'))
{
	/**
	 * @param bool $var
	 */
	function prt($var = false)
	{
		\Cryslo\Core::prt($var);
	}
}

if (!function_exists('die_r'))
{
	/**
	 * @param bool $var
	 */
	function die_r($var = false)
	{
		\Cryslo\Core::die_r($var);
	}
}