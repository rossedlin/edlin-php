<?php

namespace Edlin\Laravel;

use Edlin\Enums\Cli;
use Edlin\Exceptions\EdlinException;
use Edlin\Laravel\ValidateDatabase\Inspector\Database;
use Edlin\Laravel\ValidateDatabase\Tables;
use Edlin\Laravel\ValidateDatabase\Migration;

/**
 * @author  Ross Edlin <contact@rossedlin.com>
 * Date: 2020-08-10
 * Time: 12:33
 *
 *          class DB extends \Illuminate\Support\Facades\DB {}
 *
 * Class ValidateDatabase
 * @package Edlin\Laravel
 */
class ValidateDatabase
{
    /**
     * Migration
     *
     * @var string $migrationName
     */
    private $migrationName;

    /**
     * Database
     *
     * @var array  $databaseTables
     * @var string $databaseStructure
     * @var array  $databaseDecoded
     */
    private $databaseTables;
    private $databaseStructure;
    private $databaseDecoded;

    /**
     * Json
     *
     * @var string $jsonDirectory
     * @var string $jsonFile
     * @var string $jsonContent
     * @var array  $jsonDecoded
     */
    private $jsonDirectory;
    private $jsonFile;
    private $jsonStructure;
    private $jsonDecoded;

    /**
     * @var array $errors
     */
    private $errors = [];

    /**
     * ValidateDatabase constructor.
     *
     * @param string $jsonDirectory
     *
     * @throws EdlinException
     */
    public function __construct(string $jsonDirectory = __DIR__ . '/../../../../../database/validations/')
    {
        /**
         * Pre Checks
         */
        if (!class_exists('DB')) {
            throw new EdlinException("Laravel DB Class does not exist");
        }

        /**
         * Migration
         */
        $this->migrationName = Migration::getCurrent();

        /**
         * Database
         */
        $this->databaseTables    = Tables::get();
        $this->databaseStructure = json_encode($this->databaseTables, JSON_PRETTY_PRINT);

        /**
         * Json
         */
        $this->jsonDirectory = $jsonDirectory;
        $this->jsonFile      = $this->jsonDirectory . $this->migrationName . '.json';

        if ($this->exists()) {
            $this->jsonStructure = file_get_contents($this->jsonFile);
        }
    }

    /**
     * @throws EdlinException
     */
    public function validate()
    {
        prt("Current Migration: " . $this->migrationName);

        if (!$this->exists()) {
            throw new EdlinException("Validation file missing: " . $this->migrationName);
        }

        /**
         * Validate
         */
        if ($this->databaseStructure === $this->jsonStructure) {
            return true;
        }

        /**
         * Inspect Database
         */
        /**
         * Examine Structure
         */
        $this->databaseDecoded = (array)json_decode($this->databaseStructure);
        $this->jsonDecoded     = (array)json_decode($this->jsonStructure);

        /**
         * Table Count
         */
        Database::count($this);

        foreach ($this->errors as $error) {
            prt($error, Cli::RED);
        }

        return false;
    }

    /**
     * @return bool
     * @throws EdlinException
     */
    public function makeValidator()
    {
        if (file_exists($this->jsonFile)) {
            throw new EdlinException("File already exists: " . $this->migrationName);
        }

        file_put_contents($this->jsonFile, $this->jsonStructure);

        if ($this->exists()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    private function exists()
    {
        if (file_exists($this->jsonFile)) {
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function getDatabaseDecoded(): array
    {
        return $this->databaseDecoded;
    }

    /**
     * @return array
     */
    public function getJsonDecoded(): array
    {
        return $this->jsonDecoded;
    }

    /**
     * @param string $message
     */
    public function addError(string $message)
    {
        $this->errors[]  = $message;
    }
}