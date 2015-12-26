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
     * _Object constructor.
     * @param bool $source
     */
    public function __construct($source = false)
    {
        if ($source === false)
        {
            $this->defaultObject();
        }
        elseif (is_int($source))
        {
            //$this->retrieve($source);
        }
        elseif (is_array($source))
        {
            $this->setFromData($source);
        }

        $this->init();
    }

    /**
     * @return null
     */
    abstract public function init();

    /**
     * @return mixed
     */
    abstract public function defaultObject();

    /**
     * @param $source
     */
    abstract public function setFromData($source);

    /**
     * @return array
     */
    abstract public function getAsArray();
}