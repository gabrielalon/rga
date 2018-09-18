<?php

namespace RGA\Application\Service;

use Psr\Container\ContainerInterface;
use RGA\Application\SegregationSourcing\Command\CommandHandling;
use RGA\Infrastructure\SegregationSourcing\Command\Command;

abstract class AbstractService
{
	/** @var CommandHandling\CommandBus */
	private $commandBus;
	
	/**
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->commandBus = CommandHandling\CommandBusFactory::get($container);
	}
	
	/**
	 * @param Command\CommandInterface $command
	 */
	protected function handle(Command\CommandInterface $command): void
	{
		$this->commandBus->dispatch($command);
	}
}