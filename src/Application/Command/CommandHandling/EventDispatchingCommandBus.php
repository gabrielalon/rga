<?php

namespace RGA\Application\Command\CommandHandling;

use RGA\Application\Command\CommandHandling\Event;
use RGA\Infrastructure\Command\Command;
use RGA\Infrastructure\Command\CommandHandling;
use RGA\Infrastructure\Command\EventDispatcher;

class EventDispatchingCommandBus
	implements CommandHandling\CommandBusInterface
{
	/** @var CommandHandling\CommandBusInterface */
	private $commandBus;
	
	/** @var EventDispatcher\EventDispatcherInterface */
	private $dispatcher;
	
	public function __construct(
		CommandHandling\CommandBusInterface $commandBus,
		EventDispatcher\EventDispatcherInterface $dispatcher
	) {
		$this->commandBus = $commandBus;
		$this->dispatcher = $dispatcher;
	}
	
	/**
	 * @param Command\CommandInterface $command
	 * @throws \Exception
	 */
	public function dispatch(Command\CommandInterface $command)
	{
		try
		{
			$this->commandBus->dispatch($command);
			$this->dispatcher->dispatch(
				Event\DispatcherEvents::EVENT_COMMAND_SUCCESS,
				['command' => $command]
			);
		}
		catch (\Exception $e)
		{
			$this->dispatcher->dispatch(
				Event\DispatcherEvents::EVENT_COMMAND_FAILURE,
				['command' => $command, 'exception' => $e]
			);
			
			throw $e;
		}
	}
	
	/**
	 * @param CommandHandling\CommandHandlerInterface $handler
	 */
	public function subscribe(CommandHandling\CommandHandlerInterface $handler)
	{
		$this->commandBus->subscribe($handler);
	}
}