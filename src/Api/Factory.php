<?php
namespace Cryslo\Api;

use Cryslo\Object;

/**
 * Created by PhpStorm.
 *
 * @author Ross Edlin <contact@rossedlin.com>
 *
 * Date: 10/09/2017
 * Time: 13:41
 */

class Factory
{
	/**
	 * Renders and exits
	 *
	 * @param Object\Api $obj
	 */
	public static function renderAndExit(Object\Api $obj)
	{
		echo $obj->renderAsJson();
		exit;
	}

	/**
	 * Renders error and exits
	 *
	 * @param Object\Api $obj
	 */
	public static function renderErrorAndExit(Object\Api $obj)
	{
		$obj->setSuccess(false);

		echo $obj->renderAsJson();
		exit;
	}

	/**
	 * Renders success and exits
	 *
	 * @param Object\Api $obj
	 */
	public static function renderSuccessAndExit(Object\Api $obj)
	{
		$obj->setSuccess(true);

		echo $obj->renderAsJson();
		exit;
	}
}