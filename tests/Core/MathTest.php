<?php

namespace Edlin\Tests\Core;

use Edlin\Core\Math;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 09/02/2017
 * Time: 12:10
 *
 * Class MathTest
 * @package Edlin\Tests\Core
 * @covers  \Edlin\Core\Math
 */
final class MathTest extends TestCase
{
    /**
     * Testing Adding Numbers
     *
     * @covers \Edlin\Core\Math::add
     */
    public function testAdd()
    {
        $this->assertEquals(3, Math::add(1, 2));
        $this->assertEquals(33, Math::add(11, 22));
    }

    /**
     * Testing Even Numbers
     *
     * @covers \Edlin\Core\Math::isEven
     */
    public function testEven()
    {
        $this->assertTrue(Math::isEven(0));
        $this->assertTrue(Math::isEven(2));
        $this->assertTrue(Math::isEven(4));
        $this->assertTrue(Math::isEven(6));
        $this->assertTrue(Math::isEven(8));
        $this->assertTrue(Math::isEven(10));
        $this->assertTrue(Math::isEven(20));
        $this->assertTrue(Math::isEven(50));
        $this->assertTrue(Math::isEven(100));
        $this->assertTrue(Math::isEven(500));
        $this->assertTrue(Math::isEven(1000));
        $this->assertTrue(Math::isEven(10000));
        $this->assertTrue(Math::isEven(100000));
        $this->assertTrue(Math::isEven(1000000));
    }

    /**
     * Testing odd Numbers
     *
     * @covers \Edlin\Core\Math::isOdd
     */
    public function testOdd()
    {
        $this->assertTrue(Math::isOdd(1));
        $this->assertTrue(Math::isOdd(3));
        $this->assertTrue(Math::isOdd(5));
        $this->assertTrue(Math::isOdd(7));
        $this->assertTrue(Math::isOdd(9));
        $this->assertTrue(Math::isOdd(11));
        $this->assertTrue(Math::isOdd(21));
        $this->assertTrue(Math::isOdd(51));
        $this->assertTrue(Math::isOdd(101));
        $this->assertTrue(Math::isOdd(501));
        $this->assertTrue(Math::isOdd(1001));
        $this->assertTrue(Math::isOdd(10001));
        $this->assertTrue(Math::isOdd(100001));
        $this->assertTrue(Math::isOdd(1000001));
    }
}
