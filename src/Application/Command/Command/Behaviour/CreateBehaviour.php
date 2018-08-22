<?php

namespace RGA\Application\Command\Command\Behaviour;

use RGA\Infrastructure\Command\Command\CommandInterface;

class CreateBehaviour
	implements CommandInterface
{
	/** @var string */
	private $uuid;
	
	/** @var string */
	private $type;
	
	/** @var boolean */
	private $isActive;

	/** @var array */
	private $names;
	
	/**
	 * @param string $uuid
	 * @param string $type
	 * @param bool $isActive
	 * @param array $names
	 */
	public function __construct($uuid, $type, $isActive, $names = [])
	{
		$this->uuid = $uuid;
		$this->type = $type;
		$this->isActive = $isActive;
		$this->names = $names;
	}
	
	/**
	 * @return string
	 */
	public function getUuid(): string
	{
		return $this->uuid;
	}
	
	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}
	
	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->isActive;
	}
	
	/**
	 * @return array
	 */
	public function getNames(): array
	{
		return $this->names;
	}
}