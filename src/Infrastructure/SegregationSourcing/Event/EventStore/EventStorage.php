<?php

namespace RGA\Infrastructure\SegregationSourcing\Event\EventStore;

use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;
use RGA\Infrastructure\SegregationSourcing\Event\Event\EventInterface;
use RGA\Infrastructure\SegregationSourcing\Event\EventStore\BusBridge\EventPublisher;
use RGA\Infrastructure\SegregationSourcing\Event\Persist\EventStreamRepositoryInterface;

class EventStorage
{
	/** @var EventStreamRepositoryInterface */
	private $streamRepository;
	
	/** @var EventPublisher */
	private $eventPublisher;
	
	/** @var EventInterface */
	private $tmpLastReleasedEvent;
	
	public function __construct(EventStreamRepositoryInterface $streamRepository)
	{
		$this->streamRepository = $streamRepository;
	}
	
	/**
	 * @param EventPublisher $eventPublisher
	 */
	public function setEventPublisher(EventPublisher $eventPublisher): void
	{
		$this->eventPublisher = $eventPublisher;
	}
	
	/**
	 * @param EventInterface $event
	 * @return EventStorage
	 */
	public function release(EventInterface $event): EventStorage
	{
		$this->eventPublisher->release($event);
		
		$this->tmpLastReleasedEvent = $event;
		
		return $this;
	}
	
	public function record(): void
	{
		if (null !== $this->tmpLastReleasedEvent)
		{
			$this->streamRepository->save($this->tmpLastReleasedEvent);
		}
	}
	
	/**
	 * @param string $aggregateId
	 * @param int $lastVersion
	 * @return \ArrayIterator
	 */
	public function load(string $aggregateId, int $lastVersion): \ArrayIterator
	{
		$iterator = new \ArrayIterator();
		
		foreach ($this->streamRepository->load($aggregateId, $lastVersion)->getArrayCopy() as $eventStream)
		{
			$event = $eventStream->getEventName();
			/** @var AggregateChanged $event */
			$iterator->append($event::fromEventStream($eventStream));
		}
		
		return $iterator;
	}
}