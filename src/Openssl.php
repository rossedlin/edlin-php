<?php
namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 23/02/2017
 * Time: 12:39
 *
 * Class Openssl
 * @package Cryslo\Core
 */
class Openssl
{
	/**
	 * @param $name
	 * @param $directory
	 *
	 * @return string
	 */
	public static function generateSelfSigned($name, $directory)
	{
		$subj = "/C=/ST=/L=/O=/OU=/CN=" . $name;

		if (!Directory::exists($directory))
		{
			Directory::make($directory);
		}

		$commands = [

			//purge temp ssl files
			'rm ' . self::_name($name) . '.crt',
			'rm ' . self::_name($name) . '.csr',
			'rm ' . self::_name($name) . '.key',

			//purge temp ssl files
			'rm ' . $directory . '/' . self::_name($name) . '.crt',
			'rm ' . $directory . '/' . self::_name($name) . '.csr',
			'rm ' . $directory . '/' . self::_name($name) . '.key',

			//generate ssl files
			'openssl genrsa -out "' . self::_name($name) . '.key" 2048',
			'openssl req -new -subj "' . $subj . '" -key "' . self::_name($name) . '.key" -out "' . self::_name($name) . '.csr"',
			'openssl x509 -req -days 365 -in "' . self::_name($name) . '.csr" -signkey "' . self::_name($name) . '.key" -out "' . self::_name($name) . '.crt"',

			//move ssl files to directory
			'mv ' . self::_name($name) . '.crt ' . $directory . '/' . self::_name($name) . '.crt',
			'mv ' . self::_name($name) . '.csr ' . $directory . '/' . self::_name($name) . '.csr',
			'mv ' . self::_name($name) . '.key ' . $directory . '/' . self::_name($name) . '.key',
		];

		foreach ($commands as $command)
		{
			exec($command);
		}

		return true;
	}

	/**
	 * @param string $str
	 *
	 * @return string mixed
	 */
	private static function _name($str)
	{
		$str = str_replace('*', 'wildcard', $str);

		return $str;
	}
}