<?php
namespace Cryslo\Object\WordPress;

use Cryslo\Core\Consts;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 17/09/2017
 * Time: 16:35
 *
 * Class Channel
 *
 * @package Cryslo\Object\WordPress
 */
class Post
{
	/** @var int $id */
	private $id;

	/** @var string $slug */
	private $slug;

	/** @var string $date */
	private $date;

	/** @var string $status */
	private $status;

	/** @var string $title */
	private $title;

	/** @var string $excerpt */
	private $excerpt;

	/** @var string $content */
	private $content;

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
		$this->id = $id;
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
		$this->slug = $slug;
	}

	/**
	 * @return string
	 */
	public function getDate()
	{
		return $this->date;
	}

	/**
	 * @param string $format
	 *
	 * @return bool|string
	 */
	public function getDateFormatted($format = Consts::WORDPRESS_DATE_FORMAT)
	{
		return date($format, strtotime($this->getDate()));
	}

	/**
	 * @return string
	 */
	public function getYear()
	{
		return date('Y', strtotime($this->getDate()));
	}

	/**
	 * @param string $date
	 */
	public function setDate($date)
	{
		$this->date = $date;
	}

	/**
	 * @return string
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @param string $status
	 */
	public function setStatus($status)
	{
		$this->status = $status;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getExcerpt()
	{
		return $this->excerpt;
	}

	/**
	 * @param string $excerpt
	 */
	public function setExcerpt($excerpt)
	{
		$this->excerpt = $excerpt;
	}

	/**
	 * @return string
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * @param string $content
	 */
	public function setContent($content)
	{
		$this->content = $content;
	}
}