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
    public static function yearsFrom(int $from, int $to = null): int
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
}
