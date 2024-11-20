<?php

namespace Edlin\Tests;

use Edlin\Age;
use Edlin\Date;
use PHPUnit\Framework\TestCase;

final class AgeTest extends TestCase
{
    /**
     *
     */
    public function testHowOld()
    {
        /**
         * 2024
         */
        $this->assertEquals(33, Age::howOld('1991-01-12', strtotime('2024-11-20')));
        $this->assertEquals(34, Age::howOld('1990-09-06', strtotime('2024-11-20')));
        $this->assertEquals(24, Age::howOld('2000-04-06', strtotime('2024-11-20')));
        $this->assertEquals(13, Age::howOld('2011-02-21', strtotime('2024-11-20')));
        $this->assertEquals(93, Age::howOld('1931-02-11', strtotime('2024-11-20')));

        /**
         * 2025
         */
        $this->assertEquals(34, Age::howOld('1991-01-12', strtotime('2025-11-20')));
        $this->assertEquals(35, Age::howOld('1990-09-06', strtotime('2025-11-20')));
        $this->assertEquals(25, Age::howOld('2000-04-06', strtotime('2025-11-20')));
        $this->assertEquals(14, Age::howOld('2011-02-21', strtotime('2025-11-20')));
        $this->assertEquals(94, Age::howOld('1931-02-11', strtotime('2025-11-20')));
    }
}
