<?php

namespace RGA\Infrastructure\SegregationSourcing\Command\CommandHandling;

use Psr\Container\ContainerInterface;

class CommandBusFactoryCollection
{
	/** @var AbstractCommandBusFactory[] */
	private $factories = [];
	
	/**
	 * @param AbstractCommandBusFactory $commandBusFactory
	 */
	public function register(AbstractCommandBusFactory $commandBusFactory): void
	{
		$this->factories[] = $commandBusFactory;
	}
	
	/**
	 * @param CommandBus $commandBus
	 * @param ContainerInterface $container
	 */
	public function populate(CommandBus $commandBus, ContainerInterface $container): void
	{
		foreach ($this->factories as $factory)
		{
			$factory->populate($commandBus, $container);
		}
	}
}