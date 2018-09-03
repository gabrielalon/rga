<?php

namespace RGA\Domain\Model\Dictionary\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class ChangeDictionary
	implements Command\CommandInterface
{
	use Command\CommandTrait;
	
	/** @var array */
	private $entries;
	
	/**
	 * @param string $uuid
	 * @param array $entries
	 */
	public function __construct(string $uuid, array $entries)
	{
		$this->setUuid($uuid);
		$this->entries = $entries;
	}
	
	/**
	 * @return array
	 */
	public function getEntries(): array
	{
		return $this->entries;
	}
}