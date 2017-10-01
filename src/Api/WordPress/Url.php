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
	 * @param array  $args
	 *
	 * @return string
	 */
	public static function getPostBySlug($slug, $args = [])
	{
		$return = "/wp-json/wp/v2/posts?";

		/**
		 * Embed
		 */
		$_embed = (bool)Request::getFromArray($args, '_embed', false);
		if ($_embed)
		{
			$return .= "_embed&";
		}

		return $return . "slug=" . (string)$slug;
	}

	/**
	 * @param array $args
	 *
	 * @return string
	 */
	public static function getPosts($args = [])
	{
		$return = "/wp-json/wp/v2/posts?";

		/**
		 * Embed
		 */
		$_embed   = (bool)Request::getFromArray($args, '_embed', false);
		if ($_embed)
		{
			$return .= "_embed&";
		}

		/**
		 * Per Page
		 */
		$per_page = (int)Request::getFromArray($args, 'per_page', 5);
		if ($per_page)
		{
			$return .= "per_page=" . $per_page;
		}

		return $return;
	}

	/**
	 * @param int $id
	 *
	 * @return string
	 */
	public static function getTag($id)
	{
		return "/wp-json/wp/v2/tags/" . (int)$id;
	}

	/**
	 * @param array $args
	 *
	 * @return string
	 */
	public static function getTags($args = [])
	{
		return "/wp-json/wp/v2/tags";
	}

	/**
	 * @param int $id
	 *
	 * @return string
	 */
	public static function getUser($id)
	{
		return "/wp-json/wp/v2/users/" . (int)$id;
	}
}