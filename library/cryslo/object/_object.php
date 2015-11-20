<?php
namespace Cryslo\Object;
use Cryslo;
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 30/09/2015
 * Time: 20:50
 */

abstract class _Object
{
    /**
     * @param $data
     */
    public function __construct($data = false)
    {
        if (is_array($data))
        {
            $this->load($data);
        }

        $this->init();
    }

    /**
     * @return null
     */
    abstract public function init();

    /**
     * @param array $data
     * @return bool
     */
    abstract public function load(array $data);
}