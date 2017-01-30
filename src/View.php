<?php
namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 30/01/2017
 * Time: 15:45
 *
 * Class View
 * @package Cryslo\Core
 */
class View
{
	/**
	 * @param $file
	 * @param $args
	 *
	 * @return string
	 */
	public static function render($file, $args = [])
	{
		$file = __DIR__ . '/../view/' . $file . '.html';

		if (file_exists($file))
		{
			ob_start();
			require($file);
			$contents = ob_get_contents();

			foreach ($args as $key => $arg)
			{
				$contents = str_replace('{{' . $key . '}}', $arg, $contents);
			}

			ob_end_clean();

			return $contents;
		}

		return "";
	}
}