<?php

namespace RGA\Application\Command\CommandHandling;

use RGA\Infrastructure\Command\Command;
use RGA\Infrastructure\Command\CommandHandling;

class CommandBus
	implements CommandHandling\CommandBusInterface
{
	/** @var Command\CommandInterface[] */
	protected $commandQueue = [];
	
	/** @var CommandHandling\CommandHandlerInterface[] */
	protected $commandHandlers = [];
	
	/** @var bool */
	protected $isDispatching = false;
	
	/**
	 * @param Command\CommandInterface $command
	 * @throws \Exception
	 */
	public function dispatch(Command\CommandInterface $command)
	{
		$this->commandQueue[] = $command;
		
		if (!$this->isDispatching)
		{
			$this->isDispatching = true;
			
			try
			{
				while ($command = array_shift($this->commandQueue))
				{
					foreach ($this->commandHandlers as $handler)
					{
						$handler->handle($command);
					}
				}
				
				$this->isDispatching = false;
			}
			catch (\Exception $e)
			{
				$this->isDispatching = false;
				throw $e;
			}
		}
	}
	
	/**
	 * @param CommandHandling\CommandHandlerInterface $handler
	 */
	public function subscribe(CommandHandling\CommandHandlerInterface $handler)
	{
		$this->commandHandlers[] = $handler;
	}
}