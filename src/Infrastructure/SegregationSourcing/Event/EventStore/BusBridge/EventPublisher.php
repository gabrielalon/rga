<?php

namespace RGA\Infrastructure\SegregationSourcing\Event\EventStore\BusBridge;

use RGA\Application\SegregationSourcing\Event\EventSourcing\EventBus;
use RGA\Infrastructure\SegregationSourcing\Event\Event\EventInterface;
use RGA\Infrastructure\SegregationSourcing\Event\EventStore\EventStorage;

class EventPublisher
{
	/** @var EventBus */
	private $eventBus;
	
	/**
	 * @param EventBus $eventBus
	 */
	public function __construct(EventBus $eventBus)
	{
		$this->eventBus = $eventBus;
	}
	
	/**
	 * @param EventStorage $eventStorage
	 */
	public function attachToEventStorage(EventStorage $eventStorage): void
	{
		$eventStorage->setEventPublisher($this);
	}
	
	/**
	 * @param EventInterface $event
	 */
	public function release(EventInterface $event): void
	{
		$this->eventBus->dispatch($event);
	}
}