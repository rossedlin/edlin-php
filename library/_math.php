<?php
namespace Cryslo;

class Math
{
    /**
     * @param $a
     * @param $b
     * @return mixed
     */
	static public function add($a, $b)
	{
		return $a+$b;
	}

    /**
     * @param $num int
     * @return bool
     */
    static public function isEven($num)
    {
        if ($num % 2 == 0)
        {
            return true;
        }
        return false;
    }

    static public function isOdd($num)
    {
        return !self::isEven($num);
    }
}