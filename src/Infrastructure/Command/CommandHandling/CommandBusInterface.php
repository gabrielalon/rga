<?php

namespace RGA\Infrastructure\Command\CommandHandling;

use RGA\Infrastructure\Command\Command;

interface CommandBusInterface
{
	/**
	 * @param Command\CommandInterface $command
	 */
	public function dispatch(Command\CommandInterface $command);
	
	/**
	 * @param CommandHandlerInterface $handler
	 */
	public function subscribe(CommandHandlerInterface $handler);
}