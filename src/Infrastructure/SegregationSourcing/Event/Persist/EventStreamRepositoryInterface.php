<?php

namespace RGA\Infrastructure\SegregationSourcing\Event\Persist;

use RGA\Infrastructure\SegregationSourcing\Event\Event\EventInterface;
use RGA\Infrastructure\SegregationSourcing\Event\EventStore\Stream\EventStreamCollection;

interface EventStreamRepositoryInterface
{
	/**
	 * @param EventInterface $event
	 */
	public function save(EventInterface $event): void;
	
	/**
	 * @param string $aggregateId
	 * @param int $lastVersion
	 * @return EventStreamCollection
	 */
	public function load($aggregateId, $lastVersion): EventStreamCollection;
}