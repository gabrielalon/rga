<?php

namespace RGA\Domain\ValueObject\State;

final class IsFinishable
{
	/** @var boolean */
	private $value;
	
	/**
	 * @param boolean $isFinishable
	 */
	public function __construct($isFinishable)
	{
		$this->value = (bool)$isFinishable;
	}
	
	/**
	 * @return boolean
	 */
	public function getValue()
	{
		return $this->value;
	}
}