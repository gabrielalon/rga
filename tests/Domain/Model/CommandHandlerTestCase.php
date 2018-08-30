<?php

namespace RGA\Test\Domain\Model;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use RGA\Application\SegregationSourcing\Command\CommandHandling;
use RGA\Test\Mock\Container\DI;

abstract class CommandHandlerTestCase
	extends PHPUnitTestCase
{
	/** @var CommandHandling\CommandBus */
	private $commandBus;
	
	/** @var DI */
	private $container;
	
	/**
	 * @return DI
	 */
	protected function getContainer(): DI
	{
		if (null === $this->container)
		{
			$this->container = DI::newInstance();
		}
		
		return $this->container;
	}
	
	/**
	 * @param $id
	 * @return mixed
	 */
	protected function getFromContainer($id)
	{
		return $this->getContainer()->get($id);
	}
	
	/**
	 * @return CommandHandling\CommandBus
	 */
	protected function getCommandBus(): CommandHandling\CommandBus
	{
		if (null === $this->commandBus)
		{
			$this->commandBus = CommandHandling\CommandBusFactory::get($this->getContainer());
		}
		
		return $this->commandBus;
	}
}