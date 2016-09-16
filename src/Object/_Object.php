<?php
namespace Cryslo\Core\Object;

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
	 *
	 * @param bool $source
	 */
	public function __construct($source = false)
	{
		$this->init();

		if ((is_int($source)) && (method_exists($this, 'retrieve')))
		{
			$this->retrieve($source);
		}
		elseif (is_array($source))
		{
			$this->setFromData($source);
		}
	}

	/**
	 * @return null
	 */
	abstract public function init();

	/**
	 * @return mixed
	 */
//    abstract public function defaultObject();

	/**
	 * @param $source
	 */
	abstract public function setFromData($source);

	/**
	 * @return array
	 */
	abstract public function getAsArray();
}