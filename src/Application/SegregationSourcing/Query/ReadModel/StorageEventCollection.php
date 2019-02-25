<?php

namespace RGA\Application\SegregationSourcing\Query\ReadModel;

use RGA\Infrastructure\SegregationSourcing\Query\Query\ViewableCollection;

class StorageEventCollection
	extends \ArrayIterator
		implements ViewableCollection
{
	/**
	 * @param StorageEvent $stateView
	 */
	public function add(StorageEvent $stateView): void
	{
		$this->offsetSet($stateView->identifier(), $stateView);
	}
	
	/**
	 * @param string $uuid
	 * @return StorageEvent
	 */
	public function get(string $uuid): StorageEvent
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
	 * @return StorageEvent[]
	 */
	public function all(): array
	{
		return $this->getArrayCopy();
	}
}