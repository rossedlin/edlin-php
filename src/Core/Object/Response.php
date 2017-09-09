<?php
namespace Cryslo\Core\Object;
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 21/11/2015
 * Time: 13:36
 */

class Response
{
	/** @var \Exception[] $exception */
	private $exception = [];

	/** @var array $response */
	private $response = [];

	/** @var bool $success */
	private $success = false;

	/**
	 * @return \Exception[]
	 */
	public function getExceptions()
	{
		return $this->exception;
	}

	/**
	 * @param \Exception $exception
	 */
	public function addException(\Exception $exception)
	{
		$this->exception[] = $exception;
	}

	/**
	 * @return array
	 */
	public function getResponse()
	{
		return $this->response;
	}

	/**
	 * @param string $response
	 */
	public function addResponse($response)
	{
		$this->response[] = $response;
	}

	/**
	 * @return boolean
	 */
	public function isSuccess()
	{
		return $this->success;
	}

	/**
	 * @param boolean $success
	 */
	public function setSuccess($success)
	{
		$this->success = $success;
	}
}