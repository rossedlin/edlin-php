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
	 * @param string $url
	 *
	 * @return Object\WordPress\Post
	 * @throws \Exception
	 */
	public static function getPost($url)
	{
		$post = new Object\WordPress\Post();
		$json = Api::query((string)$url);

		//todo - json schema validation

		/** @var \stdClass $obj */
		$array = json_decode($json);

		foreach ($array as $obj)
		{
			$post->setId($obj->id);
			$post->setSlug($obj->slug);
			$post->setDate($obj->date);
			$post->setStatus($obj->status);
			$post->setTitle($obj->title->rendered);
			$post->setContent($obj->content->rendered);
			$post->setExcerpt($obj->excerpt->rendered);
			break;
		}

		return $post;
	}
}