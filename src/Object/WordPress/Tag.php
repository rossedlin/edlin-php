<?php
namespace Cryslo\Object\WordPress;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 25/09/2017
 * Time: 17:09
 *
 * Class Tag
 *
 * @package Cryslo\Object\WordPress
 */
class Tag
{
	/** @var int $id */
	private $id;

	/** @var string $slug */
	private $slug = "";

	/** @var string $name */
	private $name = "";

	/** @var string $name */
	private $cssClass = "";

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
	public function getSlug()
	{
		return $this->slug;
	}

	/**
	 * @param string $slug
	 */
	public function setSlug($slug)
	{
		$this->slug = (string)$slug;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = (string)$name;
	}

	/**
	 * @return string
	 */
	public function getCssClass()
	{
		return $this->cssClass;
	}

	/**
	 * @param string $cssClass
	 */
	public function setCssClass($cssClass)
	{
		$this->cssClass = (string)$cssClass;
	}
}