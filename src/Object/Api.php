<?php
namespace Cryslo\Object;

/**
 * Created by PhpStorm.
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 26/12/2015
 * Time: 15:55
 *
 * Class Api
 * @package Cryslo\Core\Object
 */
class Api
{
	const RENDER_ARRAY = 'array';
	const RENDER_JSON  = 'json';

	/**
	 * @var array $debug
	 */
	private $debug = [];
	/**
	 * @var array $payload
	 */
	private $payload = [];
	/**
	 * @var array $request
	 */
	private $request = [];
	/**
	 * @var array $response
	 */
	private $response = [
		'success' => false,
		'message' => '',
	];

	/**
	 * @param string $debug
	 */
	public function addDebug($debug)
	{
		$this->debug[] = (string)$debug;
	}

	/**
	 * @return string
	 */
	public function renderAsJson()
	{
		return json_encode($this->render(), JSON_PRETTY_PRINT);
	}

	/**
	 * @return array
	 */
	public function render()
	{
		return [
			'debug'    => $this->debug,
			'request'  => $this->request,
			'response' => $this->response,
			'payload'  => $this->payload,
		];
	}

	/**
	 * @param string $message
	 */
	public function setMessage($message)
	{
		$this->response['message'] = (string)$message;
	}

	/**
	 * @param array $payload
	 */
	public function setPayload(array $payload)
	{
		$this->payload = $payload;
	}

	/**
	 * @param array $request
	 */
	public function setRequest(array $request)
	{
		$this->request = $request;
	}

	/**
	 * @param bool $success
	 */
	public function setSuccess($success)
	{
		$this->response['success'] = (bool)$success;
	}
}