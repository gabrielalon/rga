<?php

namespace RGA\Application\SegregationSourcing\Event\EventSourcing;

use RGA\Application\SegregationSourcing\Event\Plugin\EventRouter;
use RGA\Infrastructure\SegregationSourcing\Event\Event\EventInterface;
use RGA\Infrastructure\SegregationSourcing\Event\EventSourcing\EventBusInterface;
use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageBus;
use RGA\Infrastructure\SegregationSourcing\Plugin\Routing\RouterInterface;

class EventBus
	extends MessageBus
		implements EventBusInterface
{
	/** @var EventRouter */
	private $router;
	
	/**
	 * @param RouterInterface|EventRouter $router
	 */
	public function setRouter(RouterInterface $router): void
	{
		$this->router = $router;
	}
	
	/**
	 * @param EventInterface $event
	 */
	public function dispatch(EventInterface $event): void
	{
		/** @var callable $listener */
		foreach ($this->router->map($event->messageName()) as $listener)
		{
			\call_user_func($listener, $event);
		}
	}
}