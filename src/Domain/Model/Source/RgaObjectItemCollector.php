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
}