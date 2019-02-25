<?php

namespace RGA\Infrastructure\SegregationSourcing\Command\CommandHandling;

use Psr\Container\ContainerInterface;
use RGA\Infrastructure\SegregationSourcing\Event\EventStore\EventStorage;
use RGA\Infrastructure\SegregationSourcing\Plugin\Routing\CommandRouterInterface;

abstract class AbstractCommandBusFactory
{
	/** @var CommandRouterInterface */
	protected $commandRouter;
	
	/** @var EventStorage */
	protected $eventStorage;
	
	/**
	 * @param CommandRouterInterface $commandRouter
	 * @param EventStorage $eventStorage
	 */
	public function __construct(CommandRouterInterface $commandRouter, EventStorage $eventStorage)
	{
		$this->commandRouter = $commandRouter;
		$this->eventStorage = $eventStorage;
	}
	
	/**
	 * @param CommandBus $commandBus
	 */
	protected function attachRoutesToCommandBus(CommandBus $commandBus)
	{
		$commandBus->injectRoutes($this->commandRouter);
	}
	
	/**
	 * @param CommandBus $commandBus
	 * @param ContainerInterface $container
	 */
	abstract public function populate(CommandBus $commandBus, ContainerInterface $container): void;
}