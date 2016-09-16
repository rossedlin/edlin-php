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
	/** @var array */
	private $response = [];

	private $success = false;

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