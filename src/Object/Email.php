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

	/** @var string $from */
	private $fromName = false;

	/** @var string $subject */
	private $subject = false;

	/** @var string $to */
	private $to = false;

	/** @var array $args */
	private $args = [];

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
		switch ((string)$contentType)
		{
			case Consts::CONTENT_TYPE_PLAIN:
				$this->contentType = Consts::CONTENT_TYPE_PLAIN;
				break;

			case Consts::CONTENT_TYPE_HTML:
				$this->contentType = Consts::CONTENT_TYPE_HTML;
				break;
		}
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
	public function getFromName()
	{
		return $this->fromName;
	}

	/**
	 * @param string $fromName
	 */
	public function setFromName($fromName)
	{
		$this->fromName = $fromName;
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
	 * @return array
	 */
	public function getArgs()
	{
		return (array)$this->args;
	}

	/**
	 * @param array $args
	 */
	public function setArgs(array $args)
	{
		$this->args = $args;
	}

	/**
	 * @return array
	 */
	public function getArg($key)
	{
		return $this->args[$key];
	}

	/**
	 * @param string|int $key
	 * @param mixed      $arg
	 */
	public function setArg($key, $arg)
	{
		$this->args[$key] = $arg;
	}
}