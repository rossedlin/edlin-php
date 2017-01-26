<?php
namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 25/01/2017
 * Time: 18:45
 *
 * Class Api
 * @package Cryslo\Core
 */
class Api
{
	const URL = "https://www.cryslo.com/api/v3/";

	/**
	 * @param $subUrl
	 *
	 * @return Object\Api
	 */
	public static function get($subUrl)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, self::URL . $subUrl);
		$raw = curl_exec($ch);
		curl_close($ch);

		$object = new Object\Api($raw);

		return $object;
	}
}