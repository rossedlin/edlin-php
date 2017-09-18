<?php
namespace Cryslo\Core;

use \Cryslo\Object;
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
	 * @param Object\Email $email
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public static function send(Object\Email $email)
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

		/**
		 * @var \Swift_SmtpTransport $transport
		 */
		if ($email->getTransport())
		{
			$transport = $email->getTransport();
		}
		else
		{
			$transport = \Swift_SmtpTransport::newInstance('aspmx.l.google.com', 25);
		}

		// Create the Mailer using your created Transport
		$mailer = \Swift_Mailer::newInstance($transport);

		/**
		 * Create a message
		 *
		 * @var \Swift_Mime_Message $message
		 */
		$message = \Swift_Message::newInstance()
			->setTo($email->getTo())
			->setFrom($email->getFrom())
			->setSubject($email->getSubject())
			->setContentType($email->getContentType())
			->setBody($email->getBody());

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
			'title'      => 'Cryslo',
			'logo_href'  => 'https://cfmedia.deadline.com/2016/07/logo-tv-logo.png',
			'logo_width' => '100',
			'logo_alt'   => 'Cryslo Logo',
			'content'    => 'Hello World',
			'year'       => date('Y'),
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