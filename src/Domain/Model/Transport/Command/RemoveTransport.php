<?php

namespace RGA\Domain\Model\Transport\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class RemoveTransport
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