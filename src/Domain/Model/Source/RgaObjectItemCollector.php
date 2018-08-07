<?php

namespace RGA\Domain\Model\Source;

class ObjectItemCollector
	extends \ArrayIterator
{
	/**
	 * @param ObjectItem $item
	 */
	public function add(ObjectItem $item)
	{
		$this->offsetSet($item->getId(), $item);
	}
}