<?php

namespace RGA\Infrastructure\SegregationSourcing\Event\EventSourcing;

use Psr\Container\ContainerInterface;
use RGA\Infrastructure\SegregationSourcing\Event\Plugin\EventRouter;
use RGA\Infrastructure\SegregationSourcing\Plugin\Routing\EventRouterInterface;

abstract class AbstractEventBusFactory
{
	/** @var EventRouter|EventRouterInterface */
	protected $eventRouter;
	
	/**
	 * @param EventRouterInterface $eventRouter
	 */
	public function __construct(EventRouterInterface $eventRouter)
	{
		$this->eventRouter = $eventRouter;
	}
	
	/**
	 * @param EventBus $eventBus
	 */
	protected function attachRoutesToEventBus(EventBus $eventBus)
	{
		$eventBus->injectRoutes($this->eventRouter);
	}
	
	/**
	 * @param EventBus $eventBus
	 * @param ContainerInterface $container
	 */
	abstract public function populate(EventBus $eventBus, ContainerInterface $container): void;
}