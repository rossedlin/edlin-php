<?php
namespace Cryslo\Core\Encryption;

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author Ross Edlin <contact@rossedlin.com>
 *
 * Date: 11/10/2017
 * Time: 11:50
 *
 * @covers Email
 *
 * Class EncryptionTest
 */
final class SaltHash512Test extends TestCase
{
	const PASSWORDS = [
		'',
	];

	/**
	 * Testing Adding Numbers
	 */
	public function testAdd()
	{
		foreach (self::PASSWORDS as $password)
		{
			if (strlen(SaltHash512::generateHash($password)) === 128)
			{
				$this->assertTrue(true);
			}
			else
			{
				$this->assertTrue(false);
			}
		}


	}
}