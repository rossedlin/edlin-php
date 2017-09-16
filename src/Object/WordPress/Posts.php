<?php
namespace Cryslo\Object\WordPress;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 16/09/2017
 * Time: 21:49
 *
 * Class Feed
 *
 * @package Cryslo\Object
 */
class Posts
{
	/**
	 * @var Channel $channel
	 */
	private $channel = false;

	/**
	 * @var array $data
	 */
	private $data = false;

	/**
	 * @return Channel
	 *
	 * @throws \Exception
	 */
	public function getChannel()
	{
		if ($this->channel === false)
		{
			if (isset($this->getData()['channel']) && is_array($this->getData()['channel']))
			{
				$this->channel = new Channel();
				$this->channel->setData($this->getData()['channel']);
			}
			else
			{
				throw new \Exception('Channel data missing');
			}
		}


		return $this->channel;
	}

	/**
	 * @param Channel $channel
	 */
	public function setChannel(Channel $channel)
	{
		$this->channel = $channel;
	}

	/**
	 * @return array
	 *
	 * @throws \Exception
	 */
	public function getData()
	{
		if ($this->data === false)
		{
			throw new \Exception('Data missing');
		}

		return $this->data;
	}

	/**
	 * @param array $data
	 */
	public function setData(array $data)
	{
		$this->data = $data;
	}
}