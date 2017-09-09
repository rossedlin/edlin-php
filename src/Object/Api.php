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
	const RENDER_JSON = 'json';

	/**
	 * @var \stdClass $request
	 */
	private $request;

	/**
	 * @var \stdClass $response
	 */
	private $response;

	/**
	 * @var \stdClass $payload
	 */
	private $payload;

	/**
	 * Api constructor.
	 *
	 * @param string $raw
	 * @param string $type
	 */
	public function __construct($raw, $type = self::RENDER_JSON)
	{
		switch ($type)
		{
			case self::RENDER_JSON:

				/**
				 * @var \stdClass $data
				 */
				$data = json_decode($raw);

				/**
				 * Request
				 */
				if (isset($data->request))
				{
					$this->request = $data->request;
				}
				else
				{
					$this->request = new \stdClass();
				}

				/**
				 * Response
				 */
				if (isset($data->response))
				{
					$this->response = $data->response;
				}
				else
				{
					$this->response = new \stdClass();
				}

				/**
				 * Payload
				 */
				if (isset($data->payload))
				{
					$this->payload = $data->payload;
				}
				else
				{
					$this->payload = new \stdClass();
				}
				
				break;
		}
	}

	/**
	 * @return \stdClass
	 */
	public function getPayload()
	{
		return $this->payload;
	}
}