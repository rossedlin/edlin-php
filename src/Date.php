<?php

namespace Edlin;

use Edlin\Exceptions\EdlinException;
use Exception;

/**
 * Created by PhpStorm.
 *
 * User: rossedlin
 * Contact: <contact@rossedlin.com>
 *
 * Date: 31/05/18
 * Time: 10:45
 *
 * Class Date
 * @package Edlin\Core
 */
class Date
{
    /**
     * Returns the number of Years from a specific Time Stamp
     *
     * @param int      $from
     * @param int|null $to
     *
     * @return int
     *
     * @throws EdlinException
     * @throws Exception
     */
    public static function getYearsFrom(int $from, int $to = null): int
    {
        if ($to === null) {
            $to = time();
        }

        $f = date("Y-m-d, H:i:s", $from);
        $t = date("Y-m-d, H:i:s", $to);

        if ($f > $t) {
            throw new EdlinException("From is greater than To");
        }

        $date     = new \DateTime($f);
        $today    = new \DateTime($t);
        $interval = $today->diff($date);
        return $interval->format('%y');
    }

    /**
     * @param int|null $today - Timestamp of today
     *
     * @return int
     *
     */
    public static function getYesterday(int $today = null): int
    {
        if ($today === null) {
            $today = time();
        }

        $t = date("Y-m-d", $today);
        $y = date('Y-m-d', strtotime($t . "-1 days"));

        return strtotime($y);
    }

    /**
     * @param int $timestamp
     *
     * @return bool
     */
    public static function isValidTimeStamp(int $timestamp): bool
    {
        if ($timestamp >= 0 && $timestamp <= PHP_INT_MAX) {
            return true;
        }

        return false;
    }

    /**
     * @param string $date
     *
     * @return bool
     */
    public static function isValidYYYYMMDD(string $date): bool
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            return true;
        }

        return false;
    }
}
