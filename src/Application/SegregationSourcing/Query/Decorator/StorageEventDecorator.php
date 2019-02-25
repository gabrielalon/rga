<?php

namespace RGA\Application\SegregationSourcing\Query\Decorator;

use RGA\Application\SegregationSourcing\Query\ReadModel\StorageEvent;
use RGA\Infrastructure\SegregationSourcing\Aggregate\EventBridge\AggregateChanged;

class StorageEventDecorator
{
	/** @var DescriptionDecoratorRegistry */
	private $registry;
	
	/**
	 * @param DescriptionDecoratorRegistry $registry
	 */
	public function __construct(DescriptionDecoratorRegistry $registry)
	{
		$this->registry = $registry;
	}
	
	/**
	 * @param StorageEvent $storageEvent
	 * @return string
	 */
	public function eventType(StorageEvent $storageEvent): string
	{
		try
		{
			$reflection = new \ReflectionClass($storageEvent->eventName());
			
			return $reflection->getShortName();
		}
		catch (\Exception $e)
		{
			return '';
		}
	}
	
	/**
	 * @param StorageEvent $storageEvent
	 * @param string $locale
	 * @return string
	 */
	public function describe(StorageEvent $storageEvent, string $locale = 'pl'): string
	{
		/** @var AggregateChanged $eventName */
		$eventName = $storageEvent->eventName();
		/** @var AggregateChanged $event */
		$event = $eventName::fromEventStreamData($storageEvent->eventId(), $storageEvent->payload(), $storageEvent->metadata());
		
		return $this->registry->get($storageEvent)->extract($event, $locale);
	}
}