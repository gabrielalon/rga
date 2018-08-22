<?php

namespace RGA\Domain\ValueObject\State;

final class IsRejectable
{
	/** @var boolean */
	private $value;
	
	/**
	 * @param boolean $isRejectable
	 */
	public function __construct($isRejectable)
	{
		$this->value = (bool)$isRejectable;
	}
	
	/**
	 * @return boolean
	 */
	public function getValue()
	{
		return $this->value;
	}
}