<?php

namespace Edlin\Laravel\ValidateDatabase\Inspector;


use Edlin\Enums\Cli;
use Edlin\Laravel\ValidateDatabase;

/**
 * @author  Ross Edlin <contact@rossedlin.com>
 * Date: 2020-08-10
 * Time: 15:04
 *
 * Class TableIntegrity
 * @package Edlin\Laravel\ValidateDatabase\Inspector
 */
class TableIntegrity
{
    /**
     * @param ValidateDatabase $validator
     */
    public static function run(ValidateDatabase $validator)
    {
        $databaseDecoded = $validator->getDatabaseDecoded();
        $jsonDecoded     = $validator->getJsonDecoded();

        /**
         * Check Each Table
         */
        foreach ($databaseDecoded as $tableName => $tableStructure) {

            try {
                /**
                 * Overview check of table
                 */
                if (isset($jsonDecoded[$tableName]) && $tableStructure != $jsonDecoded[$tableName]) {

                    $jsonStructure = $jsonDecoded[$tableName];

                    $validator->addError("Table integrity check failed for: " . $tableName);

                    /**
                     * Detailed check of table
                     */
                    $validator->addErrorIfString(self::checkStandardClass($jsonStructure, $tableStructure));
                    $validator->addErrorIfString(self::checkColumnsIsSet($jsonStructure, $tableStructure));
                    $validator->addErrorIfString(self::checkColumnsCount($jsonStructure, $tableStructure));

                    /**
                     * Detailed check of columns
                     */
                    foreach ($jsonStructure->columns as $jsonKey => $jsonColumn) {
                        $validator->addErrorIfString(
                            self::checkColumnDetails($jsonColumn, $tableStructure->columns[$jsonKey])
                        );
                    }
                }
            } catch (\Throwable $e) {
                prt($tableName, Cli::RED);
                prt($e->getMessage(), Cli::BOLD_RED);
            }
        }
    }

    /**
     * @param $jsonStructure
     * @param $tableStructure
     *
     * @return bool|string
     */
    private static function checkStandardClass($jsonStructure, $tableStructure)
    {
        if (!$jsonStructure instanceof \stdClass) {
            return "Json Structure NOT Standard Class";
        }

        if (!$tableStructure instanceof \stdClass) {
            return "Table Structure NOT Standard Class";
        }

        return true;
    }

    /**
     * @param $jsonStructure
     * @param $tableStructure
     *
     * @return bool|string
     */
    private static function checkColumnsIsSet($jsonStructure, $tableStructure)
    {
        if (!isset($jsonStructure->columns)) {
            return "Json Structure: Columns NOT Set";
        }

        if (!isset($tableStructure->columns)) {
            return "Table Structure: Columns NOT Set";
        }

        return true;
    }

    /**
     * @param $jsonStructure
     * @param $tableStructure
     *
     * @return bool|string
     */
    private static function checkColumnsCount($jsonStructure, $tableStructure)
    {
        if (count($jsonStructure->columns) !== count($tableStructure->columns)) {
            return "Count mismatch: JSON(" . count($jsonStructure->columns) . ") vs Table(" . count($tableStructure->columns) . ")";
        }

        return true;
    }

    /**
     * @param $jsonColumn
     * @param $tableColumn
     *
     * @return bool|string
     */
    private static function checkColumnDetails($jsonColumn, $tableColumn)
    {
        if ($jsonColumn != $tableColumn) {
            return "*** Column mismatch ***\n"
                   . json_encode($jsonColumn, JSON_PRETTY_PRINT)
                   . json_encode($tableColumn, JSON_PRETTY_PRINT);
        }

        return true;
    }
}