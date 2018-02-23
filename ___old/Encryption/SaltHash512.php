<?php
namespace Cryslo\Core\Encryption;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 11/10/2017
 * Time: 11:49
 *
 * Class SaltHash
 *
 * @package Cryslo\Core\Encryption
 */
class SaltHash512
{
	/**
	 * @param $value
	 *
	 * @return string
	 */
	public static function generateHash($value)
	{
		return \openssl_digest($value, 'sha512');
	}

	/**
	 * @return string
	 */
	public static function generateSalt()
	{
		return substr(md5(uniqid(rand(), true)), 0, 9);
	}

	/**
	 * @param $password
	 *
	 * @return array
	 */
	public static function generatePassword($password)
	{
		$salt = self::generateSalt();
		$pass = self::generatePasswordUsingSalt($password, $salt);

		return array('password' => $pass, 'salt' => $salt);
	}

	/**
	 * @param $password
	 * @param $salt
	 *
	 * @return string
	 */
	public static function generatePasswordUsingSalt($password, $salt)
	{
		return sha1($salt . sha1($salt . sha1($password)));
	}
}