<?php

namespace Edlin\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author Ross Edlin <contact@rossedlin.com>
 *
 * Date: 01/06/18
 * Time: 12:03
 */
class HelpersTest extends TestCase
{
    /**
     *
     */
    public function testPre()
    {
        $a = [
            "<pre>TRUE (boolean)</pre>"  => true,
            "<pre>FALSE (boolean)</pre>" => false,
            "<pre>NULL</pre>"            => null,
            "<pre>Hello</pre>"           => 'Hello',
        ];

        foreach ($a as $expected => $actual) {
            ob_start();
            pre($actual);
            $contents = ob_get_contents();
            ob_end_clean();

            $this->assertEquals($expected, $contents);
        }
    }

    /**
     *
     */
    public function testPrt()
    {
        $array
            = "Array
(
    [0] => one
    [1] => two
    [2] => 1
    [3] => 
    [4] => Array
        (
            [0] => abc
        )

)\n";

        $stdClassActual        = new \stdClass();
        $stdClassActual->one   = "one";
        $stdClassActual->two   = "two";
        $stdClassActual->obj   = new \stdClass();
        $stdClassActual->array = [0 => "abc"];

        $stdClassExpected
            = "stdClass Object
(
    [one] => one
    [two] => two
    [obj] => stdClass Object
        (
        )

    [array] => Array
        (
            [0] => abc
        )

)\n";

        $a = [
            "\e[0;32mTRUE (boolean)\e[0m\n"            => true,
            "\e[0;31mFALSE (boolean)\e[0m\n"           => false,
            "\e[0;31mNULL\e[0m\n"                      => null,
            "\e[0;34m" . $array . "\e[0m\n"            => ['one', 'two', true, false, [0 => 'abc']],
            "\e[0;34m" . $stdClassExpected . "\e[0m\n" => $stdClassActual,
            "\e[0;34mHello World\e[0m\n"               => "Hello World",
        ];

        foreach ($a as $expected => $actual) {
            ob_start();
            prt($actual);
            $contents = ob_get_contents();
            ob_end_clean();

            $this->assertEquals($expected, $contents);
        }
    }
}
