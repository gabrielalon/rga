<?php

namespace RGA\Domain\ValueObject\State;

final class IsCloseable
{
	/** @var boolean */
	private $value;
	
	/**
	 * @param boolean $isCloseable
	 */
	public function __construct($isCloseable)
	{
		$this->value = (bool)$isCloseable;
	}
	
	/**
	 * @return boolean
	 */
	public function getValue()
	{
		return $this->value;
	}
}