<?php
namespace Cryslo\Object\WordPress;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 25/09/2017
 * Time: 18:46
 *
 * Class Author
 *
 * @package Cryslo\Object\WordPress
 */
class Author
{
	/** @var int $id */
	private $id;

	/** @var string $name */
	private $displayName = "";

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = (int)$id;
	}

	/**
	 * @return string
	 */
	public function getDisplayName()
	{
		return $this->displayName;
	}

	/**
	 * @param string $displayName
	 */
	public function setDisplayName($displayName)
	{
		$this->displayName = $displayName;
	}
}