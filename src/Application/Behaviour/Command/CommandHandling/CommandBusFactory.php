<?php

namespace RGA\Application\Behaviour\Command\CommandHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\Behaviour\Command;
use RGA\Infrastructure\Persist\Behaviour\BehaviourRepository;
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
		/** @var BehaviourRepository $behaviourRepository */
		$behaviourRepository = $container->get(BehaviourRepository::class);
		
		$this->commandRouter
			->route(Command\CreateBehaviour::class)
			->to(new Command\CreateBehaviourHandler($behaviourRepository));
		
		$this->commandRouter
			->route(Command\ChangeBehaviour::class)
			->to(new Command\ChangeBehaviourHandler($behaviourRepository));
		
		$this->attachRoutesToCommandBus($commandBus);
	}
}