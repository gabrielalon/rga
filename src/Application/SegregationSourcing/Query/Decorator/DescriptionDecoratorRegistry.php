<?php

namespace RGA\Application\SegregationSourcing\Query\Decorator;

use RGA\Application\SegregationSourcing\Query\ReadModel\StorageEvent;

class DescriptionDecoratorRegistry
{
	/** @var DescriptionDecoratorInterface[] */
	private $collection = [];
	
	/**
	 * @param DescriptionDecoratorInterface $decorator
	 */
	public function register(DescriptionDecoratorInterface $decorator)
	{
		$this->collection[$decorator->name()] = $decorator;
	}
	
	/**
	 * @param StorageEvent $storageEvent
	 * @return DescriptionDecoratorInterface
	 */
	public function get(StorageEvent $storageEvent)
	{
		if (true === isset($this->collection[$storageEvent->eventName()]))
		{
			return $this->collection[$storageEvent->eventName()];
		}
		
		return new Decorator\DefaultDescriptionDecorator();
	}
}