<?php

namespace RGA\Domain\ValueObject\Base;

final class ObjectItemCollection
	extends \ArrayIterator
{
	/**
	 * @param ObjectItem $object
	 */
	public function add(ObjectItem $object): void
	{
		$this->append($object);
	}
}