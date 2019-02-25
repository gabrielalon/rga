<?php

namespace RGA\Application\Transport\Query\ReadModel;

use RGA\Infrastructure\SegregationSourcing\Query\Query\ViewableCollection;

class TransportCollection
	extends \ArrayIterator
		implements ViewableCollection
{
	/**
	 * @param Transport $transportView
	 */
	public function add(Transport $transportView): void
	{
		$this->offsetSet($transportView->identifier(), $transportView);
	}
	
	/**
	 * @param string $uuid
	 * @return Transport
	 */
	public function get(string $uuid): Transport
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
	 * @return Transport[]
	 */
	public function all(): array
	{
		return $this->getArrayCopy();
	}
}