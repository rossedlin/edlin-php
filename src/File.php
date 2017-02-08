<?php
namespace Cryslo\Core;
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 21/11/2015
 * Time: 13:32
 */


class File
{
	/**
	 * @param $file
	 *
	 * @return string
	 * @throws \Exception
	 */
	public static function read($file)
	{
		if (!file_exists($file))
		{
			throw new \Exception("File not found: " . $file);
		}

		try
		{
			$raw = file_get_contents($file);
			return $raw;
		}
		catch (\Exception $e)
		{
			Log::write($e);
			throw $e;
		}
	}

	/**
	 * @param $file
	 * @param $raw
	 *
	 * @return Object\Response
	 */
	public static function write($file, $raw)
	{
		$response = new Object\Response();
		$response->setSuccess(false);

		if ((file_exists($file)) && (!is_writable($file)))
		{
			$response->addResponse("SaveData() file is not writable!");
			return $response;
		}

		try
		{
			file_put_contents($file, $raw);

			$response->setSuccess(true);
			return $response;
		}
		catch (\Exception $e)
		{
			Log::write($e);
			$response->addException($e);
		}
		
		return $response;
	}
}