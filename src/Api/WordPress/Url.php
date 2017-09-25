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
	public static function getPostById($id)
	{
		return "/wp-json/wp/v2/posts/" . (int)$id;
	}

	/**
	 * @param string $slug
	 *
	 * @return string
	 */
	public static function getPostBySlug($slug)
	{
		return "/wp-json/wp/v2/posts?_embed&slug=" . (string)$slug;
	}

	/**
	 * @param array $args
	 *
	 * @return string
	 */
	public static function getPosts($args = [])
	{
		$per_page = (int)Request::getFromArray($args, 'per_page', 5);
		$_embed   = (bool)Request::getFromArray($args, '_embed', false);

		$return = "/wp-json/wp/v2/posts?per_page=" . $per_page;

		if ($_embed)
		{
			$return .= "&_embed";
		}

		return  $return;
	}
}