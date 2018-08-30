<?php

namespace RGA\Domain\Model\Rga\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class RemoveRga
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