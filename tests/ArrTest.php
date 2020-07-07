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
}
