<?php

namespace RGA\Application\State\Command\CommandHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\State\Command;
use RGA\Infrastructure\Persist\State\StateRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling;

class CommandBusFactory
	extends CommandHandling\AbstractCommandBusFactory
{
	/**
	 * @param CommandHandling\CommandBus $commandBus
	 * @param ContainerInterface $container
	 */
	public function populate(CommandHandling\CommandBus $commandBus, ContainerInterface $container): void
	{
		/** @var StateRepository $stateRepository */
		$stateRepository = $container->get(StateRepository::class);
		
		$this->commandRouter
			->route(Command\CreateState::class)
			->to(new Command\CreateStateHandler($stateRepository));
		
		$this->commandRouter
			->route(Command\ChangeState::class)
			->to(new Command\ChangeStateHandler($stateRepository));
		
		$this->commandRouter
			->route(Command\RemoveState::class)
			->to(new Command\RemoveStateHandler($stateRepository));
		
		$this->attachRoutesToCommandBus($commandBus);
	}
}