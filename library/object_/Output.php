<?php
namespace Cryslo\Core\Object;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 26/12/2015
 * Time: 15:55
 */

class Output extends _Object
{
	const RENDER_ARRAY = 'array';
	const RENDER_JSON = 'json';

	private static $RENDER = array
	(
		self::RENDER_ARRAY,
		self::RENDER_JSON,
	);

	/** @var bool */
	private $success;

	/** @var string */
	private $render;

	/** @var string */
	private $message;

	/** @var array */
	private $data;

	/**
	 * @return null
	 */
	public function init()
	{
		$this->setSuccess(false);
		$this->setRender(self::RENDER_JSON);
		$this->setMessage("");
		$this->setData([]);
	}

	/**
	 * @param $source
	 */
	public function setFromData($source)
	{
		if (isset($source['success'])) $this->setSuccess($source['success']);
		if (isset($source['render'])) $this->setRender($source['render']);
		if (isset($source['message'])) $this->setMessage($source['message']);
		if ((isset($source['data'])) && (is_array($source['data']))) $this->setData($source['data']);
	}

	/**
	 * @return array
	 */
	public function getAsArray()
	{
		return array
		(
			'success' => $this->isSuccess(),
			'render'  => $this->getRender(),
			'message' => $this->getMessage(),
			'data'    => $this->getData(),
		);
	}

	/**
	 * @return boolean
	 */
	public function isSuccess()
	{
		return (bool)$this->success;
	}

	/**
	 * @param boolean $success
	 */
	public function setSuccess($success)
	{
		$this->success = (bool)$success;
	}

	/**
	 * @return string
	 */
	public function getRender()
	{
		return $this->render;
	}

	/**
	 * @param string $render
	 */
	public function setRender($render)
	{
		if (in_array($render, self::$RENDER))
		{
			$this->render = $render;
		}
	}

	/**
	 * @return string
	 */
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * @param string $message
	 */
	public function setMessage($message)
	{
		$this->message = $message;
	}

	/**
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @param array $data
	 */
	public function setData(array $data)
	{
		$this->data = $data;
	}

	public function addData($data)
	{
		$this->data[] = $data;
	}
}