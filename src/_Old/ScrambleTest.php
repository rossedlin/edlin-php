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
			$this->_testScrambleUnscramble(md5(rand()), md5(rand()));
		}

		/**
		 * Value - Int
		 * Key - MD5
		 */
		for ($i = 0; $i < 100; $i++)
		{
			$this->_testScrambleUnscramble(rand(), md5(rand()));
		}

		/**
		 * Value - MD5
		 * Key - Int
		 */
		for ($i = 0; $i < 100; $i++)
		{
			$this->_testScrambleUnscramble(md5(rand()), rand());
		}

		/**
		 * Value - Int
		 * Key - Int
		 */
		for ($i = 0; $i < 100; $i++)
		{
			$this->_testScrambleUnscramble(rand(), rand());
		}
	}

	/**
	 * @param mixed $value
	 * @param mixed $key
	 */
	private function _testScrambleUnscramble($value, $key)
	{
		$scrambled = Scramble::generate($value, $key);

		/**
		 * Validated a scrambled value using our original key
		 */
		$this->assertTrue(Scramble::validate($scrambled, $key));
		$this->assertEquals($value, Scramble::getIfValid($scrambled, $key));

		/**
		 * Validated a BAD scrambled value using our original key
		 */
		$this->assertFalse(Scramble::validate($value . "." . md5(rand()), $key));
		$this->assertFalse(Scramble::getIfValid($value . "." . md5(rand()), $key));

		/**
		 * Validated a scrambled value using a BAD key
		 */
		$this->assertFalse(Scramble::validate($scrambled, rand()));
		$this->assertFalse(Scramble::getIfValid($scrambled, rand()));
	}
}