<?php

namespace RGA\Application\Dictionary\Command\CommandHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\Dictionary\Command;
use RGA\Infrastructure\Persist\Dictionary\DictionaryRepository;
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
		/** @var DictionaryRepository $behaviourRepository */
		$behaviourRepository = $container->get(DictionaryRepository::class);
		
		$this->commandRouter
			->route(Command\CreateDictionary::class)
			->to(new Command\CreateDictionaryHandler($behaviourRepository));
		
		$this->commandRouter
			->route(Command\ChangeDictionary::class)
			->to(new Command\ChangeDictionaryHandler($behaviourRepository));
		
		$this->commandRouter
			->route(Command\RemoveDictionary::class)
			->to(new Command\RemoveDictionaryHandler($behaviourRepository));
		
		$this->attachRoutesToCommandBus($commandBus);
	}
}