<?php

namespace Cryslo\Tests\Core;

use Cryslo\Core\Date;
use Cryslo\Exceptions\CrysloException;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 *
 * User: rossedlin
 * Contact: <contact@rossedlin.com>
 *
 * Date: 31/05/18
 * Time: 10:46
 */
final class DateTest extends TestCase
{
    /**
     * Testing Adding Numbers
     *
     * @throws CrysloException
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
        $this->assertEquals(29, Date::getYearsFrom(strtotime("2001-01-01"), strtotime("1999-02-01")));
    }

    /**
     * @throws CrysloException
     */
    public function testGetYesterday()
    {
        $this->assertEquals(1527638400, Date::getYesterday(1527724800)); //2018-05-31 00:00:00
        $this->assertEquals(1527638400, Date::getYesterday(1527724801)); //2018-05-31 00:00:01
        $this->assertEquals(1527638400, Date::getYesterday(1527768000)); //2018-05-31 12:00:00
        $this->assertEquals(1527638400, Date::getYesterday(1527811199)); //2018-05-31 23:59:59
    }
}
