<?php

namespace RGA\Application\Attachment\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class RemoveAttachment
	implements Command\CommandInterface
{
	use Command\CommandTrait;
	
	/**
	 * @param string $uuid
	 */
	public function __construct(string $uuid)
	{
		$this->setIdentifier($uuid);
	}
}