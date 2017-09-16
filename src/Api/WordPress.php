<?php
namespace Cryslo\Api;

use Cryslo\Api;
use Cryslo\Core;
use Cryslo\Object;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 16/09/2017
 * Time: 21:34
 *
 * Class WordPress
 *
 * @package Cryslo\Feed
 */
class WordPress
{
	/**
	 * @var string $url
	 */
	private $url;

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return (string)$this->url;
	}

	/**
	 * @param string $url
	 */
	public function setUrl($url)
	{
		$this->url = (string)$url;
	}

	/**
	 * @return Object\WordPress\Posts
	 * @throws \Exception
	 */
	public function getFeed()
	{
		$obj = new Object\WordPress\Posts();
		$obj->setData(Core\Utils::xmlToArray(Api::query($this->getUrl())));

		return $obj;
	}
}