<?php

namespace Edlin\Tests\Core;

use PHPUnit\Framework\TestCase;
use Edlin\Core\Utils;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 23/02/2017
 * Time: 09:58
 *
 * Class UtilsTest
 * @package Edlin\Tests\Core
 * @covers  \Edlin\Core\Utils
 */
final class UtilsTest extends TestCase
{
    /**
     * @covers \Edlin\Core\Utils::convertToArrayFromStdClass
     */
    public function testConvertToArrayFromStdClass()
    {
        /**
         * Empty array
         */
        $this->assertEquals([], Utils::convertToArrayFromStdClass(new \stdClass()));

        /**
         * one
         */
        $std      = new \stdClass();
        $std->one = "abc";

        $this->assertEquals(['one' => 'abc'], Utils::convertToArrayFromStdClass($std));

        /**
         * two
         */
        $std           = new \stdClass();
        $std->one      = "abc";
        $std->two      = new \stdClass();
        $std->two->abc = 'efg';

        $this->assertEquals(['one' => 'abc', 'two' => ['abc' => 'efg']], Utils::convertToArrayFromStdClass($std));
    }

    /**
     * @covers \Edlin\Core\Utils::snakeCaseToCamelCase
     */
    public function testSnakeCaseToPascalCase()
    {
        $this->assertEquals(
            "HelloWorldOneTwoThree",
            Utils::snakeCaseToPascalCase("hello_world_one_two_three")
        );
    }

    /**
     * @covers \Edlin\Core\Utils::snakeCaseToCamelCase
     */
    public function testSnakeCaseToCamelCase()
    {
        $this->assertEquals(
            "helloWorldOneTwoThree",
            Utils::snakeCaseToCamelCase("hello_world_one_two_three")
        );
    }
}
