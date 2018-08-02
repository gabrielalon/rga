<?php

namespace RGA\Domain\ValueObject\Behaviour;

class Behaviour
{
	/** @var string */
	private $type;
	
	/** @var boolean */
	private $isActive;
	
	/**
	 * @param string $type
	 * @param bool $isActive
	 */
	public function __construct($type, $isActive)
	{
		$this->type = $type;
		$this->isActive = $isActive;
	}
	
	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * @return bool
	 */
	public function isActive()
	{
		return $this->isActive;
	}
}