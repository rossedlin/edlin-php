<?php
namespace Cryslo\Core;

use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 09/02/2017
 * Time: 12:10
 *
 * @covers Str
 *
 * Class StrTest
 */
final class StrTest extends TestCase
{
	/**
	 * Testing Adding Numbers
	 */
	public function testCacheFriendlyKey()
	{
        $this->assertEquals('2018-9', Str::cacheFriendlyKey('2018/9'));
        $this->assertEquals('act.something.2018-9', Str::cacheFriendlyKey('act.something.2018/9'));
        $this->assertEquals('act.something.2018-9', Str::cacheFriendlyKey('$$$/act.something.2018/9'));
        $this->assertEquals('u-act.something.2018-9', Str::cacheFriendlyKey('u$$$/act.something.2018/9'));
        $this->assertEquals('u-act.some-thing.20-18-9', Str::cacheFriendlyKey('u$$$/act.some$&^%*^thing.20£$&^@18/9'));
        $this->assertEquals('u-act.so-me-thing.20-18-9', Str::cacheFriendlyKey('u$$$/act.so_me$&^%*^thing.20£$&^@18/9'));
    }
}