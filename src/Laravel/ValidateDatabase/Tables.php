<?php

namespace Edlin\Laravel\ValidateDatabase;

use Edlin\Enums\Cli;

/**
 * @author  Ross Edlin <contact@rossedlin.com>
 * Date: 2020-08-10
 * Time: 12:53
 *
 * Class Database
 * @package Edlin\Laravel\ValidateDatabase
 */
class Tables
{
    /**
     * @return array
     */
    public static function get()
    {
        $return    = [];
        $rawTables = \DB::select(\DB::raw('SHOW TABLES;'));

        /**
         * Build Structure
         */
        foreach ($rawTables as $rawTable) {
            foreach ($rawTable as $rawTableName) {
//                prt($rawTableName);

                $rawDescribe = \DB::select(\DB::raw('DESCRIBE ' . $rawTableName . ';'));
//                prt($rawDescribe);

                $compiledTable = [
                    'columns' => $rawDescribe,
                ];

                $return[$rawTableName] = $compiledTable;
            }
        }

        return $return;
    }
}