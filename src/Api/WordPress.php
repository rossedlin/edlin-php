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

			foreach ($obj->_embedded as $_embedded)
			{
				foreach ($_embedded as $image)
				{
					if (isset($image->media_type) && $image->media_type == 'image' && isset($image->media_details->sizes))
					{
						/**
						 * @var \stdClass $sizes
						 */
						$sizes = $image->media_details->sizes;

						$featuredMedia = [];

						/**
						 * Thumbnail
						 */
						if (isset($sizes->thumbnail->source_url))
							$featuredMedia[$post::SIZE_THUMBNAIL] = $sizes->thumbnail->source_url;

						/**
						 * Original
						 */
						if (isset($sizes->full->source_url))
							$featuredMedia[$post::SIZE_ORIGINAL] = $sizes->full->source_url;

						$post->setFeaturedMedia($featuredMedia);
					}
				}
			}
			break;
		}

		return $post;
	}

	/**
	 * @param string $url
	 *
	 * @return Object\WordPress\Post
	 * @throws \Exception
	 */
	public static function getPosts($url)
	{
		$json = Api::query((string)$url);

		//todo - json schema validation

		/** @var \stdClass $obj */
		$array = json_decode($json);

		$posts = [];
		foreach ($array as $obj)
		{
			$post = new Object\WordPress\Post();
			$post->setId($obj->id);
			$post->setSlug($obj->slug);
			$post->setDate($obj->date);
			$post->setStatus($obj->status);
			$post->setTitle($obj->title->rendered);
			$post->setContent($obj->content->rendered);
			$post->setExcerpt($obj->excerpt->rendered);

			$posts[] = $post;
		}

		return $posts;
	}
}