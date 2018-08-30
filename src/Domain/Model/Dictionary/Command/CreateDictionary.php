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
	private $values;
	
	/**
	 * @param string $type
	 * @param array $values
	 */
	public function __construct(string $uuid, string $type, array $values)
	{
		$this->setUuid($uuid);
		$this->type = $type;
		$this->values = $values;
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
	public function getValues(): array
	{
		return $this->values;
	}
}