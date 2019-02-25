<?php

namespace RGA\Test\Application;

use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling;

abstract class CommandHandlerTestCase
	extends HandlerTestCase
{
	/**
	 * @return CommandHandling\CommandBus
	 */
	protected function getCommandBus(): CommandHandling\CommandBus
	{
		return $this->getFromContainer(CommandHandling\CommandBus::class);
	}
}