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
    private $_rows;

    /** @var int|bool */
    private $_count = false;

    /**
     * Query constructor.
     * @param array $rows
     */
    public function __construct(array $rows = [])
    {
        $this->_rows = $rows;
    }

    /**
     * @return array
     */
    public function getRows()
    {
        return $this->_rows;
    }

    /**
     * @param int $key
     * @return array
     */
    public function getRow($key = 0)
    {
        if (isset($this->_rows[$key])) return $this->_rows[$key];
        return [];
    }

    /**
     * @return int
     */
    public function getCount()
    {
        if ($this->_count === false)
        {
            $this->_count = count($this->_rows);
        }

        return $this->_count;
    }
}