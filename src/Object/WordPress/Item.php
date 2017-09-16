<?php
namespace Cryslo\Object\WordPress;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 16/09/2017
 * Time: 22:17
 *
 * Class Item
 *
 * @package Cryslo\Object\WordPress
 */
class Item
{
	/**
	 * @var array $data
	 */
	private $data = false;

	/**
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @param array $data
	 */
	public function setData(array $data)
	{
		$this->data = $data;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return (string)$this->data['title'];
	}
}