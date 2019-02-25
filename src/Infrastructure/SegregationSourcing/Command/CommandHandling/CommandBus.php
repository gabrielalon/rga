<?php

namespace RGA\Infrastructure\SegregationSourcing\Command\CommandHandling;

use RGA\Infrastructure\SegregationSourcing\Command\Command\CommandInterface;
use RGA\Infrastructure\SegregationSourcing\Command\Plugin\CommandRouter;
use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageBus;
use RGA\Infrastructure\SegregationSourcing\Plugin\Routing\RouterInterface;

class CommandBus
	extends MessageBus
		implements CommandBusInterface
{
	/** @var RouterInterface|CommandRouter */
	private $router;
	
	/**
	 * @param RouterInterface|CommandRouter $router
	 */
	public function __construct(RouterInterface $router)
	{
		$this->setRouter($router);
	}
	
	/**
	 * @param RouterInterface|CommandRouter $router
	 */
	public function setRouter(RouterInterface $router): void
	{
		$this->router = $router;
	}
	
	/**
	 * @param RouterInterface|CommandRouter $router
	 */
	public function injectRoutes(RouterInterface $router): void
	{
		$this->router->merge($router);
	}
	
	/**
	 * @param CommandInterface $command
	 */
	public function dispatch(CommandInterface $command)
	{
		$this->router->map($command->messageName())->run($command);
	}
}