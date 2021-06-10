<?php

namespace Edlin\Tests;

use Edlin\Date;
use Edlin\Exceptions\EdlinException;
use Edlin\Time;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 31/05/18
 * Time: 10:46
 *
 * Class TimeTest
 * @package Edlin\Tests\Core
 * @covers  \Edlin\Time
 */
final class TimeTest extends TestCase
{
    /**
     * @covers \Edlin\Date::isValidYYYYMMDD
     */
    public function testIsValidYYYYMMDD()
    {
        $this->assertTrue(Time::isValidHHSS('23:59'));
        $this->assertTrue(Time::isValidHHSS('09:59'));

        /**
         * Failures
         */
        $this->assertFalse(Time::isValidHHSS(' 23:59'));
        $this->assertFalse(Time::isValidHHSS('23:59 '));
        $this->assertFalse(Time::isValidHHSS(' 23:59 '));
        $this->assertFalse(Time::isValidHHSS('9:59'));
        $this->assertFalse(Time::isValidHHSS(' 9:59'));
        $this->assertFalse(Time::isValidHHSS('9:59 '));
    }
}
