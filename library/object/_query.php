<?php
namespace Cryslo\Object;
/**
 * Created by PhpStorm.
 * User: rosse
 * Date: 25/12/2015
 * Time: 23:50
 */

class Query
{
    /** @var array */
    private $rows;

    /** @var int|bool */
    private $count = false;

    /**
     * Query constructor.
     * @param array $rows
     */
    public function __construct(array $rows = [])
    {
        $this->rows = $rows;
    }

    /**
     * @return array
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @param int $key
     * @return array
     */
    public function getRow($key = 0)
    {
        if (isset($this->rows[$key])) return $this->rows[$key];
        return [];
    }

    /**
     * @return int
     */
    public function getCount()
    {
        if ($this->count === false)
        {
            $this->count = count($this->rows);
        }

        return $this->count;
    }
}