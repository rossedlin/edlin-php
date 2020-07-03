<?php

namespace Edlin\Tests;

use Edlin\Date;
use Edlin\Exceptions\EdlinException;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 31/05/18
 * Time: 10:46
 *
 * Class DateTest
 * @package Edlin\Tests\Core
 * @covers  \Edlin\Date
 */
final class DateTest extends TestCase
{
    /**
     * Testing Adding Numbers
     *
     * @covers \Edlin\Date::getYearsFrom
     *
     * @throws EdlinException
     */
    public function testGetYearsFrom()
    {
        /**
         * Full Dates
         */
        $this->assertEquals(0, Date::getYearsFrom(strtotime("2018-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(1, Date::getYearsFrom(strtotime("2017-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(2, Date::getYearsFrom(strtotime("2016-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(3, Date::getYearsFrom(strtotime("2015-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(6, Date::getYearsFrom(strtotime("2012-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(17, Date::getYearsFrom(strtotime("2001-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(18, Date::getYearsFrom(strtotime("2000-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(19, Date::getYearsFrom(strtotime("1999-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(48, Date::getYearsFrom(strtotime("1970-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(218, Date::getYearsFrom(strtotime("1800-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(1518, Date::getYearsFrom(strtotime("500-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(2018, Date::getYearsFrom(strtotime("0000-01-01"), strtotime("2018-02-01")));

        /**
         * Partial Dates
         */
        $this->assertEquals(18, Date::getYearsFrom(strtotime("00-01-01"), strtotime("2018-02-01")));

        /**
         * Older Full Dates
         */
        $this->assertEquals(29, Date::getYearsFrom(strtotime("1970-01-01"), strtotime("1999-02-01")));

        /**
         * Test time()
         *
         * 1514764800 = 2018-01-01 00:00:00
         */
        $time = time();
        $diff = $time - 1514764800;

        $this->assertEquals(2, Date::getYearsFrom((strtotime("2016-01-01") + $diff)));
        $this->assertEquals(8, Date::getYearsFrom((strtotime("2010-01-01") + $diff)));

        /**
         * Test Exception
         */
        try {
            $this->assertEquals(9999999, Date::getYearsFrom(strtotime("2010-01-01"), strtotime("2000-01-01")));
        } catch (EdlinException $e) {
            $this->assertTrue(true);
        }
    }

    /**
     * \Edlin\Core\Date::getYesterday
     *
     * @throws EdlinException
     */
    public function testGetYesterday()
    {
        $this->assertEquals(1527638400, Date::getYesterday(1527724800)); //2018-05-31 00:00:00
        $this->assertEquals(1527638400, Date::getYesterday(1527724801)); //2018-05-31 00:00:01
        $this->assertEquals(1527638400, Date::getYesterday(1527768000)); //2018-05-31 12:00:00
        $this->assertEquals(1527638400, Date::getYesterday(1527811199)); //2018-05-31 23:59:59

        /**
         * Test time()
         *
         * 1527724800 = 2018-05-31 00:00:00
         */
        $time = time();
        $diff = $time - 1527724800;
        $days = floor($diff / 86400);

        $this->assertEquals((1527724800 + (86400 * ($days - 1))), Date::getYesterday());
    }

    /**
     * @covers \Edlin\Date::isValidTimeStamp
     */
    public function testIsValidTimeStamp()
    {
        $this->assertTrue(Date::isValidTimeStamp(1527811199));
        $this->assertFalse(Date::isValidTimeStamp(-1));
    }
}
