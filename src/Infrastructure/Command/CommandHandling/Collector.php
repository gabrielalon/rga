<?php

namespace RGA\Infrastructure\Command\CommandHandling;

class Collector
	extends \ArrayIterator
{
	/**
	 * @param CommandHandlerInterface $handler
	 */
	public function add(CommandHandlerInterface $handler)
	{
		$this->append($handler);
	}
}