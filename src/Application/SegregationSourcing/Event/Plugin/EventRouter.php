<?php

namespace RGA\Application\SegregationSourcing\Event\Plugin;

use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageBusInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageHandlerInterface;
use RGA\Infrastructure\SegregationSourcing\Plugin\Routing\EventRouterInterface;

class EventRouter
	implements EventRouterInterface
{
	/** @var string */
	private $tmpEventName;
	
	/** @var array */
	private $listenerMap = [];
	
	/**
	 * @param string $messageName
	 * @return EventRouterInterface
	 */
	public function route($messageName): EventRouterInterface
	{
		if (true === empty($messageName))
		{
			throw new \InvalidArgumentException('Event name cannot be empty');
		}
		
		$this->tmpEventName = $messageName;
		
		return $this;
	}
	
	/**
	 * @param callable $listener
	 */
	public function to($listener): void
	{
		if (true === empty($this->tmpEventName))
		{
			throw new \RuntimeException('Please provide event name first with route method');
		}
		
		if (false === is_callable($listener)) {
			throw new \RuntimeException(sprintf(
				'Invalid listener provided. Expected type is callable but type of %s given.',
				gettype($listener)
			));
		}
		
		$this->listenerMap[$this->tmpEventName][] = $listener;
	}
	
	/**
	 * @param callable $listener
	 */
	public function andTo($listener): void
	{
		$this->to($listener);
	}
	
	/**
	 * @param string $messageName
	 * @return MessageHandlerInterface[]
	 */
	public function map($messageName): array
	{
		return $this->listenerMap[$messageName];
	}
	
	/**
	 * @param MessageBusInterface $bus
	 */
	public function attachToMessageBus(MessageBusInterface $bus): void
	{
		$bus->setRouter($this);
	}
}