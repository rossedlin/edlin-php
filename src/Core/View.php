<?php
namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 30/01/2017
 * Time: 15:45
 *
 * Class View
 *
 * @package Cryslo\Core
 */
class View
{
	//*********************************************************************************
	//
	// Css
	//
	//*********************************************************************************
	/**
	 * @param       $file
	 * @param array $args
	 *
	 * @return string
	 * @throws \Exception
	 */
	public static function getCss($file, $args = [])
	{
		if (self::cssExists($file))
		{
			return self::_get(self::_getCss($file), $args);
		}

		throw new \Exception("CSS File missing: " . $file);
	}

	/**
	 * @param $file
	 *
	 * @return bool
	 */
	public static function cssExists($file)
	{
		return self::_exists(self::_getCss($file));
	}

	/**
	 * @param $file
	 *
	 * @return string
	 */
	private static function _getCss($file)
	{
		return __DIR__ . '/../../view/' . $file . '.css';
	}

	//*********************************************************************************
	//
	// Html
	//
	//*********************************************************************************
	/**
	 * @param       $file
	 * @param array $args
	 *
	 * @return string
	 * @throws \Exception
	 */
	public static function getHtml($file, $args = [])
	{
		if (self::htmlExists($file))
		{
			return self::_get(self::_getHtml($file), $args);
		}

		throw new \Exception("HTML File missing: " . $file);
	}

	/**
	 * @param $file
	 *
	 * @return bool
	 */
	public static function htmlExists($file)
	{
		return self::_exists(self::_getHtml($file));
	}

	/**
	 * @param $file
	 *
	 * @return string
	 */
	private static function _getHtml($file)
	{
		return __DIR__ . '/../../view/' . $file . '.html';
	}

	//*********************************************************************************
	//
	// Core
	//
	//*********************************************************************************

	/**
	 * @param $file
	 *
	 * @return bool
	 */
	private static function _exists($file)
	{
		if (file_exists($file))
		{
			return true;
		}

		return false;
	}

	/**
	 * @param       $file
	 * @param array $args
	 *
	 * @return string
	 * @throws \Exception
	 */
	private static function _get($file, array $args = [])
	{
		try
		{
			ob_start();
			require($file);
			$contents = ob_get_contents();

			foreach ($args as $key => $arg)
			{
				$contents = str_replace('{{' . $key . '}}', $arg, $contents);
			}

			ob_end_clean();

			return (string)$contents;
		}
		catch (\Exception $e)
		{
			Log::write($e);
			throw $e;
		}
	}
}