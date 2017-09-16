<?php
namespace Cryslo\Object\WordPress;

/**
 * Created by PhpStorm.
 *
 * @author  Ross Edlin <contact@rossedlin.com>
 *
 * Date: 16/09/2017
 * Time: 22:14
 *
 * Class Channel
 *
 * @package Cryslo\Object\WordPress
 */
class Channel
{
	/**
	 * @var array $data
	 */
	private $data = false;

	/**
	 * @var Item[] $items
	 */
	private $items = false;

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

	/**
	 * @return Item[]
	 * @throws \Exception
	 */
	public function getItems()
	{
		if ($this->items === false)
		{
			if (isset($this->getData()['item']) && is_array($this->getData()['item']))
			{
				$this->items = []; //new Channel();

				foreach ($this->getData()['item'] as $itemData)
				{
					$item = new Item();
					$item->setData($itemData);

					$this->items[] = $item;
				}
			}
			else
			{
				throw new \Exception('Item data missing');
			}
		}

		return $this->items;
	}
}