<?php
namespace Cryslo;

class Math
{
    /**
     * @param $a
     * @param $b
     * @return mixed
     */
	static public function Add($a, $b)
	{
		return $a+$b;
	}

    /**
     * @param $num int
     * @return bool
     */
    static public function IsEven($num)
    {
        if ($num % 2 == 0)
        {
            return true;
        }
        return false;
    }

    static public function IsOdd($num)
    {
        return !self::IsEven($num);
    }
}