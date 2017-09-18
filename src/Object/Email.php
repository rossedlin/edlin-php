<?php
namespace Cryslo\Object;

use Cryslo\Core\Consts;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 09/09/2017
 * Time: 19:44
 *
 * Class Api
 * @package Cryslo\Core\Object
 */
class Email
{
	/** @var string $body */
	private $body = false;

	/** @var string $contentType */
	private $contentType = Consts::CONTENT_TYPE_PLAIN;

	/** @var string $from */
	private $from = false;

	/** @var string $subject */
	private $subject = false;

	/** @var string $to */
	private $to = false;

	/** @var \Swift_SmtpTransport|bool */
	private $transport = false;

	/**
	 * @return string
	 */
	public function getBody()
	{
		return $this->body;
	}

	/**
	 * @param string $body
	 */
	public function setBody($body)
	{
		$this->body = $body;
	}

	/**
	 * @return string
	 */
	public function getContentType()
	{
		return $this->contentType;
	}

	/**
	 * @param string $contentType
	 */
	public function setContentType($contentType)
	{
		$this->contentType = $contentType;
	}

	/**
	 * @return string
	 */
	public function getFrom()
	{
		return $this->from;
	}

	/**
	 * @param string $from
	 */
	public function setFrom($from)
	{
		$this->from = $from;
	}

	/**
	 * @return string
	 */
	public function getSubject()
	{
		return $this->subject;
	}

	/**
	 * @param string $subject - Subject must satisfy » RFC 2047.
	 */
	public function setSubject($subject)
	{
		$this->subject = $subject;
	}

	/**
	 * @return string
	 */
	public function getTo()
	{
		return $this->to;
	}

	/**
	 * @param string $to
	 */
	public function setTo($to)
	{
		$this->to = $to;
	}

	/**
	 * @return bool|\Swift_SmtpTransport
	 */
	public function getTransport()
	{
		return $this->transport;
	}

	/**
	 * @param bool|\Swift_SmtpTransport $transport
	 *
	 * @throws \Exception
	 */
	public function setTransport($transport)
	{
		if ($transport === false)
		{
			$this->transport = false;
		}
		elseif ($transport instanceof \Swift_SmtpTransport)
		{
			$this->transport = $transport;
		}
		else
		{
			throw new \Exception('Bad Transport Type');
		}
	}
}