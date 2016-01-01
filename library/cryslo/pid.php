<?php
namespace Cryslo;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 01/01/2016
 * Time: 14:57
 */

class Pid
{
    /**
     * @param $screen
     * @return bool
     */
    static public function isScreenOnline($screen)
    {
        if (self::retrieveScreenPid($screen))
        {
            return true;
        }

        return false;
    }

    /**
     * @param $screen
     * @return bool|int
     */
    static public function retrieveScreenPid($screen)
    {
        exec("pgrep -f -l \"".$screen."\"", $result);
        if (count($result) > 0)
        {
            if (is_array($result))
            {
                foreach($result as $r)
                {
                    $p = explode(" ", $r); //$p[0] == PID, $p[1] == type
                    if ("screen" == trim($p[1]))
                    {
                        return (int) trim($p[0]);
                    }
                }
            }
        }

        return false;
    }
}