<?php

namespace RGA\Infrastructure\SegregationSourcing\Service;

use RGA\Infrastructure\SegregationSourcing\Command\Command\CommandInterface;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling\CommandBus;

abstract class AbstractCommandManager
{
	/** @var CommandBus */
	private $commandBus;
	
	/**
	 * @param CommandBus $commandBus
	 */
	public function __construct(CommandBus $commandBus)
	{
		$this->commandBus = $commandBus;
	}
	
	/**
	 * @param CommandInterface $command
	 */
	public function handle(CommandInterface $command): void
	{
		$this->commandBus->dispatch($command);
	}
}