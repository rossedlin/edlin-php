<?php

namespace Edlin\Laravel\ValidateDatabase;

/**
 * @author  Ross Edlin <contact@rossedlin.com>
 * Date: 2020-08-10
 * Time: 12:57
 *
 * Class Migration
 * @package Edlin\Laravel\ValidateDatabase
 */
class Migration
{
    public static function getCurrent(): string
    {
        $migrations = \DB::select(\DB::raw('SELECT * FROM migrations ORDER BY migration DESC;'));

        return $migrations[0]->migration;
    }
}