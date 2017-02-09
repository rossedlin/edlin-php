<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Cryslo\Core\Scramble;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 09/02/2017
 * Time: 13:08
 *
 * @covers Email
 *
 * Class ScrambleTest
 */
final class ScrambleTest extends TestCase
{
	/**
	 * Testing Scrambling & Unscrambling
	 */
	public function testScrambleUnscramble()
	{
		/**
		 * Value - MD5
		 * Key - MD5
		 */
		for ($i = 0; $i < 100; $i++)
		{
			$value = md5(rand());
			$key   = md5(rand());

			$scrambled = Scramble::generate($value, $key);

			$this->assertTrue(Scramble::validate($scrambled, $key));
			$this->assertEquals($value, Scramble::getIfValid($scrambled, $key));
			$this->assertEquals($value, Scramble::getUnsecured($scrambled));
		}

		/**
		 * Value - Int
		 * Key - MD5
		 */
		for ($i = 0; $i < 100; $i++)
		{
			$value = rand();
			$key   = md5(rand());

			$scrambled = Scramble::generate($value, $key);

			$this->assertTrue(Scramble::validate($scrambled, $key));
			$this->assertEquals($value, Scramble::getIfValid($scrambled, $key));
			$this->assertEquals($value, Scramble::getUnsecured($scrambled));
		}

		/**
		 * Value - MD5
		 * Key - Int
		 */
		for ($i = 0; $i < 100; $i++)
		{
			$value = md5(rand());
			$key   = rand();

			$scrambled = Scramble::generate($value, $key);

			$this->assertTrue(Scramble::validate($scrambled, $key));
			$this->assertEquals($value, Scramble::getIfValid($scrambled, $key));
			$this->assertEquals($value, Scramble::getUnsecured($scrambled));
		}

		/**
		 * Value - Int
		 * Key - Int
		 */
		for ($i = 0; $i < 100; $i++)
		{
			$value = rand();
			$key   = rand();

			$scrambled = Scramble::generate($value, $key);

			$this->assertTrue(Scramble::validate($scrambled, $key));
			$this->assertEquals($value, Scramble::getIfValid($scrambled, $key));
			$this->assertEquals($value, Scramble::getUnsecured($scrambled));
		}
	}
}