<?php

namespace Edlin\Tests;

use Edlin\Arr;
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
 * @package Edlin\Tests\Core
 * @covers  \Edlin\Arr
 */
final class ArrTest extends TestCase
{
    /**
     * @covers \Edlin\Arr::keyBy
     */
    public function testKeyBy()
    {
        $this->assertEquals(
            [
                'one'   => ['code' => 'one'],
                'two'   => ['code' => 'two'],
                'three' => ['code' => 'three'],
                'four'  => ['code' => 'four'],
                'five'  => ['code' => 'five'],
            ],
            Arr::keyBy([
                ['code' => 'one'],
                ['code' => 'two'],
                ['code' => 'three'],
                ['code' => 'four'],
                ['code' => 'five'],
            ], 'code')
        );
    }

    /**
     * @covers \Edlin\Arr::compare
     */
    public function testCompare()
    {
        $a = [
            0       => 1234,
            1       => 'gwebewbew',
            ['code' => ['code' => ['code' => ['code' => 'fail']]]],
            'one'   => ['code' => ['code' => ['code' => ['code' => 'success']]]],
            'two'   => ['code' => ['code' => ['code' => ['code1' => 'fail']]]],
            'three' => ['code' => ['code' => ['code' => ['code' => 'one']]]],
            'four'  => ['code' => ['code' => ['code' => ['code' => 'one']]]],
            7       => ['code' => ['code' => [9 => ['code' => 'one']]]],
            8       => ['code' => ['code' => [9 => ['code' => 'one']]]],
            9       => ['code' => ['code' => [9 => ['code' => 'one']]]],
            99      => ['code' => ['code' => [9 => ['code' => 'one']]]],
        ];

        $b = [
            0       => 12345,
            1       => 'gwebewbew1',
            ['code' => ['code' => ['code' => ['code' => 'fail1']]]],
            'one'   => ['code' => ['code' => ['code' => ['code' => 'success']]]],
            'two'   => ['code' => ['code' => ['code' => ['code' => 'fail']]]],
            'three' => ['code' => ['code' => ['code' => ['code' => 'one']]]],
            'four'  => ['code' => ['code' => ['code' => ['code' => 'one']]]],
            7       => ['code' => []],
            8       => ['code' => ['code' => [9 => ['code' => 'one2']]]],
            9       => ['code' => ['code' => [9 => ['code' => 'one']]]],
            99      => ['code' => ['code' => [9 => ['code' => 'one3']]]],
        ];

        $diff = [
            0     => 1234,
            1     => 'gwebewbew',
            ['code' => ['code' => ['code' => ['code' => 'fail']]]],
            'two' => ['code' => ['code' => ['code' => ['code1' => null]]]],
            7     => ['code' => ['code' => null]],
            8     => ['code' => ['code' => [9 => ['code' => 'one']]]],
            99    => ['code' => ['code' => [9 => ['code' => 'one']]]],
        ];

        $this->assertEquals($diff, Arr::compare($a, $b));
    }
}
