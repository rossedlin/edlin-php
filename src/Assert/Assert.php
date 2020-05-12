<?php

namespace Edlin\Assert;

/**
 * Created by PhpStorm.
 *
 * @author Ross Edlin <contact@rossedlin.com>
 *
 * Date: 11/06/18
 * Time: 14:34
 */

class Assert
{
    /**
     * @param $array
     * @return ValidateArray
     */
    public static function validateArray($array)
    {
        return new ValidateArray($array);
    }
}
