<?php

namespace Cryslo\Tests\Core;

use Cryslo\Core\Request;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 23/02/18
 * Time: 17:09
 *
 * Class RequestTest
 * @package Cryslo\Tests\Core
 * @covers  \Cryslo\Core\Request
 */
final class RequestTest extends TestCase
{
    /**
     * Testing Array
     *
     * @covers \Cryslo\Core\Request::getFromArray
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
            'zero'  => 'zero-123',
            'one'   => 'one-123',
            'two'   => 'two-123',
            'three' => 'three-123',
        ];

        $this->assertEquals(Request::getFromArray($data, 'zero'), 'zero-123');
        $this->assertEquals(Request::getFromArray($data, 'one'), 'one-123');
        $this->assertEquals(Request::getFromArray($data, 'two'), 'two-123');
        $this->assertEquals(Request::getFromArray($data, 'three'), 'three-123');
    }

    /**
     * Testing Post
     *
     * @covers \Cryslo\Core\Request::isPost
     */
    public function testPost()
    {
        /**
         * IsPost
         */
        $this->assertFalse(Request::isPost());

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $this->assertTrue(Request::isPost());

        /**
         * Int Key
         */
        $_POST = [
            'zero',
            'one',
            'two',
            'three',
            "\"test\"",
            "&test&",
            "'test'",
            "<test<",
            ">test>",
        ];


        $this->assertEquals(Request::post(0), 'zero');
        $this->assertEquals(Request::post(1), 'one');
        $this->assertEquals(Request::post(2), 'two');
        $this->assertEquals(Request::post(3), 'three');
        $this->assertEquals(Request::post(4), '&quot;test&quot;');
        $this->assertEquals(Request::post(5), '&amp;test&amp;');
//        $this->assertEquals(Request::post(6), '&amp;test&amp;');
        $this->assertEquals(Request::post(7), '&lt;test&lt;');
        $this->assertEquals(Request::post(8), '&gt;test&gt;');
    }

    /**
     * Testing Get
     *
     * @covers \Cryslo\Core\Request::get
     */
    public function testGet()
    {
        /**
         * Int Key
         */
        $_GET = [
            'zero',
            'one',
            'two',
            'three',
            "\"test\"",
            "&test&",
            "'test'",
            "<test<",
            ">test>",
        ];


        $this->assertEquals(Request::get(0), 'zero');
        $this->assertEquals(Request::get(1), 'one');
        $this->assertEquals(Request::get(2), 'two');
        $this->assertEquals(Request::get(3), 'three');
        $this->assertEquals(Request::get(4), '&quot;test&quot;');
        $this->assertEquals(Request::get(5), '&amp;test&amp;');
//        $this->assertEquals(Request::post(6), '&amp;test&amp;');
        $this->assertEquals(Request::get(7), '&lt;test&lt;');
        $this->assertEquals(Request::get(8), '&gt;test&gt;');
    }

    /**
     * @covers \Cryslo\Core\Request::isPost
     */
    public function testIsPost()
    {
        $this->assertEquals(false, Request::isPost());

        /**
         * Override SERVER var
         */
        $_SERVER['REQUEST_METHOD'] = "POST";
        $this->assertEquals(true, Request::isPost());
    }

    /**
     * @covers \Cryslo\Core\Request::isValidType
     */
    public function testIsValidType()
    {
        $this->assertEquals(true, Request::isValidType('GET'));
        $this->assertEquals(true, Request::isValidType('POST'));
        $this->assertEquals(true, Request::isValidType('PUT'));
        $this->assertEquals(false, Request::isValidType('ewdy'));
    }
}
