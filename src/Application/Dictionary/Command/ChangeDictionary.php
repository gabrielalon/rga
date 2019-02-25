<?php

namespace RGA\Application\Dictionary\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class ChangeDictionary
	implements Command\CommandInterface
{
	use Command\CommandTrait;
	
	/** @var array */
	private $entries;
	
	/** @var array */
	private $behaviours;
	
	/**
	 * @param string $uuid
	 * @param array $entries
	 * @param array $behaviours
	 */
	public function __construct(string $uuid, array $entries, array $behaviours)
	{
		$this->setIdentifier($uuid);
		$this->entries = $entries;
		$this->behaviours = $behaviours;
	}
	
	/**
	 * @return array
	 */
	public function getEntries(): array
	{
		return $this->entries;
	}
	
	/**
	 * @return array
	 */
	public function getBehaviours(): array
	{
		return $this->behaviours;
	}
}