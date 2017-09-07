<?php
namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 12/02/2016
 * Time: 16:31
 */
class Mail
{
	/**
	 * @param $from
	 * @param $cc
	 *
	 * @return string
	 */
	private static function _buildTextHeaders($from, $cc)
	{
		$headers   = [];
		$headers[] = "From: " . $from;
		if ($cc) $headers[] = "CC: " . $cc;

		return implode(Consts::CRLF, $headers);
	}

	/**
	 * @param $args
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public static function send($args)
	{
		$to      = Request::getFromArray($args, 'to', false);
		$cc      = Request::getFromArray($args, 'cc', false);
		$from    = Request::getFromArray($args, 'from', 'noreply@cryslo.com');
//		$sender  = Request::getFromArray($args, 'sender', false);
		$subject = Request::getFromArray($args, 'subject', false);
		$text    = Request::getFromArray($args, 'text', false);
//        $html       = Request::getFromArray($args, 'html', false);

		if (is_array($to)) $to = implode(',', $to);


		try
		{
			mail($to, $subject, $text, self::_buildTextHeaders($from, $cc));
			return true;
		}
		catch (\Exception $e)
		{
			throw $e;
		}
	}
}