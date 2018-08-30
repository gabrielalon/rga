<?php

namespace RGA\Domain\Model\Behaviour\Command;

use RGA\Infrastructure\SegregationSourcing\Command\Command;

class ChangeBehaviour
	implements Command\CommandInterface
{
	use Command\CommandTrait;
	
	/** @var array */
	private $names;
	
	/** @var boolean */
	private $isActive;
	
	/**
	 * @param string $uuid
	 * @param array $names
	 * @param bool $isActive
	 */
	public function __construct(string $uuid, array $names, bool $isActive)
	{
		$this->setUuid($uuid);
		$this->names = $names;
		$this->isActive = $isActive;
	}
	
	/**
	 * @return array
	 */
	public function getNames(): array
	{
		return $this->names;
	}
	
	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->isActive;
	}
}