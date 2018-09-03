<?php

namespace RGA\Domain\Model\Dictionary\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class CreateDictionary
	implements Command\CommandInterface
{
	use Command\CommandTrait;
	
	/** @var string */
	private $type;
	
	/** @var array */
	private $entries;
	
	/**
	 * @param string $type
	 * @param array $entries
	 */
	public function __construct(string $uuid, string $type, array $entries)
	{
		$this->setUuid($uuid);
		$this->type = $type;
		$this->entries = $entries;
	}
	
	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}
	
	/**
	 * @return array
	 */
	public function getEntries(): array
	{
		return $this->entries;
	}
}