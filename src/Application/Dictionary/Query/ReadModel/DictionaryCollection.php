<?php

namespace RGA\Application\Dictionary\Query\ReadModel;

use RGA\Infrastructure\SegregationSourcing\Query\Query\ViewableCollection;

class DictionaryCollection
	extends \ArrayIterator
		implements ViewableCollection
{
	/**
	 * @param Dictionary $dictionary
	 */
	public function add(Dictionary $dictionary): void
	{
		$this->offsetSet($dictionary->identifier(), $dictionary);
	}
	
	/**
	 * @param string $uuid
	 * @return Dictionary
	 */
	public function get(string $uuid): Dictionary
	{
		return $this->offsetGet($uuid);
	}
	
	/**
	 * @param string $uuid
	 * @return bool
	 */
	public function has(string $uuid): bool
	{
		return $this->offsetExists($uuid);
	}
	
	/**
	 * @return Dictionary[]
	 */
	public function all(): array
	{
		return $this->getArrayCopy();
	}
}