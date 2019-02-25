<?php

namespace RGA\Infrastructure\SegregationSourcing\Event\EventSourcing;

use RGA\Infrastructure\SegregationSourcing\Event\Event\EventInterface;
use RGA\Infrastructure\SegregationSourcing\Event\Plugin\EventRouter;
use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageBus;
use RGA\Infrastructure\SegregationSourcing\Plugin\Routing\RouterInterface;

class EventBus
	extends MessageBus
		implements EventBusInterface
{
	/** @var RouterInterface|EventRouter */
	private $router;
	
	/**
	 * @param RouterInterface|EventRouter $router
	 */
	public function __construct(RouterInterface $router)
	{
		$this->setRouter($router);
	}
	
	/**
	 * @param RouterInterface|EventRouter $router
	 */
	public function setRouter(RouterInterface $router)
	{
		$this->router = $router;
	}
	
	/**
	 * @param RouterInterface|EventRouter  $router
	 */
	public function injectRoutes(RouterInterface $router)
	{
		$this->router->merge($router);
	}
	
	/**
	 * @param EventInterface $event
	 */
	public function dispatch(EventInterface $event): void
	{
		/**
		 * @var \object $projector
		 * @var string $method
		 */
		foreach ($this->router->map($event->messageName()) as list($projector, $method))
		{
			\call_user_func([$projector, $method], $event);
		}
	}
}