<?php

namespace Cryslo\Core;

use Cryslo\Exceptions\CrysloException;

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
 * @package Cryslo\Core
 */
class Date
{
    /**
     * Returns the number of Years from a specific Time Stamp
     *
     * @param int $from
     * @param int $to
     * @return int
     *
     * @throws CrysloException
     */
    public static function getYearsFrom(int $from, int $to = null): int
    {
        if ($to === null) {
            $to = time();
        }

        $f = date("Y-m-d, H:i:s", $from);
        $t = date("Y-m-d, H:i:s", $to);

        if ($f > $t) {
            throw new CrysloException("From is greater than To");
        }

        $date     = new \DateTime($f);
        $today    = new \DateTime($t);
        $interval = $today->diff($date);
        return $interval->format('%y');
    }

    /**
     * @param int $today - Timestamp of today
     *
     * @return int
     *
     * @throws CrysloException
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
     * @param $timestamp
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
}
