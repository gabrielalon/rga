<?php

namespace RGA\Domain\Model\Dictionary\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class RemoveDictionary
	implements Command\CommandInterface
{
	use Command\CommandTrait;
	
	/**
	 * @param string $uuid
	 */
	public function __construct(string $uuid)
	{
		$this->setUuid($uuid);
	}
}