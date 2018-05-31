<?php

namespace Cryslo\Tests\Core;

use Cryslo\Core\Str;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 09/02/2017
 * Time: 12:10
 *
 * Class StrTest
 * @package Cryslo\Tests\Core
 * @covers  \Cryslo\Core\Str
 */
final class StrTest extends TestCase
{
    /**
     * @covers \Cryslo\Core\Str::cacheFriendlyKey
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
