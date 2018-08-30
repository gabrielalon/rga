<?php

namespace RGA\Domain\Model\Rga\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class ChangeStateRga
	implements Command\CommandInterface
{
	use Command\CommandTrait;
	
	/** @var string */
	private $stateUuid;
	
	/**
	 * @param string $uuid
	 * @param string $stateUuid
	 */
	public function __construct(string $uuid, string $stateUuid)
	{
		$this->setUuid($uuid);
		$this->stateUuid = $stateUuid;
	}
	
	/**
	 * @return string
	 */
	public function getStateUuid(): string
	{
		return $this->stateUuid;
	}
}