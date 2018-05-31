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
    public function testYearsFrom()
    {
        /**
         * Full Dates
         */
        $this->assertEquals(0, Date::yearsFrom(strtotime("2018-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(1, Date::yearsFrom(strtotime("2017-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(2, Date::yearsFrom(strtotime("2016-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(3, Date::yearsFrom(strtotime("2015-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(6, Date::yearsFrom(strtotime("2012-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(17, Date::yearsFrom(strtotime("2001-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(18, Date::yearsFrom(strtotime("2000-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(19, Date::yearsFrom(strtotime("1999-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(48, Date::yearsFrom(strtotime("1970-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(218, Date::yearsFrom(strtotime("1800-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(1518, Date::yearsFrom(strtotime("500-01-01"), strtotime("2018-02-01")));
        $this->assertEquals(2018, Date::yearsFrom(strtotime("0000-01-01"), strtotime("2018-02-01")));

        /**
         * Partial Dates
         */
        $this->assertEquals(18, Date::yearsFrom(strtotime("00-01-01"), strtotime("2018-02-01")));

        /**
         * Older Full Dates
         */
        $this->assertEquals(29, Date::yearsFrom(strtotime("1970-01-01"), strtotime("1999-02-01")));
        $this->assertEquals(29, Date::yearsFrom(strtotime("2001-01-01"), strtotime("1999-02-01")));
    }
}
