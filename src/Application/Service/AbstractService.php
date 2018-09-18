<?php

namespace RGA\Application\Service;

use RGA\Application\SegregationSourcing\Command\CommandHandling;
use RGA\Infrastructure\SegregationSourcing\Command\Command;

abstract class AbstractService
{
	/** @var CommandHandling\CommandBus */
	private $commandBus;
	
	/**
	 * @param CommandHandling\CommandBus $commandBus
	 */
	public function __construct(CommandHandling\CommandBus $commandBus)
	{
		$this->commandBus = $commandBus;
	}
	
	/**
	 * @param Command\CommandInterface $command
	 */
	public function handle(Command\CommandInterface $command): void
	{
		$this->commandBus->dispatch($command);
	}
}