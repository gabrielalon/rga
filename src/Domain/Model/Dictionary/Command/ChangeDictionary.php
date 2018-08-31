<?php

namespace RGA\Domain\Model\Dictionary\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class ChangeDictionary
	implements Command\CommandInterface
{
	use Command\CommandTrait;
	
	/** @var array */
	private $values;
	
	/**
	 * @param string $uuid
	 * @param array $values
	 */
	public function __construct(string $uuid, array $values)
	{
		$this->setUuid($uuid);
		$this->values = $values;
	}
	
	/**
	 * @return array
	 */
	public function getValues(): array
	{
		return $this->values;
	}
}