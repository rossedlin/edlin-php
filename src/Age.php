<?php

namespace Edlin;

use DateTime;

class Age
{
    /**
     * @param string $date
     *
     * @return int
     */
    public static function howOld(string $dateDate, $currentTimestamp = null): int
    {
        $birthTimestamp   = strtotime($dateDate);
        if (!$currentTimestamp) {
            $currentTimestamp = time();
        }

        $age = date('Y', $currentTimestamp) - date('Y', $birthTimestamp);
        if (date('md', $currentTimestamp) < date('md', $birthTimestamp)) {
            $age--;
        }

        return $age;
    }
}
