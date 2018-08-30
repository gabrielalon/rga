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
	public function get($id)
	{
		return $this->offsetGet($id);
	}
}