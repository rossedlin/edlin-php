<?php
namespace Cryslo;

use Cryslo\Core\Request;
use Cryslo\Api\Object;

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
	const URL = "https://api.cryslo.com/v3/";

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

	/**
	 * @param string $url
	 * @param array  $args
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public static function query($url, $args = [])
	{
		$requestType   = Request::getFromArray($args, 'requestType', 'GET');
		$requestHeader = Request::getFromArray($args, 'requestHeader', []);
		$requestBody   = Request::getFromArray($args, 'requestBody', []);
		$requestResponseHeaders   = Request::getFromArray($args, 'requestResponseHeaders', false);

		/**
		 * Check Request Method
		 */
		if (!Request::isValidType($requestType))
		{
			throw new \Exception("Invalid Request Type: " . $requestType);
		}

		/**
		 * Connect to URL and get response
		 */
		$ch = curl_init((string)$url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestType);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeader);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestBody));

		/**
		 * If we want response headers, get them
		 */
		if ($requestResponseHeaders)
		{
			curl_setopt($ch, CURLOPT_HEADER, 1); //ensure we get header from response
		}

		/**
		 * Execute CURL Request
		 */
		$response = curl_exec($ch);

		return $response;
	}
}