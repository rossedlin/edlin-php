<?php
namespace Cryslo\Api\WordPress;

use Cryslo\Core\Request;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 17/09/2017
 * Time: 15:24
 *
 * Class Url
 *
 * @package Cryslo\Api\WordPress
 */
class Url
{
	/**
	 * @param int $id
	 *
	 * @return string
	 */
	public static function getPostsById($id)
	{
		return "/wp-json/wp/v2/posts/" . (int)$id;
	}

	/**
	 * @param string $slug
	 *
	 * @return string
	 */
	public static function getPostsBySlug($slug)
	{
		return "/wp-json/wp/v2/posts?slug=" . (string)$slug;
	}

	/**
	 * @param array $args
	 *
	 * @return string
	 */
	public static function getLatestPosts($args = [])
	{
		$per_page = (int)Request::getFromArray($args, 'per_page', 5);

		return "/wp-json/wp/v2/posts?per_page=" . $per_page; //&tags=3
	}
}