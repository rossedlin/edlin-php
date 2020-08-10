<?php
/**
 * @author Ross Edlin <contact@rossedlin.com>
 * Date: 2020-08-10
 * Time: 14:36
 */

namespace Edlin\Laravel\ValidateDatabase\Inspector;


use Edlin\Laravel\ValidateDatabase;

class TableCount
{
    /**
     * @param ValidateDatabase $validator
     */
    public static function run(ValidateDatabase $validator)
    {
        if (count($validator->getDatabaseDecoded()) !== count($validator->getJsonDecoded())) {
            $validator->addError(
                "Table Count: Database(" . count($validator->getDatabaseDecoded()) . ") vs Json(" . count($validator->getJsonDecoded()) . ")"
            );
        }
    }
}