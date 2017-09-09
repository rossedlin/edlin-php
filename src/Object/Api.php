<?php
namespace Cryslo\Object;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
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
	 * @var array $request
	 */
	private $request = [];

	/**
	 * @var array $response
	 */
	private $response = [
		'success' => false,
	];

	/**
	 * @var array $payload
	 */
	private $payload = [];

	/**
	 * @param array $request
	 */
	public function addRequest(array $request)
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

	/**
	 * @return string
	 */
	public function getResponseAsJson()
	{
		return json_encode($this->getResponse());
	}

	/**
	 * @return array
	 */
	public function getResponse()
	{
		return [
			'request'  => $this->request,
			'response' => $this->response,
			'payload'  => $this->payload,
		];
	}
}