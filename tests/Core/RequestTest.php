<?php

namespace Cryslo\Core;

use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * User: rossedlin
 * Contact: <contact@rossedlin.com>
 *
 * Date: 23/02/18
 * Time: 17:09
 */

/**
 * Class RequestTest
 * @package Cryslo\Core
 * @covers  Request
 */
final class RequestTest extends TestCase
{
    /**
     * Testing Adding Numbers
     */
    public function testGetFromArray()
    {
        /**
         * Int Key
         */
        $data = [
            'zero',
            'one',
            'two',
            'three',
        ];

        $this->assertEquals(Request::getFromArray($data, 0), 'zero');
        $this->assertEquals(Request::getFromArray($data, 1), 'one');
        $this->assertEquals(Request::getFromArray($data, 2), 'two');
        $this->assertEquals(Request::getFromArray($data, 3), 'three');

        /**
         * String Key
         */
        $data = [
            'zero' => 'zero-123',
            'one' => 'one-123',
            'two' => 'two-123',
            'three' => 'three-123',
        ];

        $this->assertEquals(Request::getFromArray($data, 'zero'), 'zero-123');
        $this->assertEquals(Request::getFromArray($data, 'one'), 'one-123');
        $this->assertEquals(Request::getFromArray($data, 'two'), 'two-123');
        $this->assertEquals(Request::getFromArray($data, 'three'), 'three-123');
    }
}