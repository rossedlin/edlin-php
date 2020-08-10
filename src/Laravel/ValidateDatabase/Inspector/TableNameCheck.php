<?php

namespace Edlin\Laravel\ValidateDatabase\Inspector;

use Edlin\Laravel\ValidateDatabase;

/**
 * @author  Ross Edlin <contact@rossedlin.com>
 * Date: 2020-08-10
 * Time: 14:36
 *
 * Class TableNameCheck
 * @package Edlin\Laravel\ValidateDatabase\Inspector
 */
class TableNameCheck
{
    /**
     * @param ValidateDatabase $validator
     */
    public static function run(ValidateDatabase $validator)
    {
        $databaseDecoded = $validator->getDatabaseDecoded();
        $jsonDecoded     = $validator->getJsonDecoded();

        /**
         * Check Json against Database
         */
        foreach ($jsonDecoded as $tableName => $tableStructure) {

            if (!isset($databaseDecoded[$tableName])) {
                $validator->addError("Expected table missing from Database: " . $tableName);
            }
        }

        /**
         * Check Database against Json
         */
        foreach ($databaseDecoded as $tableName => $tableStructure) {

            if (!isset($jsonDecoded[$tableName])) {
                $validator->addError("Table found but not in JSON: " . $tableName);
            }
        }
    }
}