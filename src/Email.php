<?php
namespace Cryslo\Core;

use \Cryslo\Core\Log;
use \Cryslo\Core\View;
use \TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 16/02/2017
 * Time: 10:35
 */
class Email
{
	const DATE = 'D, d M Y H:i:s O';

	/**
	 * Content Types
	 */
	const CONTENT_TYPE_HTML = 'text/html';

	/**
	 * @param array  $to
	 * @param array  $from
	 * @param string $subject - Subject must satisfy » RFC 2047.
	 * @param string $message
	 * @param string $contentType
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public static function send(array $to, array $from, $subject, $message, $contentType = self::CONTENT_TYPE_HTML)
	{
		/*
		//SMTP Transport Type
		$transport = \Swift_SmtpTransport::newInstance('smtp.example.org', 25);
		$transport->setUsername('your username');
		$transport->setPassword('your password');

		//Sendmail
		$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');

		//Mail
		$transport = Swift_MailTransport::newInstance();
		*/

		$transport = \Swift_SmtpTransport::newInstance('aspmx.l.google.com', 25);

		// Create the Mailer using your created Transport
		$mailer = \Swift_Mailer::newInstance($transport);

		/**
		 * Create a message
		 *
		 * @var \Swift_Mime_Message $message
		 */
		$message = \Swift_Message::newInstance()
			->setTo($to)
			->setFrom($from)
			->setSubject($subject)
			->setContentType($contentType)
			->setBody($message);

		try
		{
			/**
			 * Send the message
			 *
			 * @var int $result - The number of successful recipients. Can be 0 which indicates failure
			 */
			$result = $mailer->send($message);

			if ($result)
			{
				return true;
			}
		}
		catch (\Exception $e)
		{
			Log::write($e);
			throw $e;
		}

		return false;
	}

	/**
	 * @param string $file
	 * @param array  $data
	 *
	 * @return string
	 */
	public static function getTemplate($file = '', array $data = [])
	{
		$data = array_merge([
			'title'     => 'Cryslo',
			'logo_href' => 'https://cfmedia.deadline.com/2016/07/logo-tv-logo.png',
			'logo_width' => '100',
			'logo_alt'  => 'Cryslo Logo',
			'content'   => 'Hello World',
			'year'      => date('Y'),
		], $data);

		/**
		 * Html
		 */
		if (trim($file) !== '' && View::htmlExists($file))
		{
			$html = View::getHtml('Email/' . $file, $data);
		}
		else
		{
			$html = View::getHtml('Email/Default', $data);
		}

		/**
		 * Css
		 */
		if (trim($file) !== '' && View::cssExists($file))
		{
			$css = View::getCss('Email/' . $file, $data);
		}
		else
		{
			$css = View::getCss('Email/Default', $data);
		}

		/**
		 * Convert the Css to Inline
		 */
		$cssToInlineStyles = new CssToInlineStyles();

		return $cssToInlineStyles->convert(
			$html,
			$css
		);
	}
}