<?php

namespace RGA\Domain\Model\Source;

class RgaObjectItemCollector
	extends \ArrayIterator
{
	/**
	 * @param RgaObjectItem $item
	 */
	public function add(RgaObjectItem $item)
	{
		$this->offsetSet($item->getId(), $item);
	}
	
	/**
	 * @param integer $id
	 * @return RgaObjectItem
	 */
	public function get($id): RgaObjectItem
	{
		return $this->offsetGet($id);
	}
	
	/**
	 * @param integer $id
	 * @return bool
	 */
	public function has($id): bool
	{
		return $this->offsetExists($id);
	}
}