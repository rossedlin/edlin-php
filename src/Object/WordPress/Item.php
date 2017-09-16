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

	/**
	 * @return string
	 */
	public function getLink()
	{
		return (string)$this->data['link'];
	}

	/**
	 * @param $link
	 */
	public function setLink($link)
	{
		$this->data['link'] = (string)$link;
	}

	/**
	 * @return string
	 */
	public function getPublishDate()
	{
		return (string)$this->data['pubDate'];
	}

	/**
	 * @param $date
	 */
	public function setPublishDate($date)
	{
		$this->data['pubDate'] = (string)$date;
	}
}