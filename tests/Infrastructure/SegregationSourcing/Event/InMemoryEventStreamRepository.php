<?php

namespace RGA\Test\Infrastructure\SegregationSourcing\Event;

use function array_keys;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Event\EventInterface;
use RGA\Infrastructure\SegregationSourcing\Event\EventStore\Stream\EventStream;
use RGA\Infrastructure\SegregationSourcing\Event\EventStore\Stream\EventStreamCollection;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;

class InMemoryEventStreamRepository
	implements EventStreamRepositoryInterface
{
	/** @var array */
	private $events = [];
	/**
	 * @param EventInterface|AggregateChanged $event
	 */
	public function save(EventInterface $event): void
	{
		$this->events[$event->aggregateId()][$event->version()][] = $event;
	}
	
	/**
	 * @param string $aggregateId
	 * @param int $lastVersion
	 * @return EventStreamCollection
	 */
	public function load(string $aggregateId, int $lastVersion): EventStreamCollection
	{
		$collection = new EventStreamCollection();
		
		if (false === isset($this->events[$aggregateId][$lastVersion]))
		{
			return $collection;
		}
		
		/** @var AggregateChanged $event */
		foreach ($this->events[$aggregateId][$lastVersion] as $event)
		{
			$collection->add(new EventStream(
				$event->aggregateId(),
				$event->version(),
				$event->messageName(),
				$event->payload(),
				$event->metadata()
			));
		}
		
		return $collection;
	}
}