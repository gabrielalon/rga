<?php

namespace RGA\Domain\ValueObject\Behaviour;

final class IsActive
{
	/** @var boolean */
	private $value;
	
	/**
	 * @param boolean $isActive
	 */
	public function __construct($isActive)
	{
		$this->value = (bool)$isActive;
	}
	
	/**
	 * @return boolean
	 */
	public function getValue()
	{
		return $this->value;
	}
}