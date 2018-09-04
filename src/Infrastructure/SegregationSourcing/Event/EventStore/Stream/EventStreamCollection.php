<?php

namespace RGA\Infrastructure\SegregationSourcing\Event\EventStore\Stream;

class EventStreamCollection
	extends \ArrayIterator
{
	/**
	 * @param EventStream $stream
	 */
	public function add(EventStream $stream): void
	{
		$this->append($stream);
	}
	
	/**
	 * @return EventStream[]
	 */
	public function getArrayCopy()
	{
		return parent::getArrayCopy();
	}
	
	/**
	 * @return EventStream[]
	 */
	public function all(): array
	{
		return $this->getArrayCopy();
	}
}