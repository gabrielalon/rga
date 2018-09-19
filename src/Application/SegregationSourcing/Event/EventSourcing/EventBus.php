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
		/**
		 * @var object $projector
		 * @var string $method
		 */
		foreach ($this->router->map($event->messageName()) as list($projector, $method))
		{
			$projector->{$method}($event);
		}
	}
}